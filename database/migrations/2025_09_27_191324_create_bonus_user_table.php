<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bonus_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bonus_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
