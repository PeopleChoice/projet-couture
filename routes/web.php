<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\RestaurantsController;
use App\Http\Livewire\RoleController;
use App\Http\Livewire\Home;

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
Auth::routes();

Route::get('/home', Home::class, '__invoke' )->name('home');
