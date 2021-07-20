<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsPrestation extends Model
{
    use HasFactory;
    protected $fillable = ['date_prestation','prix','qt','acompte','libelle','status','prestataires_id'];
 
    public function prestataire(){
        return $this->belongsTo(Prestataire::class);
    }
}
