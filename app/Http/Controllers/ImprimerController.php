<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\CommandeBoutique;
use App\Models\CommandeBoutiqueDetails;
use App\Models\Commande;
use App\Models\Client;
use PDF;
class ImprimerController extends Controller
{

    public function showFacture(Request $request){
      
        $commande = CommandeBoutique::find($request->id)->toArray();
        $details = CommandeBoutiqueDetails::where('commande_boutique_id',$request->id)->get()->toArray();
        $image = base64_encode(file_get_contents(public_path('/img/logo1.png')));
        $qr = base64_encode(file_get_contents(public_path('/img/qr2.png')));
        $newArray = array();
        foreach($details as $item){
             $produit = Produit::find($item['id_produit']);
             $item["libelle_produit"] = $produit->libelle;
             array_push($newArray,$item);
             
        }

        //dd($newArray);
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a5",
            "dpi" => 130
        ]);
        $customPaper = array(0,0,650.00,400.80);
        $pdf = PDF::loadView('livewire.facture',['image' => $image,'commande'=>$commande,'details'=>$newArray,'qr'=>$qr])->setPaper($customPaper,'landscape');
        return $pdf->stream('invoice.pdf');
    }


    public function showFactureCommande(Request $request){

       $client = Client::where('id',$request->idClient)->first();
        //dd($client);
        $mycommande = Commande::where('id',$request->id)->with('detaille')->first();
        $cpt = 0;
        if($mycommande->detaille){
            foreach($mycommande->detaille as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
       }
        
        $totalDetaille = $cpt;
       //dd($mycommande);
        $image = base64_encode(file_get_contents(public_path('/img/logo1.png')));
        $qr = base64_encode(file_get_contents(public_path('/img/qr2.png')));
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a5",
            "dpi" => 130
        ]);
        $customPaper = array(0,0,650.00,400.80);
        $pdf = PDF::loadView('livewire.facture_atelier',['image' => $image,'qr'=>$qr,'mycommande'=>$mycommande,'totalDetaille'=>$totalDetaille,'client'=>$client])->setPaper($customPaper,'landscape');
        dd($pdf);
        return $pdf->stream('facture_atelier.pdf');
    }

}