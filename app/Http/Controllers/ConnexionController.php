<?php

namespace App\Http\Controllers;

use App\Models\Connexion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Exception pour les erreurs de requête SQL


class ConnexionController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Ajouter une connexion';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('connexions.ajout', compact('pageTitle'));
    }
    public function traitementAjout()
    {
        request()->validate([
            'nom' => ['required', 'unique:connexions'],
            'bande_passante' => ['required'],
            'nbr_utilisateur' => ['required'],
            'operateur' => ['required'],
        ]);
        $connexion = new Connexion();
        $connexion->nom = request()->nom;
        $connexion->bande_passante = request()->bande_passante;
        $connexion->nbr_utilisateur = request()->nbr_utilisateur;
        $connexion->operateur = request()->operateur;
        $connexion->save();
        return redirect('/ajout_connexion')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function liste()
    {
        $connexions = Connexion::orderBy('created_at', 'desc')->get(); // Récupère tous les utilisateurs par ordre décroissant de création
        $pageTitle = 'Liste de la connexion'; // Titre de la page
        return view('connexions.liste', compact('connexions', 'pageTitle')); // Retourne la vue avec la liste des utilisateurs et le titre
    }

    public function modifier(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'unique:connexions,nom,' . $request->id . ',id'],
            'bande_passante' => ['required'],
            'nbr_utilisateur' => ['required'],
            'operateur' => ['required'],
        ]);

        $connexion = Connexion::findOrFail($request->id);
        $connexion->nom = request()->nom;
        $connexion->bande_passante = request()->bande_passante;
        $connexion->nbr_utilisateur = request()->nbr_utilisateur;
        $connexion->operateur = request()->operateur;
        $connexion->save();
        return redirect('/liste_connexions')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function delete($id)
    {
        // Méthode pour supprimer un produit
        try {
            $connexion = Connexion::findOrFail($id); // Trouve le connexion par son ID
            $connexion->delete(); // Supprime le connexion de la base de données
            return redirect('/liste_connexions')->with('status', 'supprimer'); // Redirige avec un message de succès
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                // Vérifie le code d'erreur
                return redirect('/liste_connexions')->with('error', 'Ce étudiants ne peut pas être supprimé car il a des appareils associés.'); // Redirige avec un message d'erreur
            }
        }
    }
}
