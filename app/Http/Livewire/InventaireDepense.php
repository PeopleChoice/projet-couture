<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depense;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class InventaireDepense extends Component
{   
    public $sommes = 0;
    public $date_debut ;
    public $date_fin ;
    public $libelle;
    public $depenses;
   use WithPagination;
    public $html ;
    public $rendu;
    public $libellArray = array(
        "Courant", 
        "Paquetage",
        "Parfum", 
        "Eau", 
        "Salaire",
        "Location", 
        "Dépenses diverses",
        "Fourniture atelier",
          "Popeline", 
          "Paquetage", 
          "Soy",
          "Faille", 
          "Renfort",
          "Dépenses diverses",
          "Salaire",
      "Électricité",
      "Location"
        
      );
  
    public function render()
    {
                if($this->libelle)
                {
                    $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])
                    ->where('libelle',$this->libelle)->get()->toArray();
                }else{
                    $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])
                    ->get()->toArray();
                }
                
              
                $somme = 0;
                foreach($this->depenses as $i ){
                    
                $somme = $somme + ($i["qt"] * $i["prix"]);
                }
                
                $this->sommes = $somme;
                return view('livewire.inventaire.depense.index',
                                                        [
                                                            'depenses'=> $this->depenses,
                                                            'sommes'=>  $this->sommes
                                                        ]
                            );
              
           
    }



    public function filter(){
       
        $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])
        ->get()->toArray();
        dd($this->depenses);
    
        $somme = 0;
        foreach($this->depenses as $i ){
            
            $somme = $somme + ($i["qt"] * $i["prix"]);

        }

        $this->sommes = $somme;
    }
    
   
    
    

    public function updating(){
        $this->depenses =  $this->depenses;

    }


}
