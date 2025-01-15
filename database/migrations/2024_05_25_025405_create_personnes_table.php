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
        Schema::create('personnes', function (Blueprint $table) {
            $table->string('id_personne')->unique(); // Définition de la colonne matricule comme string
            $table->primary('id_personne'); // Définition de matricule comme clé primaire
            $table->string('nom'); // Champ nom de type chaîne de caractères
            $table->string('prenom'); // Champ prenom de type chaîne de caractères
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
