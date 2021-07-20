<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
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

    public function detaillePrestation(){
        return $this->haMany(DetaillePrestation::class);
    }


}
