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
       Schema::create('jadwal_jumat', function (Blueprint $table) {
    $table->id();
    $table->date('tanggal_jumat');
    $table->string('khatib');
    $table->string('imam');
    $table->string('bilal')->nullable();
    $table->string('muadzin')->nullable();
    $table->string('tema_khutbah')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_jumat');
    }
};
