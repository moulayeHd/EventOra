<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes_organisateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('nom_groupe');
            $table->enum('type_evenements', [
                'concert',
                'gala',
                'sport',
                'culturel',
                'conference',
                'autre'
            ]);
            $table->string('telephone', 20);
            $table->text('description');
            $table->enum('statut', [
                'en_attente',
                'approuve',
                'refuse'
            ])->default('en_attente');
            $table->text('message_refus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_organisateur');
    }
};
