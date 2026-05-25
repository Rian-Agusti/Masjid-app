<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('asets', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('kategori')->nullable(); // misal: Elektronik, Furnitur, Kendaraan
        $table->enum('status', ['Baik', 'Perlu Perbaikan', 'Rusak'])->default('Baik');
        $table->text('deskripsi')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
