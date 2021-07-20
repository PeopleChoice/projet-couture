<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeBoutiqueDetails extends Model
{
    use HasFactory;
    protected $fillable = ["prix","qt","id_produit","commande_boutique_id"];
    public function commandeBoutique(){
        return $this->belongsTo(CommandeBoutique::class);
    }
}
