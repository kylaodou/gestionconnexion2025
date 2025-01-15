<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('connexions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('bande_passante');
            $table->string('nbr_utilisateur');
            $table->string('operateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connexions');
    }
};
