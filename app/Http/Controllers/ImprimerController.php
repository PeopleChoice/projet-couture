<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\CommandeBoutique;
use App\Models\CommandeBoutiqueDetails;
use App\Models\Commande;
use App\Models\Client;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
      
        $mycommande = Commande::where('id',$request->id)->with('detaille')->with('acompte_commande')->first();
        $cpt = 0;
        $cpt1 = 0;
        if($mycommande->detaille){
            foreach($mycommande->detaille as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
        }

        if($mycommande->acompte_commande){
            foreach($mycommande->acompte_commande as $item){
              $cpt1 = $cpt1 +  $item->prix;
        }
       }
        
        $totalDetaille = $cpt;
        $totalacommpte = $cpt1;
       
        $image = base64_encode(file_get_contents(public_path('/img/logo1.png')));
        // $qr = base64_encode(file_get_contents(public_path('/img/qr2.png')));
        $qr = "http://127.0.0.1:8000/commandes/".$mycommande->id;
        $qr = QrCode::size(400)->generate($qr);
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a5",
            "dpi" => 130
        ]);
        $customPaper = array(0,0,650.00,400.80);
        $pdf = PDF::loadView('livewire.facture_atelier',['image' => 
                                                                $image,'qr'=>$qr,
                                                                'mycommande'=>$mycommande,
                                                                'totalDetaille'=>$totalDetaille,
                                                                'totalacommpte'=>$totalacommpte,
                                                                'client'=>$client])->setPaper($customPaper,'landscape');
        
        return $pdf->stream('facture_atelier.pdf');
    }



    public function showCommande(Request $request){
        
        $commande = Commande::with('client')->with('detaille')->with('acompte_commande')->where('id',(int)$request->id)->first();

        
          $cpt = 0;
        $cpt1 = 0;
        if($commande->detaille){
            foreach($commande->detaille as $item){
              $cpt = $cpt + ($item->qt * $item->prix_u);
        }
        }

        if($commande->acompte_commande){
            foreach($commande->acompte_commande as $item){
              $cpt1 = $cpt1 +  $item->prix;
        }
       }
        
        $totalDetaille = $cpt;
        $totalacommpte = $cpt1;


       
        return view('infos',compact('commande','totalDetaille','totalacommpte'));
    }

}