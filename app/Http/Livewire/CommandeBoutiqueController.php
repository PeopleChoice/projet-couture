<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\CommandeBoutique;
use App\Models\CommandeBoutiqueDetails;
use Livewire\WithPagination;
use Carbon\Carbon;

class CommandeBoutiqueController extends Component
{
   public $searchTerms;
   public $isModalShow = 0;
   public $details = array();
   public $remise = 0;
   public $id_commande ;
   public function render(){
    $searchTerms = "%".$this->searchTerms."%";
    return view('livewire.boutique.commandes.index',['commandes'=>CommandeBoutique::where('date_commande','like',$searchTerms)
                                                                                   ->orWhere('nom','like',$searchTerms)
                                                                                   ->orWhere('prenom','like',$searchTerms)
                                                                                   ->orWhere('email','like',$searchTerms)
                                                                                   ->orWhere('tel','like',$searchTerms)
                                                                                   ->orWhere('adresse','like',$searchTerms)
                                                                                   ->paginate(10)]);
   }


   public function show($id,$remise){
       $this->details = CommandeBoutiqueDetails::where('commande_boutique_id',$id)->get()->toArray();
       $this->remise = $remise;
       $this->id_commande = $id;
       $this->isModalShow = true;
     
   }


   public function close(){
       $this->isModalShow = false;
   }

   public function imprimer(){
    $this->isModalShow = false;
    return redirect()->route('imprimer',['id'=>$this->id_commande]);
   }
}