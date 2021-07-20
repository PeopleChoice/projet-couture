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
    public $libelle,$image,$qt,$prix,$description,$categorie_id;
    public $produit_id;
    public function render()
    {
        $this->allCategorie = Categorie::get();
        $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.boutique.produit.produit', ['Produits'=> Produit::with('categorie')->where('libelle','like',$searchTerms)->paginate(10),"allCategorie"=>$this->allCategorie]);
    }

    public function create(){
        $this->labelle = "";
        $this->image = "";
        $this->qt = "";
        $this->prix = "";
        $this->description = "";
        $this->categorie_id = "";
        $this->isModalOpen = true;
    }

    public function save(){
        $this->validate([
            'libelle' => 'required',
            'image' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024',
            'qt'=>'required',
            'prix'=>'required',
            'description'=>'required|max:255',
            'categorie_id'=>'required'
           
        ]);

        $imageName = time().'.'.$this->image->extension();
        $filPath = \public_path('storage/images');
        $img = Image::make($this->image->path());
        $img->resize(110,150,function($const){
            $const->aspectRatio();
        })->save($filPath."/".$imageName);
       

        $categorie = Produit::updateOrCreate(['id' => $this->produit_id], [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'image' =>  $imageName,
            'qt'=> $this->qt,
            'prix'=> $this->prix,
            'categories_id'=>$this->categorie_id
        ]);

        $this->isModalOpen = false;
        session()->flash('message', $this->produit_id ? ' Produit modifié.' : 'Produit ajouté.');
    }

    public function close(){
        $this->isModalOpen = false;
    }

    public function edit($id){
        $produit = Produit::findOrFail($id);

        $this->produit_id = $id;
        $this->labelle = $produit->libelle;
        $this->qt = $produit->qt;
        $this->prix = $produit->prix;
        $this->description = $produit->description;
        $this->isModalOpen = true;
    }
    public function delete($id){
        Produit::find($id)->delete();
        $this->isModalOpen = false;
        session()->flash('message', 'Categorie supprimée.');
    }

}
