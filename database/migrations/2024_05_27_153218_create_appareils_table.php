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
        Schema::create('appareils', function (Blueprint $table) {
            $table->string('adresse_mac')->unique(); // Définition de la colonne matricule comme string
            $table->primary('adresse_mac'); // Définition de matricule comme clé primaire
            $table->string('type_appareil');
            $table->string('marque');
            $table->string('id_etudiant')->nullable();
            $table->string('id_personnel')->nullable();
            $table->unsignedBigInteger('id_connexion');

            $table->foreign('id_etudiant')->references('INE')->on('etudiants')->onDelete('set null');
            $table->foreign('id_personnel')->references('id_personnel')->on('personnels')->onDelete('set null');
            $table->foreign('id_connexion')->references('id')->on('connexions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appareils');
    }
};
