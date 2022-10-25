<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcompteCommande extends Model
{
    use HasFactory;

    protected $fillable = ['prix'];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
    
}
