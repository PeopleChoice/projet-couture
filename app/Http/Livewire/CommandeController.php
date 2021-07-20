<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Mensuration;
use App\Models\Detaille;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use PDF;

class CommandeController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;
    public $isModalOpens = 0;
    public $isModalOpenMensuration = 0;
    public $isModalOpenDeatille = 0;
    public $commande_id,$client_id,$clients; 
    public $mycommande;
    public $mensuration_show;
    public $searchTerms ;
    public $prix_u,$qt,$libelle_detaille,$detailles,$totalDetaille,$payer = 0,$total=0;
    public $date_commande,$date_livraison,$mensuration,$libelle,$accompt=0,$remise = 0,$status;
    // public $listeners = ['fileUpload' => 'handleFileUpload'];
    public $m = array('COL'=>'X','EPAULE'=>'X','MANCHE'=>'X',
                      'LONGUEUR BOUBOU'=>'X','POITRINE'=>'X',
                      'TOUR DE VENTRE'=>'X','TOUR DE BRAS'=>'X',
                      'CEINTURE'=>'X','BASSIN'=>'X','LONGEUR GENOU'=>'X',
                      'TOUR DE GENOU'=>'X','TOUR DE CUISSE'=>'X','LONGUEUR PANTALON'=>'X',
                      'BAS'=>'X','CARRURE DEVANT'=>'X','CARRURE DOS'=>'X');
    public function mount($id){
        $this->client_id = $id ? $id :   $this->client_id ;
        $buffer = Client::where('id', $this->client_id)->get()->toArray();
        $this->clients = $buffer[0];
        
    }
    public function render()
    {
      
        $this->emit('title', 'Commandes');
        $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.commande.commande', ['commandes'=> Commande::where('clients_id', $this->client_id)->where('date_commande','like',$searchTerms)->paginate(10)]);
    }

    public function create()
    {
        $this->client_id  = $this->clients['id'];
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function openModalPopovershow()
    {
        $this->isModalOpens = true;
    }

    public function closeModalPopovershow()
    {
        $this->isModalOpens = false;
    }
    private function resetCreateForm(){
          $this->date_commande = '';
          $this->date_livraison = '';
          $this->libelle = '';
          //$this->accompt = '';
          $this->status = '';


    }

   
    public function store()
    {
     
        $this->date_commande = $this->date_commande ? $this->date_commande : Carbon::parse(now())->format('Y-m-d');
        $this->validate([
            'date_livraison' => 'required',
            'status' => 'required',
           
        ]);
     
        if( $this->commande_id){
            $commande = Commande::where('id',$this->commande_id)->with('detaille')->first();
            $detailles = Detaille::where('commande_id',$this->commande_id)->get();
            $cpt = 0;
            if($detailles){
                foreach($detailles as $item){
                $cpt = $cpt + ($item->qt * $item->prix_u);
               }
            }
            
            $this->payer = $cpt - $commande->remise;
        }


        
        $commandee = Commande::updateOrCreate(['id' => $this->commande_id], [
            'date_commande' => $this->date_commande,
            'date_livraison' => $this->date_livraison,
            'remise' => $this->remise,
            'libelle' => $this->libelle,
            'accompt' => $this->accompt,
            'status' => $this->status,
            'clients_id'=>$this->client_id,
            'payer' => $this->payer == $this->accompt ? 1 : 0
             
        ]);
         
       
        session()->flash('message', $this->commande_id ? ' Commande updated.' : 'Commande created.');
        $this->commande_id = "";
   

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $this->client_id  = $this->clients['id'];
        $commande = Commande::findOrFail($id);

        $this->commande_id = $id;
        $this->date_livraison =  $commande->date_livraison;
        $this->libelle = $commande->libelle;
        $this->accompt = $commande->accompt;
        $this->date_commande  = $commande->date_commande;
        $this->status = $commande->status;
        $this->remise = $commande->remise;
    

    
        
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        
        Commande::find($id)->delete();
        session()->flash('message', 'Commande deleted.');
    }


    public function showCommande($id){
           $this->isModalOpens = true;
           $this->mycommande = Commande::where('id',$id)->with('detaille')->first();
           $this->commande_id = $id;
            $this->detailles = Detaille::where('commande_id',$this->commande_id)->get();
            $cpt = 0;
            if($this->detailles){
                foreach($this->detailles as $item){
                $cpt = $cpt + ($item->qt * $item->prix_u);
            }
        }
            $this->totalDetaille = $cpt;
         
    }

    public function openMensuration()
    {
        //dd($this->m);
        $this->client_id  = $this->clients['id'];
       
     
        $commande = Mensuration::find($this->client_id);
      ///  dd($commande);
        if($commande){
            $buffer = \explode('/', $commande->mensuration);
     
            $this->m['COL'] =  strval($buffer[0]);
            $this->m['EPAULE']  = $buffer[1];
            $this->m['MANCHE']  = $buffer[2];
            $this->m['LONGUEUR BOUBOU']  = $buffer[3];
            $this->m['POITRINE']  = $buffer[4];
            $this->m['TOUR DE VENTRE']  = $buffer[5];
            $this->m['TOUR DE BRAS']  = $buffer[6];
            $this->m['CEINTURE']  = $buffer[7];
            $this->m['BASSIN']  = $buffer[8];
            $this->m['LONGEUR GENOU']  = $buffer[9];
            $this->m['TOUR DE GENOU']  = $buffer[10];
            $this->m['TOUR DE CUISSE']  = $buffer[11];
            $this->m['LONGUEUR PANTALON']  = $buffer[12];
            $this->m['BAS']  = $buffer[13];
            $this->m['CARRURE DEVANT']  = $buffer[14];
            $this->m['CARRURE DOS']  = $buffer[15];
        }else
        {
           $this->m = $this->m;
        }

       
        $this->isModalOpenMensuration = true;
     
       
    }

    public function closeModalMensuration(){
        $this->client_id  = $this->clients['id'];
    
        $this->isModalOpenMensuration = false;
        $this->mensuration = $this->m;
        $buffer = "";
        foreach($this->mensuration as $key => $item){
            if($item == ""){
                $item = "X";
            }

            $buffer = $buffer."".$item."/";
        }
       
        $mensurations = Mensuration::updateOrCreate(['clients_id' =>   $this->client_id], [
            'mensuration' => $buffer,
        ]);
    }



    public function addProduitCommande($id){
        $this->isModalOpenDeatille = true;
        $this->commande_id = $id;
        $this->detailles = Detaille::where('commande_id',$this->commande_id)->get();
        $cpt = 0;
        if($this->detailles){
            foreach($this->detailles as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
       }
        $this->totalDetaille = $cpt;
       
    }

    public function addArticleToDetaille(){
        $this->validate([
            'libelle_detaille' => 'required',
            'qt' => 'required',
            'prix_u' => 'required'
        ]);

        $detaille = new Detaille();

        $detaille->libelle =  $this->libelle_detaille;
        $detaille->qt = $this->qt;
        $detaille->prix_u = $this->prix_u;
        $detaille->commande_id = $this->commande_id;
        $detaille->save();
        $this->detailles = Detaille::where('commande_id',$this->commande_id)->get();
        $cpt = 0;
        if($this->detailles){
            foreach($this->detailles as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
       }
        $this->totalDetaille = $cpt;
        session()->flash('ajout', 'Article ajouté.');
    }

    public function deleteDetaille($id){
        Detaille::find($id)->delete();
        $this->detailles = Detaille::where('commande_id',$this->commande_id)->get();
        $cpt = 0;
        if($this->detailles){
            foreach($this->detailles as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
       }
        $this->totalDetaille = $cpt;
        session()->flash('delete', 'Article retiré a la commande.');
    }

    public function closeModalDetaille(){
        $this->libelle_detaille = "";
        $this->qt = "";
        $this->prix_u = "";
        $this->isModalOpenDeatille = false;
    }
    

    public function imprimer($id){
        return redirect()->route('imprimer_commande_atelier',['id'=>$id,'idClient'=>  $this->client_id]);
      
    }





}
