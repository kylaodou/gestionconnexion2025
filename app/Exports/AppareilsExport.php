<?php

namespace App\Exports;

// Importe la classe Utilisateur du namespace App\Models pour pouvoir l'utiliser dans ce fichier

use App\Models\Appareil;
use App\Models\Utilisateur;

// Importe l'interface FromQuery du namespace Maatwebsite\Excel\Concerns, utilisée pour exporter des données basées sur une requête
use Maatwebsite\Excel\Concerns\FromQuery;

// Importe l'interface WithHeadings du namespace Maatwebsite\Excel\Concerns, utilisée pour définir les en-têtes des colonnes dans le fichier Excel
use Maatwebsite\Excel\Concerns\WithHeadings;

// Importe l'interface WithMapping du namespace Maatwebsite\Excel\Concerns, utilisée pour mapper les données exportées
use Maatwebsite\Excel\Concerns\WithMapping;

// Importe le trait Exportable du namespace Maatwebsite\Excel\Concerns, qui rend cette classe exportable
use Maatwebsite\Excel\Concerns\Exportable;

// Définition de la classe UtilisateursExport
class AppareilsExport implements FromQuery, WithHeadings, WithMapping
{
    // Utilisation du trait Exportable pour rendre cette classe exportable
    use Exportable;

    // Méthode query() qui retourne une requête pour récupérer les utilisateurs
    public function query()
    {
        return Appareil::query()->with('personnel', 'connexion', 'etudiant');
    }

    // Méthode headings() qui définit les en-têtes des colonnes du fichier Excel
    public function headings(): array
    {
        return ['Adresse MAC', 'Type Appareil', 'Marque', 'Etudiant', 'Personnel', 'Connexion', 'Crée le', 'Mise à jour le'];
    }

    // Méthode map() qui mappe chaque utilisateur à un tableau représentant une ligne du fichier Excel
    public function map($appareil): array
    {
        return [
            $appareil->adresse_mac,
            $appareil->type_appareil,
            $appareil->marque,
            ($appareil->etudiant->personne->nom ?? '') . ' ' . ($appareil->etudiant->personne->prenom ?? ''),
            ($appareil->personnel->personne->nom ?? '') . ' ' . ($appareil->personnel->personne->prenom ?? ''),
            $appareil->connexion->nom ?? '',
            $appareil->created_at->format('d/m/Y H:i:s'),
            $appareil->updated_at->format('d/m/Y H:i:s'),
        ];

    }
}
