<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\RestaurantsController;
use App\Http\Livewire\RoleController;
use App\Http\Livewire\Home;
use App\Http\Livewire\ClientController;
use App\Http\Livewire\CommandeController;
use App\Http\Livewire\DecouverteController;
use App\Http\Controllers\printController;
use App\Http\Livewire\DepenseController;
use App\Http\Livewire\PrestationController;
use App\Http\Livewire\PrestationDeatails;
use App\Http\Livewire\DashBoard;
use App\Http\Livewire\DashBoard1;
use App\Http\Livewire\Boutique;
use App\Http\Livewire\CategorieController;
use App\Http\Livewire\ProduitController;
use App\Http\Controllers\ImprimerController;
use App\Http\Livewire\CommandeBoutiqueController;
use App\Http\Livewire\UserController;
use App\Http\Livewire\InventaireDepense;

use PDF as pdf;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

 Route::get('/roles_index',RoleController::class,'__invoke')->name('roles_index')->middleware('auth');
 Route::get('/utilisateur',UserController::class,'__invoke')->name('utilisateur')->middleware('auth');
Auth::routes();
Route::get('/imprimer/{id}','App\Http\Controllers\ImprimerController@showFacture')->name('imprimer');
Route::get('/imprimer_commande_atelier/{id}/{idClient}','App\Http\Controllers\ImprimerController@showFactureCommande')->name('imprimer_commande_atelier');


Route::get('/home', DashBoard::class, '__invoke' )->name('home');
Route::get('/home1', DashBoard1::class, '__invoke' )->name('home1');
//decouverte
Route::get('decouverte', DecouverteController::class,'__invoke')->name('decouverte');


//depense
Route::get('depense',DepenseController::class,'__invoke')->name('depense');


//client
Route::get('clients', ClientController::class,'__invoke')->name('clients');
Route::get('commandes/{id}', CommandeController::class,'__invoke')->name('commandes');
// Route::get('imprimer/{id}', CommandeController::class,'imprimer')->name('imprimer');

//prestation
Route::get('prestation',PrestationController::class,'__invoke')->name('prestation');
Route::get('details-prestations/{id}',PrestationDeatails::class,'__invoke')->name('details-prestations');


//dashboard
Route::get('dashboard',DashBoard::class,'__invoke')->name('dashboard');



//Boutique
Route::get('boutique',Boutique::class,'__invoke')->name('boutique');
Route::get('produit',ProduitController::class,'__invoke')->name('produit');
Route::get('categorie',CategorieController::class,'__invoke')->name('categorie');

//BoutiqueCommande


Route::get('boutiqueCommande',CommandeBoutiqueController::class,'__invoke')->name('boutiqueCommande');




//inventaire


Route::get('inventaireDepense',InventaireDepense::class,'__invoke')->name('inventaireDepense');