<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si l'utilisateur est supprimé, ses commandes aussi
            $table->string('phone_number'); // Numéro du client
            $table->decimal('total', 10, 2); // Montant total payé
            $table->string('status')->default('en_attente'); // Statut de la commande
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
