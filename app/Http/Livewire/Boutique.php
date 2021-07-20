<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\CommandeBoutique;
use App\Models\CommandeBoutiqueDetails;
use Livewire\WithPagination;
use Carbon\Carbon;

class Boutique extends Component
{
    use WithPagination;
    public $categorie_id;
    public $panier =array();
    public $isFirst=0;
    public $isSeconde = 0;
    public $isImprimer = 0;
    public $showCommande = true;
    public $showpayement = false;
    public $remise = 0;
    public $commande_id;
    public $nom="diop",$prenom="cheikh",$telephone="telephone",$adresse="thies",$email="cheikh@gmail.com",$date_commande;
    public function render()
    {
        if(\sizeof($this->panier) >= 1){
            if($this->isSeconde){
                $this->isFirst=false;
            }else{
                $this->isFirst=true;
            }
           
        }
        else{
            $this->isFirst=false;
        }
        if($this->categorie_id)
        {
            return view('livewire.boutique.boutique',['produits'=>Produit::where('categories_id',$this->categorie_id)->paginate(10),'allCategorie'=>Categorie::get()]);
        }else{
            return view('livewire.boutique.boutique',['produits'=>Produit::paginate(10),'allCategorie'=>Categorie::get()]);
        }
       
    }

    public function addPanier($item){
        $newProd = array("id"=>$item['id'],"libelle"=>$item['libelle'],"qt"=> 1,"prix"=>$item['prix']);
       
        if(\sizeof($this->panier)>0){
            $newItem = array();
            $cpt = 0;
            foreach($this->panier as $item1){
                   
                  if((int)$item["id"] === (int)$item1["id"]){
                   
                    $item1["qt"] = (int)$item1["qt"]  + 1;
                    \array_push($newItem, $item1);
                   
                    $cpt = $cpt + 1;
                  }else{
                    \array_push($newItem,$item1);
                  }
                  
            }

          
            if($cpt == 0){
                \array_push($newItem, $newProd);
            }
           
            $this->panier = $newItem;
        }else{
            \array_push($this->panier,$newProd);
        }
       
    
    }

    public function addPanier1($item){

        $newItem = array();
        $cpt = 0;
        foreach($this->panier as $item1){
               
              if((int)$item === (int)$item1["id"]){
               
                $item1["qt"] = (int)$item1["qt"]  + 1;
                \array_push($newItem, $item1);
               
                $cpt = $cpt + 1;
              }else{
                \array_push($newItem,$item1);
              }
              
        }

      
        if($cpt == 0){
            \array_push($newItem, $newProd);
        }
        $this->panier = $newItem;
    }

    public function delete($id){
        $newItem = array();

        foreach($this->panier as $item){
             if((int)$item['id'] != (int)$id){
                 array_push($newItem,$item);
             }else{
                 if($item['qt']  > 0){
                      $item['qt'] =  $item['qt'] - 1;
                      array_push($newItem,$item);
                 }
             }

        }

        $this->panier = $newItem;
    }

    public function suivant(){
      
        $this->isFirst=false;
        $this->isSeconde = true;
        $this->showCommande = false;
        $this->showpayement = true;
    }
    public function retour(){
        $this->isFirst=true;
        $this->isSeconde = 0;
        $this->showCommande = true;
        $this->showpayement = false;
    }

    public function valider_commande(){
        if(\sizeof($this->panier) > 0){
            $this->date_commande = $this->date_commande ? $this->date_commande : Carbon::parse(now())->format('Y-m-d');
            $this->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'telephone'=> 'required',
            ]);
         
              
            
            $commande = CommandeBoutique::updateOrCreate(['id' => $this->commande_id], [
                'date_commande' => $this->date_commande,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'tel' => $this->telephone,
                'adresse' => $this->adresse,
                'email' => $this->email,
                'remise' => $this->remise
                 
            ]);
           
            if($commande->id){
                foreach($this->panier as $item){
                    CommandeBoutiqueDetails::create([
                        "prix"=>$item["prix"],
                        "qt"=>$item["qt"],
                        "id_produit"=>$item["id"],
                        "commande_boutique_id"=>$commande->id
                    ]);
                }

                foreach($this->panier as $item1){
                    $recup = Produit::find((int)$item1["id"]);
                    if($recup){
                        $newQt = $recup->qt - $item1['qt']; 
                        Produit::where('id',$item1['id'])->update(['qt'=>$newQt]);
                    }
                }

            }


    
            $this->isFirst=true;
            $this->isSeconde = 0;
            $this->showCommande = true;
            $this->showpayement = false;
            $this->panier = [];
            return   session()->flash('message', 'Commande valider !');
        }else{
            return   session()->flash('message', 'Ajouter des produits svp');
        }
    }


    public function recupeChange(){
          $this->remise;
    }

    public function imprimer(){
      return redirect()->route('imprimer');
    }

 
}
