<?php
namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Appareil;
use Illuminate\Http\Request;

class DemandePersonnelController extends Controller
{
    public function formulaire()
    {
        $pageTitle = 'Demander une connexion pour le personnel';
        return view('pages.demandepersonnel', compact('pageTitle'));
    }

    public function traitementAjout(Request $request)
    {
        $request->validate([
            'adresse_mac' => 'required|unique:appareils|max:255|mac_address',
            'type_appareil' => 'required',
            'marque' => 'required',
            'id_personnel' => 'required|exists:personnels,id_personnel',
        ]);

        $personnel = Personnel::where('id_personnel', $request->id_personnel)->first();

        $appareil = new Appareil();
        $appareil->adresse_mac = $request->adresse_mac;
        $appareil->type_appareil = $request->type_appareil;
        $appareil->marque = $request->marque;
        $appareil->id_personnel = $personnel->id_personnel;
        $appareil->save();

        return redirect('/demande_personnel')->with('success', 'Appareil ajouté avec succès.');
    }

    public function mesAppareils(Request $request)
    {
        $request->validate([
            'id_personnel' => ['required'],
        ]);

        $personnel = Personnel::where('id_personnel', $request->id_personnel)->first();

        if (!$personnel) {
            return redirect()->back()->withErrors(['id_personnel' => '* Personnel non trouvé.'])->withInput();
        }

        $appareils = $personnel->appareils; // Assuming a relationship is defined

        return redirect()->back()->with(['appareils' => $appareils, 'personnel' => $personnel]);
    }
}
