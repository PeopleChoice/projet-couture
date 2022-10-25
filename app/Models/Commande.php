<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_commande',
        'date_livraison',
        'libelle',
        'accompt',
        'remise',
        'payer',
        'status',
        'clients_id',
        'code'
    ];
    protected $casts = [
        'date_commande' => 'date:Y-m-d'
    ];

    public function client(){
        return $this->belongsTo(Client::class,'clients_id');
    }

    public function detaille(){
        return $this->hasMany(Detaille::class);
    }

    public function acompte_commande(){
        return $this->hasMany(AcompteCommande::class);
    }
}
