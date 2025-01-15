<?php

namespace App\Exports;

// Importation de la classe Commande du namespace App\Models pour pouvoir l'utiliser dans ce fichier
use App\Models\Commande;
use App\Models\Connexion;
// Importation du trait FromQuery de la bibliothèque Maatwebsite Excel qui permet d'exporter des données basées sur une requête
use Maatwebsite\Excel\Concerns\FromQuery;

// Importation du trait WithHeadings de la bibliothèque Maatwebsite Excel qui permet de définir les en-têtes des colonnes dans le fichier Excel
use Maatwebsite\Excel\Concerns\WithHeadings;

// Importation du trait WithMapping de la bibliothèque Maatwebsite Excel qui permet de mapper les données exportées
use Maatwebsite\Excel\Concerns\WithMapping;

// Importation du trait Exportable de la bibliothèque Maatwebsite Excel qui rend cette classe exportable
use Maatwebsite\Excel\Concerns\Exportable;

class ConnexionsExport implements FromQuery, WithHeadings, WithMapping
{
    // Utilisation du trait Exportable pour permettre à cette classe d'être exportée
    use Exportable;

    public function query()
    {
        // Requête pour récupérer les données des commandes avec les relations 'historiqueCommandes' et 'produits'
        return Connexion::query();
    }

    public function headings(): array
    {
        // Définition des en-têtes des colonnes du fichier Excel
        return ['Nom', 'Bande passante', 'Nombre utilisateurs max', 'Opérateur', 'Crée le', 'Mise à jour le'];
    }

    public function map($connexion): array
    {
        return [
            $connexion->nom,
            $connexion->bande_passante,
            $connexion->nbr_utilisateur,
            $connexion->operateur,
            $connexion->created_at->format('d/m/Y H:i:s'),
            $connexion->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
