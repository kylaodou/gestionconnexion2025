<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Crée le premier administrateur à partir des variables d'environnement
     * ADMIN_NOM, ADMIN_PRENOM, ADMIN_EMAIL et ADMIN_PASSWORD.
     * Les comptes suivants sont ajoutés depuis l'application par un administrateur connecté.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (!$email || !$password) {
            $this->command?->warn('ADMIN_EMAIL et ADMIN_PASSWORD ne sont pas définis : aucun administrateur créé.');
            return;
        }

        if (Administrateur::where('email', $email)->exists()) {
            $this->command?->info("L'administrateur {$email} existe déjà.");
            return;
        }

        $admin = new Administrateur();
        $admin->nom = env('ADMIN_NOM', 'Administrateur');
        $admin->prenom = env('ADMIN_PRENOM', '');
        $admin->email = $email;
        $admin->password = bcrypt($password);
        $admin->save();

        $this->command?->info("Administrateur {$email} créé.");
    }
}
