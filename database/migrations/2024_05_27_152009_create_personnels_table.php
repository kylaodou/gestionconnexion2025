<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->string('id_personnel')->primary(); // Définition de matricule comme clé primaire
            $table->foreign('id_personnel')->references('id_personne')->on('personnes');
            $table->string('direction');
            $table->string('poste');
            $table->string('password')->defaut("12345678");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
