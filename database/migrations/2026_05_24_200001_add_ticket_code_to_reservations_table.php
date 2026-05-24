<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('reservations', 'ticket_code')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->string('ticket_code')->nullable()->unique()->after('quantite');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('reservations', 'ticket_code')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->dropUnique(['ticket_code']);
                $table->dropColumn('ticket_code');
            });
        }
    }
};
