<?php

namespace App\Exports;

// Importation de la classe Commande du namespace App\Models afin de pouvoir l'utiliser dans ce fichier
use App\Models\Commande;
use App\Models\Etudiant;
// Importation du trait FromQuery de la bibliothèque Maatwebsite Excel, qui permet d'exporter des données basées sur une requête
use Maatwebsite\Excel\Concerns\FromQuery;

// Importation du trait WithHeadings de la bibliothèque Maatwebsite Excel, qui permet de définir les en-têtes des colonnes dans le fichier Excel
use Maatwebsite\Excel\Concerns\WithHeadings;

// Importation du trait WithMapping de la bibliothèque Maatwebsite Excel, qui permet de mapper les données exportées
use Maatwebsite\Excel\Concerns\WithMapping;

// Importation du trait Exportable de la bibliothèque Maatwebsite Excel, qui rend cette classe exportable
use Maatwebsite\Excel\Concerns\Exportable;

// Définition de la classe CommandesExport
class EtudiantsExport implements FromQuery, WithHeadings, WithMapping
{
    // Utilisation du trait Exportable pour rendre cette classe exportable
    use Exportable;

    // Méthode query() qui retourne une requête pour récupérer les commandes avec leurs relations
    public function query()
    {
        return Etudiant::query()->with('personne');
    }

    // Méthode headings() qui définit les en-têtes des colonnes du fichier Excel
    public function headings(): array
    {
        return ['INE', 'Nom', 'Prenom', 'Filière', 'Année scolaire', 'Crée le', 'Mise à jour le'];
    }

    // Méthode map() qui mappe chaque commande à un tableau représentant une ligne du fichier Excel
    public function map($etudiant): array
    {
        return [
            $etudiant->INE,
            $etudiant->personne->nom,
            $etudiant->personne->prenom,
            $etudiant->filiere,
            $etudiant->annee_scolaire . '/' . $etudiant->annee_scolaire + 1,
            $etudiant->created_at->format('d/m/Y H:i:s'),
            $etudiant->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
