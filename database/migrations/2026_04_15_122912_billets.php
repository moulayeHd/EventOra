<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('billets')) {
            return;
        }

         Schema::create('billets', function (Blueprint $table) {
           $table->id();
            $table->string('type');
            $table->decimal('prix', 10, 2);
            $table->integer('quantite');
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::table('migrations')->where('migration', '2026_04_15_122837_billets')->exists()) {
            return;
        }

        Schema::dropIfExists('billets');
    }
};
