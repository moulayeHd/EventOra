<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('espaces')) {
            if (! Schema::hasColumn('espaces', 'localisation')) {
                Schema::table('espaces', function (Blueprint $table) {
                    $table->string('localisation')->nullable()->after('description');
                });
            }

            if (Schema::hasColumn('espaces', 'description') && DB::getDriverName() === 'mysql') {
                DB::statement('ALTER TABLE espaces MODIFY description VARCHAR(255) NULL');
                DB::table('espaces')
                    ->whereNull('localisation')
                    ->update(['localisation' => DB::raw('description')]);
            }
        }

        if (Schema::hasTable('evenements')) {
            Schema::table('evenements', function (Blueprint $table) {
                if (! Schema::hasColumn('evenements', 'heure_debut')) {
                    $table->time('heure_debut')->default('09:00:00')->after('date');
                }

                if (! Schema::hasColumn('evenements', 'heure_fin')) {
                    $table->time('heure_fin')->default('18:00:00')->after('heure_debut');
                }
            });
        }

        if (Schema::hasTable('billets')) {
            if (DB::getDriverName() === 'mysql') {
                foreach (['nom', 'prenom', 'email', 'evenement'] as $column) {
                    if (Schema::hasColumn('billets', $column)) {
                        DB::statement("ALTER TABLE billets MODIFY {$column} VARCHAR(255) NULL");
                    }
                }
            }

            Schema::table('billets', function (Blueprint $table) {
                if (! Schema::hasColumn('billets', 'type')) {
                    $table->string('type')->default('Standard')->after('id');
                }

                if (! Schema::hasColumn('billets', 'prix')) {
                    $table->decimal('prix', 10, 2)->default(0)->after('type');
                }

                if (! Schema::hasColumn('billets', 'quantite')) {
                    $table->integer('quantite')->default(0)->after('prix');
                }

                if (! Schema::hasColumn('billets', 'evenement_id')) {
                    $table->foreignId('evenement_id')
                        ->nullable()
                        ->after('quantite')
                        ->constrained()
                        ->nullOnDelete();
                }
            });
        }

        if (Schema::hasTable('reservations')) {
            if (DB::getDriverName() === 'mysql') {
                if (Schema::hasColumn('reservations', 'nom')) {
                    DB::statement('ALTER TABLE reservations MODIFY nom VARCHAR(255) NULL');
                }

                if (Schema::hasColumn('reservations', 'description')) {
                    DB::statement('ALTER TABLE reservations MODIFY description TEXT NULL');
                }

                if (Schema::hasColumn('reservations', 'date')) {
                    DB::statement('ALTER TABLE reservations MODIFY date DATETIME NULL');
                }

                if (Schema::hasColumn('reservations', 'espace_id')) {
                    DB::statement('ALTER TABLE reservations MODIFY espace_id BIGINT UNSIGNED NULL');
                }
            }

            Schema::table('reservations', function (Blueprint $table) {
                if (! Schema::hasColumn('reservations', 'user_id')) {
                    $table->foreignId('user_id')
                        ->nullable()
                        ->after('id')
                        ->constrained()
                        ->cascadeOnDelete();
                }

                if (! Schema::hasColumn('reservations', 'billet_id')) {
                    $table->foreignId('billet_id')
                        ->nullable()
                        ->after('user_id')
                        ->constrained('billets')
                        ->cascadeOnDelete();
                }

                if (! Schema::hasColumn('reservations', 'quantite')) {
                    $table->integer('quantite')->default(1)->after('billet_id');
                }
            });
        }

        if (Schema::hasTable('programmes')) {
            Schema::table('programmes', function (Blueprint $table) {
                if (! Schema::hasColumn('programmes', 'titre')) {
                    $table->string('titre')->nullable()->after('id');
                }

                if (! Schema::hasColumn('programmes', 'heure')) {
                    $table->time('heure')->nullable()->after('description');
                }

                if (! Schema::hasColumn('programmes', 'evenement_id')) {
                    $table->foreignId('evenement_id')
                        ->nullable()
                        ->after('heure')
                        ->constrained('evenements')
                        ->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        //
    }
};
