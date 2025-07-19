<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_stand',
        'description',
        'utilisateur_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}


    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
