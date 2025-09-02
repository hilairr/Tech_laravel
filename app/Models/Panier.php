<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';

    protected $fillable = ['session_id', 'boutique_id', 'quantity'];

    /**
     * Relation avec le modèle Boutique
     */
    public function boutique()
    {
        return $this->belongsTo(Boutique::class, 'boutique_id');
    }
}