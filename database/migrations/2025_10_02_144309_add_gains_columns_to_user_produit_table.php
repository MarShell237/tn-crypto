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
        Schema::table('user_produit', function (Blueprint $table) {
            $table->decimal('montant', 15, 2)->default(0);
            $table->decimal('compte_total', 15, 2)->default(0);
            $table->timestamp('last_gain_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_produit', function (Blueprint $table) {
            $table->dropColumn(['montant', 'compte_total', 'last_gain_at']);
        });
    }

};
