<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'civ',
        'nom',
        'prenom',
        'mobile',
        'email',
        'date_naissance',
        'adresse'
    ];


    public function commande(){
        return $this->hasMany(Commande::class);
    }
    public function mensuration(){
        return $this->hasMany(Mensuration::class);
    }
}
