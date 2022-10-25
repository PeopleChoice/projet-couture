<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produit;
use App\Models\Categorie;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;
class ProduitController extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $searchTerms; 
    public $isModalOpen = 0;
    public  $allCategorie;
    public $libelle,$image,$qt,$prix,$description,$categories_id,$taille;
    public $produit_id;

  
    public $libelle_array = array("Chemise simple",
        "Caftan simple",
        "Ensemble chemise pantalon",
        "Pantalon supercent", 
        "Tourki simple",
        "Tourki original", 
        "Ensemble wax", 
        "Grand Boubou",
        "Sabador", 
        "Ensemble Costume",
        "Caftan enfant 2ans", 
        "Caftan enfant  4ans 6ans", 
        "Caftan enfant 8 ans 12 ans", 
    );


    public $taille_array = array("S","M","L","XL","XXL","XXXL");

    public function render()
    {
        $this->allCategorie = Categorie::get();
        $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.boutique.produit.produit', ['Produits'=> Produit::with('categories')->get(),"allCategorie"=>$this->allCategorie]);
    }

    public function create(){
        $this->labelle = "";
        $this->image = "";
        $this->qt = "";
        $this->prix = "";
        $this->description = "";
        $this->categories_id = "";
        $this->taille = "";
        $this->isModalOpen = true;
        $this->emit('showModalproduit');
    }

    public function save(){

        $this->validate([
            'libelle' => 'required',
            'image' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024',
            'qt'=>'required',
            'prix'=>'required',
            'taille'=>'required',
            'categories_id'=>'required'
           
        ]);

        $imageName = time().'.'.$this->image->extension();
        $filPath = \public_path('storage/images');
        $img = Image::make($this->image->path());
        $img->resize(1000,600,function($const){
            $const->aspectRatio();
        })->save($filPath."/".$imageName);
       

        $categorie = Produit::updateOrCreate(['id' => $this->produit_id], [
            'libelle' => $this->libelle,
            'description' => $this->description ? $this->description : "" ,
            'image' =>  $imageName,
            'qt'=> $this->qt,
            'prix'=> $this->prix,
            'taille' =>  $this->taille,
            'categories_id'=>$this->categories_id
        ]);
        $categorie->categories()->associate($this->categories_id);
        $categorie->save();

        $this->isModalOpen = false;
        $this->emit('hideModalproduit');
        session()->flash('message', $this->produit_id ? ' Produit modifié.' : 'Produit ajouté.');
    }

    public function close(){
        $this->isModalOpen = false;
        $this->emit('hideModalproduit');
    }

    public function edit($id){
        $produit = Produit::findOrFail($id);

        $this->produit_id = $id;
        $this->labelle = $produit->libelle;
        $this->qt = $produit->qt;
        $this->prix = $produit->prix;
        $this->taille = $produit->taille;
        $this->description = $produit->description;
        $this->isModalOpen = true;
        $this->emit('showModalproduit');
    }
    public function delete($id){
        Produit::find($id)->delete();
        $this->isModalOpen = false;
        $this->emit('hideModalproduit');
        session()->flash('message', 'Categorie supprimée.');
    }

}
 