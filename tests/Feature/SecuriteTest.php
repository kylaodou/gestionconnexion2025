<?php

namespace Tests\Feature;

use App\Models\Administrateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecuriteTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): Administrateur
    {
        $admin = new Administrateur();
        $admin->nom = 'Ouedraogo';
        $admin->prenom = 'Awa';
        $admin->email = 'awa@gmail.com';
        $admin->password = bcrypt('motdepasse');
        $admin->save();

        return $admin;
    }

    private function nouveauCompte(): array
    {
        return ['nom' => 'Pirate', 'prenom' => 'X', 'email' => 'pirate@gmail.com', 'password' => 'motdepasse'];
    }

    public function test_le_premier_administrateur_est_cree_par_le_seeder(): void
    {
        putenv('ADMIN_EMAIL=premier@gmail.com');
        putenv('ADMIN_PASSWORD=motdepasse');

        $this->seed();

        $this->assertDatabaseHas('administrateurs', ['email' => 'premier@gmail.com']);

        putenv('ADMIN_EMAIL');
        putenv('ADMIN_PASSWORD');
    }

    public function test_un_visiteur_ne_peut_pas_creer_de_compte_administrateur(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // Même quand la base est vide : la création de compte exige d'être connecté.
        $this->get('/inscription')->assertRedirect(route('login'));
        $this->post('/inscriptionTraitement', $this->nouveauCompte())->assertRedirect(route('login'));

        $this->admin();
        $this->post('/inscriptionTraitement', $this->nouveauCompte())->assertRedirect(route('login'));

        $this->assertDatabaseMissing('administrateurs', ['email' => 'pirate@gmail.com']);
    }

    public function test_un_administrateur_connecte_peut_ajouter_un_utilisateur(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->actingAs($this->admin())
            ->post('/inscriptionTraitement', $this->nouveauCompte())
            ->assertRedirect('/inscription');

        $this->assertDatabaseHas('administrateurs', ['email' => 'pirate@gmail.com']);
    }

    public function test_les_pages_de_gestion_exigent_une_connexion(): void
    {
        foreach (['/dashboard', '/liste_etudiants', '/liste_personnels', '/liste_appareils', '/liste_connexions', '/export-etudiants'] as $page) {
            $this->get($page)->assertRedirect(route('login'));
        }
    }

    public function test_la_connexion_ne_revele_pas_si_le_compte_existe(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->admin();

        $inconnu = $this->from('/connexion_inscription')->post('/connexion', ['email' => 'inconnu@gmail.com', 'password' => 'x']);
        $mauvais = $this->from('/connexion_inscription')->post('/connexion', ['email' => 'awa@gmail.com', 'password' => 'x']);

        $inconnu->assertSessionHasErrors(['email' => '*Email ou mot de passe incorrect.']);
        $mauvais->assertSessionHasErrors(['email' => '*Email ou mot de passe incorrect.']);
    }

    public function test_la_connexion_fonctionne_et_le_nombre_d_essais_est_limite(): void
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->admin();

        $this->post('/connexion', ['email' => 'awa@gmail.com', 'password' => 'motdepasse'])->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->get('/deconnexion');

        for ($i = 0; $i < 4; $i++) {
            $this->post('/connexion', ['email' => 'awa@gmail.com', 'password' => 'faux']);
        }
        $this->post('/connexion', ['email' => 'awa@gmail.com', 'password' => 'faux'])->assertStatus(429);
    }
}
