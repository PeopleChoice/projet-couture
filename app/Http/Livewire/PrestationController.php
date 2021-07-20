<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prestataire;
use Livewire\WithPagination;

class PrestationController extends Component
{
  
    public $civ, $nom, $prenom, $email, $mobile,$client_id,$date_naissance,$adresse;
    public $isModalOpen = 0;
    use WithPagination;
    public $searchTerms ;
    public function render()
    {
         $this->emit('title', "Prestations");
         $searchTerms = "%".$this->searchTerms."%";
        return view('livewire.prestataire.prestation-controller', ['prestataires'=> Prestataire::where('mobile','like',$searchTerms)->paginate(10)]);
    
    }

    public function gotoDetails($id){
        return redirect()->route('details-prestations', ['id' => $id]); 
    }
    public function create()
    {
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
        $this->civ = '';
        $this->nom = '';
        $this->email = '';
        $this->mobile = '';
        $this->prenom = '';
        $this->date_naissance = '';
        $this->adresse = '';
    }
    
    public function store()
    {
      //  dd($this->adresse);
        $this->validate([
            'civ' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'adresse'=>'required'
        ]);
    
        Prestataire::updateOrCreate(['id' => $this->client_id], [
            'civ' => $this->civ,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'date_naissance' => $this->date_naissance,
            'adresse' => $this->adresse
        ]);

        session()->flash('message', $this->client_id ? 'Prestataire updated.' : 'Prestataire created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $client = Prestataire::findOrFail($id);
        $this->client_id = $id;
        $this->civ = $client->civ;
        $this->nom = $client->nom;
        $this->prenom = $client->prenom;
        $this->mobile = $client->mobile;
        $this->email= $client->email;
        $this->date_naissance = 'edit';
        $this->adresse = $client->adresse;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Prestataire::find($id)->delete();
        session()->flash('message', 'Prestataire deleted.');
    }
}
