<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Decouverte;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Image;
class DecouverteController extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $isModalOpen = 0;
    public $isModalImage = 0;
    public $libelle,$description,$image,$decouvert_id;
    public $decouvertes;
    public $searchTerms;
    public $imageRecup = "t.jpg";
  
    public function render()
    {
        $searchTerms = "%".$this->searchTerms."%";

        return view('livewire.decouverte.decouverte', ['AllData'=> Decouverte::where('libelle','like',$searchTerms)->paginate(8)]);
    }


    public function create(){
     $this->isModalOpen = true;
    }


    public function store(){
        $this->validate([
            'libelle' => 'required',
            'image' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024'
           
        ]);

        $imageName = time().'.'.$this->image->extension();
        $filPath = \public_path('storage/images');
        $img = Image::make($this->image->path());
        $img->resize(1000,600,function($const){
            $const->aspectRatio();
        })->save($filPath."/".$imageName);
       

        $decouverte = Decouverte::updateOrCreate(['id' => $this->decouvert_id], [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'image' =>  $imageName,
        ]);
        $this->isModalOpen = false;
        $this->libelle = "";
        $this->description = "";
        $this->image = "";
        session()->flash('message', 'Une image ajouté  à la decouverte');
      
    }

    public function openImage($recup,$extension){
        $ext = ".jpg";
        if($extension == 1){
            $ext = ".jpg";
          }else if($extension ==2){
            $ext = ".png";
          }else{
            $ext = ".jpeg";
          }
        $recup = $recup."".$ext;
      
        $this->isModalImage = true;
        $this->imageRecup =$recup;
    }

    public function closeModalImage(){
        $this->isModalImage = false;
    }

    public function closeModalPopover(){
        $this->isModalOpen = false;
        $this->libelle = "";
        $this->description = "";
        $this->image = "";
    }

    
}
