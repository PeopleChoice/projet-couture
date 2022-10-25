<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompte extends Model
{
    use HasFactory;
    protected $fillable = ['prix'];
 
    public function details_prestation(){
        return $this->belongsTo(DetailsPrestation::class);
    }
}
