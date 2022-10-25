<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Affectation;
use App\Models\Mensuration;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class AllCommandesController extends Component
{
    public $allCommande,$clientInfos;
    public $commande_id,$status;
    public $isOpenModalAffectation = 0;
    public $idTailleur,$totalacompte,$isModalOpens,$listeTailleurs = array();
    public $isModalOpenMensuration = 0,$isModalOpenDeatille = 0;
    public $mensuration_show,$mensuration,$client_id,$detailles,$totalDetaille;
    public $m = array('COL'=>'X','EPAULE'=>'X','MANCHE'=>'X',
    'LONGUEUR BOUBOU'=>'X','POITRINE'=>'X',
    'TOUR DE VENTRE'=>'X','TOUR DE BRAS'=>'X',
    'CEINTURE'=>'X','BASSIN'=>'X','LONGEUR GENOU'=>'X',
    'TOUR DE GENOU'=>'X','TOUR DE CUISSE'=>'X','LONGUEUR PANTALON'=>'X',
    'BAS'=>'X','CARRURE DEVANT'=>'X','CARRURE DOS'=>'X');

    public function mount(){
        $this->allCommande = array();
    }
    public function render()
    {
        $user = Auth::user()->roles->pluck('name')->first();

        if($user != "Admin" && $user != "Gestionnaire" ){
            $allAffectation = Affectation::where('id_tailleur',Auth::user()->id)->pluck('id_commande')->toArray();
            
            $this->allCommande = Commande::where('status','<>','Termine')->whereIn('id',$allAffectation)->orderByDesc('date_commande')->get();
        

        }else{
            $this->allCommande = Commande::orderByDesc('date_commande')->get();
        }
        

       


        return view('livewire.allCommandes.index',['commandes'=> $this->allCommande]);
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
        
        $this->emit('showModalaffectation');
     }

     public function validerAffectation(){
        
         $affectation = new Affectation();
         $affectation->id_commande =  $this->commande_id;
         $affectation->id_tailleur =  $this->idTailleur;
         $affectation->date_affectation = Carbon::parse(now())->format('Y-m-d');

         $affectation->save();
         Commande::where('id',$this->commande_id)->update(["status"=>"En confection"]);
       
         $this->emit('hideModalaffectation');
         session()->flash('message', 'Affectation effectué');

     }

     public function infos($id){
             $this->clientInfos = Client::where('id',$id)->first();
           
             $this->emit("showModalinfosclient");
     }


     public function changeStatus($id){
        if($this->status){
            Commande::where('id',$id)->update(["status"=>$this->status]);
            session()->flash('message', 'Changement effectué');
        }else{
            session()->flash('error', 'Merci de verifier la selection');
        }
       
     }
     public function openMensuration($id)
     {
         
 
        
        $this->client_id = $id;
         $commande = Mensuration::find($id);
      
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

    //  public function showCommande($id){
          
    //     $this->mycommande = Commande::where('id',$id)->with('detaille')->first();
    //     $this->commande_id = $id;
    //      $this->detailles = Detaille::where('commande_id',$this->commande_id)->get();
    //      $cpt = 0;
    //      if($this->detailles){
    //          foreach($this->detailles as $item){
    //          $cpt = $cpt + ($item->qt * $item->prix_u);
    //      }
    //     }
    //      $this->totalDetaille = $cpt;
    //      $this->isModalOpenDeatille = true;
    //      $this->emit("showModalpanier");
      
    // }

    public function facture($id,$client_id){
        $this->client_id = $client_id;
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

    public function closeModalPopovershow()
    {
        $this->isModalOpens = false;
        $this->emit("hideModalshowcommande");
       
    }

    public function imprimer($id){
        return redirect()->route('imprimer_commande_atelier',['id'=>$id,'idClient'=>  $this->client_id]);
      
    }




 
}
