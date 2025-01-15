<?php

namespace App\Exports;

// Importation de la classe Fournisseur du namespace App\Models afin de pouvoir l'utiliser dans ce fichier
use App\Models\Fournisseur;
use App\Models\Personnel;
// Importation du trait FromQuery de la bibliothèque Maatwebsite Excel, qui permet d'exporter des données basées sur une requête
use Maatwebsite\Excel\Concerns\FromQuery;

// Importation du trait WithHeadings de la bibliothèque Maatwebsite Excel, qui permet de définir les en-têtes des colonnes dans le fichier Excel
use Maatwebsite\Excel\Concerns\WithHeadings;

// Importation du trait WithMapping de la bibliothèque Maatwebsite Excel, qui permet de mapper les données exportées
use Maatwebsite\Excel\Concerns\WithMapping;

// Importation du trait Exportable de la bibliothèque Maatwebsite Excel, qui rend cette classe exportable
use Maatwebsite\Excel\Concerns\Exportable;

// Définition de la classe FournisseursExport
class PersonnelsExport implements FromQuery, WithHeadings, WithMapping
{
    // Utilisation du trait Exportable pour rendre cette classe exportable
    use Exportable;

    // Méthode query() qui retourne une requête pour récupérer les fournisseurs avec leurs relations
    public function query()
    {
        return Personnel::query()->with('personne');
    }

    // Méthode headings() qui définit les en-têtes des colonnes du fichier Excel
    public function headings(): array
    {
        return ['ID', 'Nom', 'Prenon', 'Direction', 'Poste', 'Créé le', 'Mise à jour le'];
    }

    // Méthode map() qui mappe chaque fournisseur à un tableau représentant une ligne du fichier Excel
    public function map($personnel): array
    {
        return [
            $personnel->id_personnel,
            $personnel->personne->nom,
            $personnel->personne->prenom,
            $personnel->direction,
            $personnel->poste,
            $personnel->created_at->format('d/m/Y H:i:s'),
            $personnel->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
