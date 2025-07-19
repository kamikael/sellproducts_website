<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image_url',
        'stand_id',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}
