<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prestataire;
use App\Models\DetailsPrestation;
use Livewire\WithPagination;
use Carbon\Carbon;
class PrestationDeatails extends Component
{ 
    use WithPagination;
    public $prestataire_id;
    public $prestataire;
    public $searchTerms;
    public $isModalOpen = 0;
    public $date_prestation,$prix,$qt,$libelle,$status,$acompte;
    public $detaille_id;
    public function mount($id){
        $this->prestataire_id = $id ? $id :   $this->prestataire_id ;
        $buffer = Prestataire::where('id', $this->prestataire_id)->get()->toArray();
        $this->prestataire = $buffer[0];
        
    }
    public function render()
    {
        $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.prestataire.prestation-deatails', ['prestations'=> DetailsPrestation::where('prestataires_id', $this->prestataire_id)->where('date_prestation','like',$searchTerms)->paginate(10)]);
    }


    public function create()
    {
        $this->prestataire_id  = $this->prestataire['id'];
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->date_prestation = '';
        $this->prix = '';
        $this->qt = '';
        $this->libelle = '';
        $this->status = '';



  }

  public function store()
  {
      $this->prestataire_id  = $this->prestataire['id'];
      $this->date_prestation = $this->date_prestation ? $this->date_prestation : Carbon::parse(now())->format('Y-m-d');
      $this->validate([
          'libelle' => 'required',
          'prix' => 'required',
          'qt'=>'required',
          'status' => 'required',
         
      ]);
   
        
      
      DetailsPrestation::updateOrCreate(['id' => $this->detaille_id], [
          'date_prestation' => $this->date_prestation,
          'libelle' => $this->libelle,
          'prix' => $this->prix,
          'qt'=> $this->qt,
          'status' => $this->status,
          'prestataires_id'=>$this->prestataire_id,
          'acompte'=>0
           
      ]);

      session()->flash('message', $this->detaille_id ? ' Prestaion updated.' : 'Prestaion created.');
          
 

      $this->closeModalPopover();
      $this->resetCreateForm();
  }

  public function edit($id)
  {
      $this->prestataire_id  = $this->prestataire['id'];
      $prestationDetaille = DetailsPrestation::findOrFail($id);

      $this->detaille_id = $id;
      $this->date_prestation =  $prestationDetaille->date_prestation;
      $this->libelle = $prestationDetaille->libelle;
      $this->prix = $prestationDetaille->prix;
      $this->status  = $prestationDetaille->status;
      $this->qt = $prestationDetaille->qt;
  
      
  
      $this->openModalPopover();
  }


  public function deleteDetaille($id){
    DetailsPrestation::find($id)->delete();
   
    
    session()->flash('delete', 'Article retiré a la commande.');
}

public function changeacompte($id,$field){
      

     $prestationDetaille = DetailsPrestation::findOrFail($id);
     if(((int)$prestationDetaille->qt * (int)$prestationDetaille->prix) == $field){
        $prestationDetaille->status = 1;
     }else{
        $prestationDetaille->status = 2;
     }

      $prestationDetaille->acompte = $field;
      //dd($prestationDetaille);
      DetailsPrestation::updateOrCreate(['id' => $id],$prestationDetaille->toArray());

}

}
    
