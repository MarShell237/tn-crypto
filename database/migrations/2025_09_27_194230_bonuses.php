<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('amount', 15, 2)->nullable(); // montant fixé par admin
            $table->dateTime('expires_at')->nullable();   // durée de validité
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
{
    Schema::disableForeignKeyConstraints();
    Schema::dropIfExists('bonus_user');
    Schema::dropIfExists('bonuses');
    Schema::enableForeignKeyConstraints();
}

};
