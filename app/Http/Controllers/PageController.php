<?php

namespace App\Http\Controllers;
use App\Models\Appareil;
use App\Models\Connexion;
use App\Models\Etudiant;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $pageTitle = 'Acceuil'; // Titre de la page
        return view('home', compact('pageTitle')); // Retourne la vue avec le titre
    }

    public function dashboard()
    {
        $etudiants = Appareil::selectRaw('id_etudiant, COUNT(*) as count')
            ->whereNotNull('id_etudiant')
            ->groupBy('id_etudiant')
            ->with('etudiant')
            ->get()
            ->map(function ($appareil) {
                return [
                    'name' => $appareil->etudiant->personne->nom . ' ' . $appareil->etudiant->personne->prenom,
                    'y' => (int) $appareil->count
                ];
            });

        // Récupérer le personnel avec le nombre d'appareils attribués
        $personnels = Appareil::selectRaw('id_personnel, COUNT(*) as count')
            ->whereNotNull('id_personnel')
            ->groupBy('id_personnel')
            ->with('personnel')
            ->get()
            ->map(function ($appareil) {
                return [
                    'name' => $appareil->personnel->personne->nom . ' ' . $appareil->personnel->personne->prenom,
                    'y' => (int) $appareil->count
                ];
            });
            $connexions = Connexion::all();
            $appareils = Appareil::all();
            $etudiant= Etudiant::with('personne')->latest()->take(3)->get();
            $personnel = Personnel::with('personne')->latest()->take(3)->get();
            $etud = Etudiant::all();
            $per = Personnel::all();
        // Titre de la page de connexion
        $pageTitle = 'Tableau de bord';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('pages.dashboard', compact('etud', 'per' ,'pageTitle', 'personnels', 'etudiant', 'personnel', 'etudiants', 'connexions', 'appareils'));
    }
}
