<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Depense;
use Carbon\Carbon;
class DepenseController extends Component
{
    use WithPagination;
    public $searchTerms;
    public $libelle, $description, $qt, $prix, $date_enreg,$depense_id;
    public $isModalOpenFormDepense = 0;
    public $isShow = 0;
    public $newProduit;
    public $totalDepense = 0;
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
        //dd("hhh");
       
        
        $this->emit('title', "Dépenses");
        if($this->searchTerms)
        {
            $alldata = Depense::where('date_enreg',$this->searchTerms)->get();
       
            $this->totalDepense = 0;
            foreach($alldata as $item){
                $this->totalDepense = $this->totalDepense + ($item->prix * $item->qt);
            }
            return view('livewire.depensefolder.depense-controller', ['AllData'=> Depense::where('date_enreg',$this->searchTerms)->paginate(10),"totalDepense"=> $this->totalDepense]);
        }else{
            $alldata = Depense::get();
            $this->totalDepense = 0;
            foreach($alldata as $item){
                $this->totalDepense = $this->totalDepense + ($item->prix * $item->qt);
            }

            return view('livewire.depensefolder.depense-controller', ['AllData'=> Depense::paginate(10),"totalDepense"=> $this->totalDepense]);
        }
      
    }


    

    public function create()
    {
     
        $this->resetCreateForm();
        $this->openModalPopover();
       
    }

    public function openModalPopover()
    {
      
        $this->isModalOpenFormDepense = true;
        $this->emit('showModaldepense');
    }

    public function closeModalPopover()
    {
        $this->isModalOpenFormDepense = false;
        $this->emit('hideModaldepense');
    }

    public function resetCreateForm(){
        $this->libelle = '';
        $this->description = '';
        $this->qt = '';
        $this->prix = '';
        $this->date_enreg = '';
    }
    
    public function store()
    {
        $this->date_enreg = $this->date_enreg ? $this->date_enreg : Carbon::parse(now())->format('Y-m-d');
        $this->validate([
            'libelle' => 'required',
            'description' => 'required',
            'qt' => 'required',
            'prix' => 'required',
            'date_enreg' => 'required',
        ]);
    
        Depense::updateOrCreate(['id' => $this->depense_id], [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'qt' => $this->qt,
            'prix' => $this->prix,
            'date_enreg' => $this->date_enreg,
        ]);

        session()->flash('message', $this->depense_id ? 'Depense modifié.' : 'Depense ajouté.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $depense = Depense::findOrFail($id);
        $this->depense_id = $id;
        $this->libelle = $depense->libelle;
        $this->description = $depense->description;
        $this->qt = $depense->qt;
        $this->prix = $depense->prix;
        $this->date_enreg= $depense->date_enreg;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {

        Depense::find($id)->delete();
        session()->flash('message', 'Depense supprimer.');
    }


    public function addProduit(){
          if($this->libelle == "new"){
            $this->isShow = true;
            $this->openModalPopover();
          }else{
            $this->openModalPopover();
          }
    }

    public function saveProduit(){
        array_push($this->libellArray,$this->newProduit);

        //$this->newProduit = "";
        $this->isShow = false;
    }

    
}
