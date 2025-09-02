<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nomproduit',
        'prix',
        'quantite',
        'image',
        'description'
    ];

    // Accessor pour le champ image
    public function getImageAttribute($value)
    {
        // Retourne le chemin de l'image si défini, sinon un chemin par défaut
        return $value ?: asset('images/default-product.jpg');
    }
}