<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorie;
use Livewire\WithPagination;
class CategorieController extends Component
{
    
    use WithPagination;
    public $libelle_categorie,$id_categorie;
    public $searchTerms;
    public function render()
    {
        $allCategorie  = Categorie::get();
        $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.boutique.categorie.categorie',["allCategorie"=> Categorie::where('libelle','like',$searchTerms)->paginate(10)]);
    }

     public function create(){
         $this->emit('showModalacatgorie');
     }


     public function closeModalCategorie(){
        $this->emit('hideModalacatgorie');
     }


     public function save(){
        
         $this->validate([
            'libelle_categorie' => 'required',
           
        ]);
     
          
        
        $categorie = Categorie::updateOrCreate(['id' => $this->id_categorie], [
            'libelle' =>$this->libelle_categorie
        ]);
        $this->emit('hideModalacatgorie');
        session()->flash('message', $this->id_categorie ? ' Categorie modifiée.' : 'Categorie ajouté.');
     }

     public function edit($id){
       
        $categorie = Categorie::findOrFail($id);

        $this->id_categorie = $id;
        $this->libelle_categorie =  $categorie->libelle;
        $this->isModalOpen = true;
        $this->emit('showModalacatgorie');
     }


     public function delete($id)
     {
        
         Categorie::find($id)->delete();
         $this->isModalOpen = false;
         session()->flash('message', 'Categorie supprimée.');
     }



}
