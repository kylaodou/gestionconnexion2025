<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Exception pour les erreurs de requête SQL


class PersonnelController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Ajouter un personnel';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('personnels.ajout', compact('pageTitle'));
    }
    public function traitementAjout()
    {
        request()->validate([
            'id_personne' => ['required', 'unique:personnes,id_personne'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'direction' => ['required'],
            'poste' => ['required'],
        ]);
        $personne = new Personne();
        $personne->id_personne = request()->id_personne;
        $personne->nom = request()->nom;
        $personne->prenom = request()->prenom;
        $personne->save();

        $personnel = new Personnel();
        $personnel->id_personnel =  $personne->id_personne;
        $personnel->direction = request()->direction;
        $personnel->poste = request()->poste;
        $personnel->save();
        return redirect('/ajout_personnel')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function liste()
    {
        $personnels = Personnel::with('personne', 'appareils')->orderBy('created_at', 'desc')->get(); // Récupère tous les utilisateurs par ordre décroissant de création
        $pageTitle = 'Liste des personnels'; // Titre de la page
        return view('personnels.liste', compact('personnels', 'pageTitle')); // Retourne la vue avec la liste des utilisateurs et le titre
    }

    public function modifier($id_personnel)
    {
        $personnel = Personnel::find($id_personnel);
        request()->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'direction' => ['required'],
            'poste' => ['required'],
        ]);

        $personne = Personne::find($personnel->id_personnel);
        $personne->nom = request()->nom;
        $personne->prenom = request()->prenom;
        $personne->save();

        $personnel->direction = request()->direction;
        $personnel->poste = request()->poste;
        $personnel->save();
        return redirect('/liste_personnels')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function delete($id)
    {
        // Méthode pour supprimer un produit
        try {
            $personnel = Personnel::findOrFail($id); // Trouve le persi$personnel par son ID
            $personnel->delete(); // Supprime le persi$personnel de la base de données
            $personnel->personne->delete(); // Supprime le persi$personnel de la base de données


            return redirect('/liste_personnels')->with('status', 'supprimer'); // Redirige avec un message de succès
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                // Vérifie le code d'erreur
                return redirect('/liste_personnels')->with('error', 'Ce étudiants ne peut pas être supprimé car il a des appareils associés.'); // Redirige avec un message d'erreur
            }
        }
    }
}
