<?php

namespace App\Http\Controllers;

// Importation des modèles et des classes nécessaires

use App\Models\Administrateur;
use App\Exports\EtudiantsExport; // Importe la classe CommandesExport pour exporter les commandes
use App\Exports\ConnexionsExport; // Importe la classe CommandesExport pour exporter les commandes
use App\Exports\PersonnelsExport; // Importe la classe CommandesExport pour exporter les commandes
use App\Exports\AppareilsExport; // Importe la classe CommandesExport pour exporter les commandes
use App\Models\Appareil;
use App\Models\Connexion;
use App\Models\Etudiant;
use App\Models\Personnel;
use Maatwebsite\Excel\Facades\Excel; // Importe la facade Excel pour utiliser les fonctionnalités d'exportation Excel
use Barryvdh\DomPDF\Facade\PDF; // Importe la facade PDF pour utiliser les fonctionnalités de génération de PDF

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function acceuil()
    {
        // Titre de la page de connexion
        $pageTitle = 'Exporter les tables';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('ExportTable.export', compact('pageTitle'));
    }
    public function exportEtudiantToPDF()
    {
        $etudiants = Etudiant::with('personne')->get(); // Récupère toutes les commandes avec leurs historiques de livraison et les produits associés

        $pdf = PDF::loadView('ExportTable.pdfetudiants', compact('etudiants')); // Charge la vue PDF avec les livraisons

        // Pour télécharger le PDF généré
        return $pdf->download('etudiants.pdf'); // Télécharge le fichier PDF des livraisons
    }
    public function exportPersonnelToPDF()
    {
        $personnels = Personnel::with('personne')->get(); // Récupère tous les personnels avec leurs informations associées

        $pdf = PDF::loadView('ExportTable.pdfpersonnels', compact('personnels')); // Charge la vue PDF avec les personnels

        // Pour télécharger le PDF généré
        return $pdf->download('personnels.pdf'); // Télécharge le fichier PDF des produits
    }
    public function exportConnexionToPDF()
    {
        $connexions = Connexion::all(); // Récupère tous les connexions avec leurs informations associées

        $pdf = PDF::loadView('ExportTable.pdfconnexion', compact('connexions')); // Charge la vue PDF avec les connexions

        // Pour télécharger le PDF généré
        return $pdf->download('connexions.pdf'); // Télécharge le fichier PDF des produits
    }
    public function exportAppareilToPDF()
    {
        $appareils = Appareil::with('etudiant', 'personnel', 'connexion')->get(); // Récupère tous les appareils avec leurs informations associées

        $pdf = PDF::loadView('ExportTable.pdfappareils', compact('appareils')); // Charge la vue PDF avec les appareils

        // Pour télécharger le PDF généré
        return $pdf->download('appareils.pdf'); // Télécharge le fichier PDF des produits
    }

    public function exportetudiants()
    {
        return Excel::download(new EtudiantsExport(), 'etudiants.xlsx'); // Télécharge le fichier Excel des produits
    }
    public function exportpersonnels()
    {
        return Excel::download(new PersonnelsExport(), 'personnels.xlsx'); // Télécharge le fichier Excel des produits
    }
    public function exportconnexions()
    {
        return Excel::download(new ConnexionsExport(), 'connexions.xlsx'); // Télécharge le fichier Excel des produits
    }
    public function exportappareils()
    {
        return Excel::download(new AppareilsExport(), 'appareils.xlsx'); // Télécharge le fichier Excel des produits
    }
}
