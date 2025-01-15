<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connexion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_connexion',
        'bande_passante', // Ajout du champ nom
        'nbr_utilisateur', // Ajout du champ prenom
        'operateur',
    ];
    public function appareils()
    {
        return $this->hasMany(Appareil::class, 'id_connexion');
    }
}
