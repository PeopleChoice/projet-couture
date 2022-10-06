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

    public $depenses;
   use WithPagination;
    public $html ;
    public $rendu;
  
    public function render()
    {
                // $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])
                //     ->get()->toArray();
              
                // $somme = 0;
                // foreach($this->depenses as $i ){
                    
                // $somme = $somme + ($i["qt"] * $i["prix"]);
                // }
                
                // $this->sommes = $somme;
                // ['clients'=> Client::where('mobile','like',$searchTerms)->paginate(10)]
                // $this->depenses = Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])->paginate(10);
               
                return view('livewire.inventaire.depense.inventaire-depense',
                                                        [
                                                            'depenses'=> Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])->paginate(10)
                                                        ]
                            );
              
           
    }



    public function filter(){


        return view('livewire.inventaire.depense.inventaire-depense',
                                                        [
                                                            'depenses'=> Depense::whereBetween('date_enreg',[$this->date_debut,$this->date_fin])->paginate(10)
                                                        ]
                            );
    }

    public function updating(){
        $this->depenses =  $this->depenses;

    }


}
