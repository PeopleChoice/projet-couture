<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
class InventaireDepenseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $depenses = Depense::get();
        $somme = 0;
        foreach($depenses as $i ){
            
        $somme = $somme + ($i["qt"] * $i["prix"]);
        }
                
        return view('livewire.inventaire.depense.inventaire-depense',
                [
                    'depenses'=>   $depenses,
                    'sommes'=>$somme
                ]
            );
    }


    public function filtre(Request $request){

        $depenses = Depense::whereBetween('date_enreg',[$request->date_debut,$request->date_fin])->get();
        $somme = 0;
        foreach($depenses as $i ){
            
        $somme = $somme + ($i["qt"] * $i["prix"]);
        }
      
       $html ="";
       $html = $html ."<tr>";
        foreach($depenses as $i ){


            $html = $html ."<td class='border px-4 py-2'>". $i['date_enreg'] ."</td>";
            $html = $html ."<td class='border px-4 py-2'>". $i['libelle'] ."</td>";
            $html = $html ."<td class='border px-4 py-2'>". $i['description'] ."</td>";
            $html = $html ."<td class='border px-4 py-2'>". $i['qt'] ."</td>";
            $html = $html ."<td class='border px-4 py-2'>". $i['prix'] ."</td>";
            $html = $html ."<td class='border px-4 py-2'>". $i['qt'] * $i['prix'] ."</td>";
         
        }
        $html = $html ."/<tr>";

   
        $somme = "<b>".$somme ." Franc cfa</b>";
        return array("total"=>$somme,"content"=>$html);
       
    }
}
