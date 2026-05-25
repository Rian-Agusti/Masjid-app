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
        Schema::create('keuangans', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->enum('type', ['income', 'expense']); // kas masuk / keluar
    $table->string('category'); // Operasional, Anak Yatim, Pembangunan, dll
    $table->decimal('amount', 15, 2); // nominal uang
    $table->text('description')->nullable();
    $table->date('date')->default(now());

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
