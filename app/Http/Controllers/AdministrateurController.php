<?php

namespace App\Http\Controllers;

// Importation des modèles et des classes nécessaires

use App\Models\Administrateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Se connecter';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('pages.connexion_inscription', compact('pageTitle'));
    }

    public function formulaireinscription()
    {
        // Titre de la page de connexion
        $pageTitle = 'Ajouter un utilisateur';

        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('utilisateurs.ajout', compact('pageTitle'));
    }

    // Traite l'ajout d'un utilisateur
    public function traitementInscription()
    {
        request()->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email', 'unique:administrateurs'],
            'password' => ['required', 'min:8'],
        ]);
        $user = new Administrateur(); // Crée une nouvelle instance d'utilisateur
        $user->nom = request()->nom; // Récupère le nom de l'utilisateur depuis le formulaire
        $user->prenom = request()->prenom; // Récupère le prénom de l'utilisateur depuis le formulaire
        $user->email = request()->email; // Récupère l'email de l'utilisateur depuis le formulaire
        $user->password = bcrypt(request()->password); // Hache le mot de passe de l'utilisateur
        $user->save(); // Enregistre l'utilisateur dans la base de données
        return redirect('/inscription')->with('status', 'reussi'); // Redirige avec un message de succès
    }

    public function liste()
    {
        $utilisateurs = Administrateur::all();
        $pageTitle = 'Liste des utilisateurs'; // Titre de la page
        return view('utilisateurs.liste', compact('utilisateurs', 'pageTitle')); // Retourne la vue avec la liste des utilisateurs et le titre
    }

    public function traitementConnexion(Request $request)
    {
        // Validation des données du formulaire de connexion
        $request->validate([
            // Le champ 'email' est requis et doit être une adresse email se terminant par '@gmail.com'
            'email' => ['required', 'email', 'ends_with:@gmail.com'],
            // Le champ 'password' est requis
            'password' => ['required'],
        ]);

        // Récupération des identifiants de connexion à partir de la requête
        $credentials = $request->only('email', 'password');

        // Récupération de l'email depuis la requête
        $email = $request->email;

        // Tentative d'authentification de l'utilisateur avec les identifiants fournis
        if (Auth::attempt($credentials)) {
            // Redirection vers le tableau de bord en cas de succès de l'authentification
            return redirect('/dashboard');
        }

        // Vérification si l'email existe dans la base de données des utilisateurs
        if (!Administrateur::where('email', $email)->first()) {
            // Retour à la page précédente avec un message d'erreur si l'email n'existe pas
            return redirect()
                ->back()
                ->withErrors(['email' => '*Email inexistant.']) // Message d'erreur
                ->withInput(); // Remplissage des champs du formulaire avec les données précédemment saisies
        } else {
            // L'email existe, mais l'authentification a échoué en raison d'un mot de passe incorrect
            // Retour à la page précédente avec un message d'erreur indiquant que le mot de passe est incorrect
            return redirect()
                ->back()
                ->withErrors(['password' => '*Le mot de passe est incorrect.']) // Message d'erreur
                ->withInput(); // Remplissage des champs du formulaire avec les données précédemment saisies
        }
    }


    // Méthode deconnexion() pour gérer la déconnexion de l'utilisateur
    public function deconnexion()
    {
        // Déconnexion de l'utilisateur actuellement authentifié
        Auth::logout();

        // Redirection vers la page d'accueil après la déconnexion
        return redirect('/');
    }
}
