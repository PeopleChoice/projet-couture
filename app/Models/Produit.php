<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    
    protected $fillable = ["libelle","image","qt","prix","description","categories_id","taille"];


    public function categories(){
         return $this->belongsTo(Categorie::class);
    }
}
