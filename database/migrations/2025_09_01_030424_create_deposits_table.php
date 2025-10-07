<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('method', ['OM','MOMO','CRYPTO','autres']);
            $table->string('status')->default('pending'); // pending, processing, completed, failed
            $table->string('reference')->nullable()->unique();
            $table->string('phone')->nullable(); // pour MOMO / OM
            $table->text('meta')->nullable(); // JSON pour stocker infos APIs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
