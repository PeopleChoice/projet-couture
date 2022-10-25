<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Mail\MailCommande;
use Livewire\Component;
use App\Models\Client;
use App\Models\Commande;
use App\Models\AcompteCommande;
use App\Models\Mensuration;
use App\Models\Detaille;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use PDF;
use DateTime;
use App\Models\User;
use App\Models\Affectation;
use Mail;
class CommandeController extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $isModalOpen = 0;
    public $isModalOpens = 0;
    public $isModalOpenMensuration = 0;
    public $mensuration_show;
    public $isModalOpenDeatille = 0;
    public $isModalOpenList = 0;
    public $commande_id,$client_id,$clients; 
    public $mycommande;
    public $idTailleur;
    public $listeTailleurs = array();
    public $isOpenModalAffectation = 0;
    public $searchTerms ;
    public $montant_acompte = 0;
    public $message = "test";
    public $showSpiner = 0;
    public $prix_u,$qt,$libelle_detaille,$detailles,$totalDetaille,$totalacompte,$payer = 0,$total=0;
    public $date_commande,$date_livraison,$mensuration,$libelle,$accompt=0,$remise = 0,$status;
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
        $this->message = "";
        
    }
    public function render()
    {

        return view('livewire.commande.commande', ['commandes'=> Commande::where('clients_id', $this->client_id)->with("detaille")->with("acompte_commande")->orderByDesc('date_commande')->paginate(10)]);
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
        $this->emit('showModalcommande');
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
        $this->emit('hideModalcommande');
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
          $this->status = '';


    }

   
    public function store()
    {
        $this->showSpiner = true;
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

    
        if($this->commande_id != null){
            $commandee = Commande::where('id',$this->commande_id)->update([
                'date_commande' => $this->date_commande,
                'date_livraison' => $this->date_livraison,
                'remise' => $this->remise,
                'libelle' => $this->libelle,
                // 'accompt' => $this->accompt,
                'status' => $this->status,
                'clients_id'=>$this->client_id,
                // 'payer' => $this->payer = 0 ;
                 
            ]);
        
        }else{
            // $code = env('PREFIX');
            $code = str_replace(" ","",str_replace(':','',str_replace('-','',date("Y-m-d H:i"))));
            
           
            $commandee = Commande::create([
                'date_commande' => $this->date_commande,
                'date_livraison' => $this->date_livraison,
                'remise' => $this->remise,
                'libelle' => $this->libelle,
                'code' => $code,
                'status' => $this->status,
                'clients_id'=>$this->client_id,
                'payer' => 0
                 
            ]);
            

        }
        Mail::to('cheikhtidianediop987@gmail.com')->send(new MailCommande($this->commande_id));
      
        session()->flash('message', $this->commande_id ? ' Commande updated.' : 'Commande created.');
        $this->commande_id = "";
   

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function verif_date(){
        
        $date = new DateTime($this->date_livraison);
        $week = $date->format("W");
        $date_recup = $this->getStartAndEndDate($week);
      
    
        $nbr = count(Commande::whereBetween('date_livraison',[$date_recup['week_start'],$date_recup['week_end']])->get());

        
        $this->message = "Attention vous avez (".$nbr.") commandes a livrer pour la semaine du ".$date_recup['week_start']." au ".$date_recup['week_end'];
        
        
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
            $this->isModalOpenDeatille = true;
            $this->emit("showModalpanier");
         
    }


    public function facture($id){
        $this->mycommande = Commande::where('id',$id)->with('detaille')->with('acompte_commande')->first();
        $cpt = 0;
        $acompte = 0;
        if(count($this->mycommande->acompte_commande) > 0)
        {
          foreach ($this->mycommande->acompte_commande as $key => $value) {
           $acompte = $acompte + (int) $value->prix;
           }
        }
      
        $this->totalacompte = $acompte;
        if(count($this->mycommande->detaille) > 0)
        {
            foreach($this->mycommande->detaille as $item){
                $cpt = $cpt + ($item->qt * $item->prix_u);
            }
        }
        
        $this->totalDetaille = $cpt;
        if($this->mycommande){
            $this->isModalOpens = true;
            $this->emit("showModalshowcommande");
        }
    }

    public function openMensuration()
    {
        
        $this->client_id  = $this->clients['id'];
       
     
        $commande = Mensuration::find($this->client_id);
     
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
        $this->emit("showModalmensuration");
     
       
    }

    public function closeModalMensuration(){
        $this->client_id  = $this->clients['id'];
    
        $this->isModalOpenMensuration = false;
        $this->emit("hideModalmensuration");
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


    public function showAcompte($id){
        
            $this->allAcompte = AcompteCommande::where('commande_id',$id)->get();
            $this->isModalOpenList =true;
            $this->openModalAcomptelist();
    }

    public function addAcompte($id){
        $this->commande_id = $id;
        if($this->commande_id){
            $this->openModalAcompte();
        }
    }

    public function saveAcompte(){
    
        $acompte =new AcompteCommande();
        $acompte->prix = $this->montant_acompte;
        $acompte->commande()->associate($this->commande_id);
        $acompte->save();

        $allacompte = AcompteCommande::where('commande_id',$this->commande_id)->get();
        $totalA = 0;
        foreach($allacompte as $i){ 
             $totalA = $totalA + (int)$i->prix;
        }
        $detailles = Detaille::where('commande_id',$this->commande_id)->get();
        $cpt = 0;
        if($detailles){
                foreach($detailles as $item){
                $cpt = $cpt + ($item->qt * $item->prix_u);
            }
        }
        
        $commande = Commande::where('id',$this->commande_id)->first();

        $total_a_payer = $cpt - (int)$commande->remise;

        if($totalA >= $total_a_payer){
            Commande::where('id',$this->commande_id)->update(["payer"=> 1]);
          
        }else{
            Commande::where('id',$this->commande_id)->update(["payer"=> 0]);
        }


        $this->closeModalAcompte();
        session()->flash('message', 'Acompte Ajouté.');
    
    }
    
    
    public function openModalAcompte()
        {
           
            $this->emit('showModalacompte');
        }
    
        public function closeModalAcompte()
        {
          
            $this->emit('hideModalacompte');
        }
        public function openModalAcomptelist()
        {
           
            $this->emit('showModalacomptelist');
        }
    
        public function closeModalAcomptelist()
        {
          
            $this->emit('hideModalacomptelist');
        }

        public function affecter($id){
           $this->commande_id = $id;
           $user  = User::get();
           $user_profil_tailleur = array();
           if($user){
            foreach ($user as $key => $value) {
                if(strtolower($value->roles->implode('name',',')) == strtolower("tailleur")){
                    
                    array_push($user_profil_tailleur,["id"=>$value->id,"name"=>$value->name]);
                }

            }
           }
           
           $this->listeTailleurs = $user_profil_tailleur;
          
           $this->emit('showModalAffectation');
        }

        public function validerAffectation(){
           
            $affectation = new Affectation();
            $affectation->id_commande =  $this->commande_id;
            $affectation->id_tailleur =  $this->idTailleur;
            $affectation->date_affectation = Carbon::parse(now())->format('Y-m-d');

            $affectation->save();
            Commande::where('id',$this->commande_id)->update(["status"=>"En confection"]);
          
            $this->emit('hideModalAffectation');
            session()->flash('message', 'Affectation effectué');

        }
         


        public function nbrSemaines($date1)
        {
    
                $date2 = date("d/m/Y");
                $debut = DateTime::createFromFormat('d/m/Y', $date1);
                $fin = DateTime::createFromFormat('d/m/Y', $date2);
                $recup =  floor($debut->diff($fin)->days/7);
                return (int) $recup;
                
        }

        function getStartAndEndDate($week) {
            $dto = new DateTime();
            $dto->setISODate(date("Y"), $week);
            $ret['week_start'] = $dto->format('Y-m-d');
            $dto->modify('+6 days');
            $ret['week_end'] = $dto->format('Y-m-d');
            return $ret;
          }


}
