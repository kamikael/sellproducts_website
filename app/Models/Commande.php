<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'stand_id',
        'details_commande',
        'date_commande',
    ];

    protected $casts = [
        'details_commande' => 'array',
        'date_commande' => 'datetime',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }

    /**
     * Obtenir le total de la commande
     */
    public function getTotalAttribute()
    {
        return $this->details_commande['total'] ?? 0;
    }

    /**
     * Obtenir les produits de la commande
     */
    public function getProduitsAttribute()
    {
        return $this->details_commande['produits'] ?? [];
    }

    /**
     * Obtenir l'email du client
     */
    public function getClientEmailAttribute()
    {
        return $this->details_commande['client_email'] ?? null;
    }

    /**
     * Obtenir l'ID du client
     */
    public function getClientIdAttribute()
    {
        return $this->details_commande['client_id'] ?? null;
    }
}
