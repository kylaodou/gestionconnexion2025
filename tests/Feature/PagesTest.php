<?php

namespace Tests\Feature;

use App\Models\Administrateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_toutes_les_pages_s_affichent_pour_un_administrateur_connecte(): void
    {
        $admin = new Administrateur();
        $admin->nom = 'Ouedraogo';
        $admin->prenom = 'Awa';
        $admin->email = 'awa@gmail.com';
        $admin->password = bcrypt('motdepasse');
        $admin->save();

        $this->actingAs($admin);

        $pages = [
            '/dashboard', '/inscription', '/liste_utilisateurs',
            '/ajout_etudiant', '/liste_etudiants',
            '/ajout_personnel', '/liste_personnels',
            '/ajout_connexion', '/liste_connexions',
            '/ajout_appareil', '/liste_appareils',
            '/export',
            '/pdf-etudiants', '/pdf-personnels', '/pdf-connexions', '/pdf-appareils',
            '/export-etudiants', '/export-personnels', '/export-connexions', '/export-appareils',
        ];

        foreach ($pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_les_pages_publiques_s_affichent(): void
    {
        foreach (['/', '/connexion_inscription', '/demande', '/demande_personnel'] as $page) {
            $this->get($page)->assertOk();
        }
    }
}
