<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensuration extends Model
{
    use HasFactory;
    protected $fillable = ['mensuration','clients_id'];

    public function client(){
        return  $this->belongsTo(Client::class);
    }
}
