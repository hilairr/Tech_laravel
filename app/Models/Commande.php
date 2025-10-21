<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'total',
        'status',
    ];

    /**
     * Relation avec l’utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
