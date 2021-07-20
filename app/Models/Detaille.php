<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detaille extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'qt',
        'pu',
        'commande_id'
      
    ];

    public  function commande(){
        return $this->belongsTo(Commande::class);
    }
}
