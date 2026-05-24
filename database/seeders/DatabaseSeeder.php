<?php

namespace Database\Seeders;

use App\Models\Billet;
use App\Models\Espace;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::updateOrCreate(
            ['email' => 'admin@eventora.test'],
            [
                'name' => 'Admin EventOra',
                'password' => 'password',
                'role' => User::ROLE_ADMINISTRATEUR,
            ],
        );

        $organisateur = User::updateOrCreate(
            ['email' => 'organisateur@eventora.test'],
            [
                'name' => 'Organisateur EventOra',
                'password' => 'password',
                'role' => User::ROLE_ORGANISATEUR,
            ],
        );

        $utilisateur = User::updateOrCreate(
            ['email' => 'utilisateur@eventora.test'],
            [
                'name' => 'Utilisateur EventOra',
                'password' => 'password',
                'role' => User::ROLE_UTILISATEUR,
            ],
        );

        $espace = Espace::updateOrCreate(
            ['nom' => 'Palais de la Culture'],
            [
                'localisation' => 'Bamako',
                'capacite' => 1200,
            ],
        );

        Espace::updateOrCreate(
            ['nom' => 'Centre EventOra'],
            [
                'localisation' => 'Paris',
                'capacite' => 600,
            ],
        );

        $event = Evenement::updateOrCreate(
            ['nom' => 'TechSummit 2026'],
            [
                'user_id' => $organisateur->id,
                'description' => 'Une journee de conferences, ateliers et rencontres autour des experiences numeriques.',
                'date' => '2026-06-20',
                'heure_debut' => '09:00',
                'heure_fin' => '18:00',
                'espace_id' => $espace->id,
            ],
        );

        Billet::updateOrCreate(
            ['evenement_id' => $event->id, 'type' => 'Standard'],
            [
                'prix' => 5000,
                'quantite' => 100,
            ],
        );

        Billet::updateOrCreate(
            ['evenement_id' => $event->id, 'type' => 'VIP'],
            [
                'prix' => 15000,
                'quantite' => 30,
            ],
        );
    }
}
