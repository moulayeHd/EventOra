<?php

namespace Database\Seeders;

use App\Models\DemandeOrganisateur;
use App\Models\Espace;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin principal ────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@eventora.ml'],
            [
                'name'     => 'Administrateur EventOra',
                'password' => bcrypt('Admin@2026'),
                'role'     => User::ROLE_ADMINISTRATEUR,
            ]
        );

        // ─── Organisateurs par défaut ───────────────────────
        $organisateur1 = User::firstOrCreate(
            ['email' => 'lions@eventora.ml'],
            [
                'name'     => 'Moussa Traoré',
                'password' => bcrypt('Orga@2026'),
                'role'     => User::ROLE_ORGANISATEUR,
            ]
        );

        $organisateur2 = User::firstOrCreate(
            ['email' => 'bamako.events@eventora.ml'],
            [
                'name'     => 'Fatoumata Diallo',
                'password' => bcrypt('Orga@2026'),
                'role'     => User::ROLE_ORGANISATEUR,
            ]
        );

        // ─── Demandes approuvées pour les organisateurs ─────
        DemandeOrganisateur::firstOrCreate(
            ['user_id' => $organisateur1->id],
            [
                'nom_groupe'      => 'Les Lions de Bamako',
                'type_evenements' => 'concert',
                'telephone'       => '+223 70 11 22 33',
                'description'     => 'Groupe de jeunes passionnés de musique qui organisent des concerts et soirées culturelles à Bamako depuis 2020. Notre public cible est la jeunesse malienne.',
                'statut'          => 'approuve',
            ]
        );

        DemandeOrganisateur::firstOrCreate(
            ['user_id' => $organisateur2->id],
            [
                'nom_groupe'      => 'Bamako Events Pro',
                'type_evenements' => 'gala',
                'telephone'       => '+223 76 44 55 66',
                'description'     => 'Association professionnelle spécialisée dans l\'organisation de galas, conférences et événements d\'entreprise à Bamako et dans les régions du Mali.',
                'statut'          => 'approuve',
            ]
        );

        // ─── Espaces par défaut ─────────────────────────────
        $espaces = [
            [
                'nom'          => 'Palais de la Culture',
                'localisation' => 'Bamako, Badalabougou',
                'capacite'     => 2000,
            ],
            [
                'nom'          => 'Stade Omnisports Modibo Keïta',
                'localisation' => 'Bamako, Hippodrome',
                'capacite'     => 10000,
            ],
            [
                'nom'          => 'Salle Omnisports de Bamako',
                'localisation' => 'Bamako, ACI 2000',
                'capacite'     => 5000,
            ],
            [
                'nom'          => 'Centre Culturel Français',
                'localisation' => 'Bamako, Hamdallaye',
                'capacite'     => 500,
            ],
            [
                'nom'          => 'Hôtel Radisson Blu',
                'localisation' => 'Bamako, Quartier du Fleuve',
                'capacite'     => 800,
            ],
        ];

        foreach ($espaces as $espace) {
            Espace::firstOrCreate(
                ['nom' => $espace['nom']],
                $espace
            );
        }
    }
}