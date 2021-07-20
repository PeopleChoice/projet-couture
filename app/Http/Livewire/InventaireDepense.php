<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depense;
use Livewire\WithPagination;
class InventaireDepense extends Component
{   
    public $sommes = 0;
    public $date_debut ;
    public $date_fin ;

    public $depenses;
   // use WithPagination;
    public $html ;
    public $rendu;
  
    public function render()
    {
                $this->depenses = Depense::get()->toArray();
                //dd($this->depenses);
    
                $somme = 0;
                foreach($this->depenses as $i ){
                $somme = $somme + ($i["qt"] * $i["prix"]);
                }
                
                $this->sommes = $somme;

                return view('livewire.inventaire.depense.inventaire-depense');
              
           
    }



    public function filter(){
        $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])
        ->get()->toArray();

       // dd($this->allDepenses);

        $somme = 0;
        foreach ($this->depenses as $i ){
            $somme = $somme + ($i["qt"] * $i["prix"]);
        }
        
        $this->sommes = $somme;
    //     return view('livewire.inventaire.depense.inventaire-depense',\compact('allDepenses','sommeDepense'));
    }


}
