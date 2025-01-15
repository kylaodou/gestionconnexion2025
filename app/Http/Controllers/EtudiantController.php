<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Exception pour les erreurs de requête SQL

class EtudiantController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Ajouter un étudiant';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('etudiants.ajout', compact('pageTitle'));
    }
    public function traitementAjout()
    {
        request()->validate([
            'INE' => ['required', 'unique:personnes,id_personne'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'filiere' => ['required'],
            'annee_scolaire' => ['required'],
        ]);
        $personne = new Personne();
        $personne->id_personne = request()->INE;
        $personne->nom = request()->nom;
        $personne->prenom = request()->prenom;
        $personne->save();
        $etudiant = new Etudiant();
        $etudiant->INE = $personne->id_personne;
        $etudiant->filiere = request()->filiere;
        $etudiant->annee_scolaire = request()->annee_scolaire;
        $etudiant->save();
        return redirect('/ajout_etudiant')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function liste()
    {
        $etudiants = Etudiant::with('personne', 'appareils')->orderBy('created_at', 'desc')->get(); // Récupère tous les utilisateurs par ordre décroissant de création
        $pageTitle = 'Liste des étudiants'; // Titre de la page
        return view('etudiants.liste', compact('etudiants', 'pageTitle')); // Retourne la vue avec la liste des utilisateurs et le titre
    }

    public function delete($INE)
    {
        // Méthode pour supprimer un produit
        try {
            $etudiant = Etudiant::findOrFail($INE); // Trouve le etudiant par son ID
            $etudiant->delete(); // Supprime le etudiant de la base de données
            $etudiant->personne->delete(); // Supprime le persi$personnel de la base de données
            return redirect('/liste_etudiants')->with('status', 'supprimer'); // Redirige avec un message de succès
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                // Vérifie le code d'erreur
                return redirect('/liste_etudiants')->with('error', 'Ce étudiants ne peut pas être supprimé car il a des appareils associés.'); // Redirige avec un message d'erreur
            }
        }
    }

    public function modifier($INE)
    {
        $etudiant = Etudiant::find($INE);

        if (!$etudiant) {
            return redirect('/liste_etudiants')->with('error', 'Étudiant non trouvé');
        }

        request()->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'filiere' => ['required'],
            'annee_scolaire' => ['required'],
        ]);

        $personne = Personne::find($etudiant->INE);
        $personne->nom = request()->nom;
        $personne->prenom = request()->prenom;
        $personne->save();

        $etudiant->filiere = request()->filiere;
        $etudiant->annee_scolaire = request()->annee_scolaire;
        $etudiant->save();

        return redirect('/liste_etudiants')->with('status', 'Modification réussie');
    }
}
