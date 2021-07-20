<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeBoutique extends Model
{
    use HasFactory;
    protected $fillable = ['date_commande','nom','prenom','adresse','tel','email','remise'];
     

    public function commandeBoutiqueDetails(){
        return $this->hasMany(CommandeBoutiqueDetails::class);
    }
}
