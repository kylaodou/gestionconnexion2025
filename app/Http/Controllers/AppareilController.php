<?php

namespace App\Http\Controllers;

use App\Models\Appareil;
use App\Models\Etudiant;
use App\Models\Personnel;
use App\Models\Connexion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; // Exception pour les erreurs de requête SQL

class AppareilController extends Controller
{
    public function formulaire()
    {
        // Titre de la page de connexion
        $pageTitle = 'Ajouter un appareil';
        $etudiants = Etudiant::with('personne')->get();
        $connexions = Connexion::all();
        $personnels = Personnel::with('personne')->get();
        // Retourne la vue du formulaire de connexion avec le titre de la page
        return view('appareils.ajout', compact('pageTitle', 'etudiants', 'connexions', 'personnels'));
    }
    public function traitementAjout(Request $request)
    {
        $request->validate([
            'adresse_mac' => 'required|unique:appareils|max:255|mac_address',
            'type_appareil' => 'required',
            'marque' => 'required',
            'user_type' => 'required',
            'etudiant' => 'required_if:user_type,etudiant',
            'personnel' => 'required_if:user_type,personnel',
            'connexion' => 'required',
        ]);
        // Check if the user is a student and if they already have 2 devices registered
        if ($request->user_type === 'etudiant') {
            $deviceCount = Appareil::where('id_etudiant', $request->etudiant)->count();
            if ($deviceCount >= 2) {
                // Redirect back with an error if the student already has 2 devices
                return redirect('/ajout_appareil')->withErrors(['etudiant' => 'Un étudiant ne peut enregistrer que 2 appareils au maximum.']);
            }
        }

        $appareil = new Appareil();
        $appareil->adresse_mac = $request->adresse_mac;
        $appareil->type_appareil = $request->type_appareil;
        $appareil->marque = $request->marque;

        if ($request->user_type === 'etudiant') {
            $appareil->id_etudiant = $request->etudiant;
        } elseif ($request->user_type === 'personnel') {
            $appareil->id_personnel = $request->personnel;
        }
        $appareil->id_connexion = $request->connexion;
        $appareil->save();

        return redirect('/ajout_appareil')->with('success', 'Appareil ajouté avec succès.');
    }

    public function liste()
    {
        $appareils = Appareil::orderBy('created_at', 'desc')->get(); // Récupère tous les utilisateurs par ordre décroissant de création
        $etudiants = Etudiant::with('personne')->get();
        $connexions = Connexion::all();
        $personnels = Personnel::with('personne')->get();
        $pageTitle = 'Liste des appareils'; // Titre de la page
        return view('appareils.liste', compact('appareils', 'pageTitle', 'etudiants', 'connexions', 'personnels')); // Retourne la vue avec la liste des utilisateurs et le titre
    }
    public function delete($adresse_mac)
    {
        // Method to delete a product
            $appareil = Appareil::findOrFail($adresse_mac); // Find the device by its ID
            $appareil->delete(); // Delete the device from the database
            return redirect('/liste_appareils')->with('status', 'Appareil supprimé avec succès.'); // Redirect with a success message
        
    }

    public function modifier(Request $request, $adresse_mac)
{
    $validatedData = $request->validate([
        'adresse_mac' => 'required|mac_address|unique:appareils,adresse_mac,' . $adresse_mac . ',adresse_mac',
        'marque' => 'required|string',
        'type_appareil' => 'required|string',
        'user_type' => 'required|string',
        'etudiant' => 'required_if:user_type,etudiant',
        'personnel' => 'required_if:user_type,personnel',
        'connexion' => 'required',
    ]);

    // Find the device by MAC address
    $appareil = Appareil::where('adresse_mac', $adresse_mac)->firstOrFail();

    // Update the device with new data
    $appareil->update([
        'adresse_mac' => $validatedData['adresse_mac'],
        'marque' => $validatedData['marque'],
        'type_appareil' => $validatedData['type_appareil'],
        'id_etudiant' => $request->user_type === 'etudiant' ? $validatedData['etudiant'] : null,
        'id_personnel' => $request->user_type === 'personnel' ? $validatedData['personnel'] : null,
        'id_connexion' => $validatedData['connexion'],
    ]);

    return redirect('/liste_appareils')->with('status', 'reussi'); // Redirige avec un message de succès
}

}
