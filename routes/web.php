<?php

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AppareilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DemandePersonnelController;

use App\Http\Controllers\RapportControllerController;
use App\Models\Connexion;
use App\Models\Fournisseur;
use App\Models\Personnel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('', [PageController::class, 'home']);
route::get('/inscription', [AdministrateurController::class, 'formulaireinscription']);
route::post('/inscriptionTraitement', [AdministrateurController::class, 'traitementInscription']);
route::get('/connexion_inscription', [AdministrateurController::class, 'formulaire'])->name('login');
route::get('/demande', [DemandeController::class, 'formulaire']);
route::post('/demande_ajout_appareilTraitement', [DemandeController::class, 'traitementAjout']);
route::post('/mes_appareils', [DemandeController::class, 'mesAppareils']);

Route::get('/demande_personnel', [DemandePersonnelController::class, 'formulaire'])->name('demande_personnel');
Route::post('/demande_ajout_appareil_personnelTraitement', [DemandePersonnelController::class, 'traitementAjout'])->name('demande_ajout_appareil_personnelTraitement');
Route::post('/mes_appareils_personnel', [DemandePersonnelController::class, 'mesAppareils'])->name('mes_appareils_personnel');

route::post('/connexion', [AdministrateurController::class, 'traitementConnexion']);
Route::middleware(['auth'])->group(function () {
    route::get('/dashboard', [PageController::class, 'dashboard']);
    route::get('/deconnexion', [AdministrateurController::class, 'deconnexion']);

    route::get('/ajout_etudiant', [EtudiantController::class, 'formulaire']);
    route::post('/ajout_etudiantTraitement', [EtudiantController::class, 'traitementAjout']);
    route::get('/liste_etudiants', [EtudiantController::class, 'liste']);
    route::post('/liste_etudiants/supprimer/{INE}', [EtudiantController::class, 'delete']);
    route::post('/liste_etudiants/modifier/{INE}', [EtudiantController::class, 'modifier']);

    route::get('/ajout_personnel', [PersonnelController::class, 'formulaire']);
    route::post('/ajout_personnelTraitement', [PersonnelController::class, 'traitementAjout']);
    route::get('/liste_personnels', [PersonnelController::class, 'liste']);
    route::post('/liste_personnels/modifier/{id_personnel}', [PersonnelController::class, 'modifier']);
    route::post('/liste_personnels/supprimer/{id_personnel}', [PersonnelController::class, 'delete']);

    route::get('/ajout_connexion', [ConnexionController::class, 'formulaire']);
    route::post('/ajout_connexionTraitement', [ConnexionController::class, 'traitementAjout']);
    route::get('/liste_connexions', [ConnexionController::class, 'liste']);
    route::post('/liste_connexions/modifier/{id}', [ConnexionController::class, 'modifier']);
    route::post('/liste_connexions/supprimer/{id}', [ConnexionController::class, 'delete']);

    route::get('/ajout_appareil', [AppareilController::class, 'formulaire']);
    route::post('/ajout_appareilTraitement', [AppareilController::class, 'traitementAjout']);
    route::get('/liste_appareils', [AppareilController::class, 'liste']);
    route::post('/liste_appareils/supprimer/{adresse_mac}', [AppareilController::class, 'delete']);
    Route::put('/liste_appareils/modifier/{adresse_mac}', [AppareilController::class, 'modifier']);


    route::get('/liste_utilisateurs', [AdministrateurController::class, 'liste']);

    route::get('/export', [RapportController::class, 'acceuil']);
    route::get('/pdf-etudiants', [RapportController::class, 'exportEtudiantToPDF']);
    route::get('/pdf-personnels', [RapportController::class, 'exportPersonnelToPDF']);
    route::get('/pdf-connexions', [RapportController::class, 'exportConnexionToPDF']);
    route::get('/pdf-appareils', [RapportController::class, 'exportAppareilToPDF']);

    route::get('/export-etudiants', [RapportController::class, 'exportetudiants']);
    route::get('/export-personnels', [RapportController::class, 'exportpersonnels']);
    route::get('/export-connexions', [RapportController::class, 'exportconnexions']);
    route::get('/export-appareils', [RapportController::class, 'exportappareils']);

});


