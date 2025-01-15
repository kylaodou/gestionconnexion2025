<?php

namespace App\Http\Controllers;

use App\Models\Connexion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Exception pour les erreurs de requête SQL
use App\Models\Appareil;
use App\Models\Etudiant;
use App\Models\Personne;

class DemandeController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Demander une connexion';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('pages.demande', compact('pageTitle'));
    }

    public function traitementAjout(Request $request)
    {
        $request->validate([
            'adresse_mac' => 'required|unique:appareils|max:255|mac_address',
            'type_appareil' => 'required',
            'marque' => 'required',
            'ine' => 'required|exists:etudiants,INE',
        ]);

        $etudiant = Etudiant::where('INE', $request->ine)->first();
        $deviceCount = Appareil::where('id_etudiant', $etudiant->INE)->count();

        if ($deviceCount >= 2) {
            return redirect('/demande')->withErrors(['ine' => 'Un étudiant ne peut enregistrer que 2 appareils au maximum.']);
        }

        $appareil = new Appareil();
        $appareil->adresse_mac = $request->adresse_mac;
        $appareil->type_appareil = $request->type_appareil;
        $appareil->marque = $request->marque;
        $appareil->id_etudiant = $etudiant->INE;
        $appareil->save();

        return redirect('/demande')->with('success', 'Appareil ajouté avec succès.');
    }

    public function mesAppareils(Request $request)
    {
        $request->validate([
            'inere' => ['required'],
        ]);

        $etudiant = Etudiant::where('INE', $request->inere)->first();

        if (!$etudiant) {
            return redirect()->back()->withErrors(['inere' => '* Étudiant non trouvé.'])->withInput();
        }

        $appareils = $etudiant->appareils; // Assuming a relationship is defined

        return redirect()->back()->with(['appareils' => $appareils, 'etudiant' => $etudiant]);
    }


}
