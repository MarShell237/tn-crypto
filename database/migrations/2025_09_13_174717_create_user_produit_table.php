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
        Schema::create('user_produit', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');

        // Infos liées à l’achat
        $table->integer('duree'); 
        $table->decimal('revenu', 15, 2); 
        $table->decimal('prix', 15, 2);

        // Colonnes pour gestion des gains
        $table->decimal('montant', 15, 2)->default(0);       // cumul du jour
        $table->decimal('compte_total', 15, 2)->default(0);  // cumul global
        // $table->timestamp('last_gain_at')->nullable();       // dernière fois qu’il a reçu un gain

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_produit');
    }
};
