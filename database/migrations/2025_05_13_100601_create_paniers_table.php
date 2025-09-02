<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->unsignedBigInteger('boutique_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('boutique_id')->references('id')->on('boutiques')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('paniers');
    }
};