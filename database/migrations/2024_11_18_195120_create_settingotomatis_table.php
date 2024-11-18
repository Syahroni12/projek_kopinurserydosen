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
        Schema::create('settingotomatis', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['suhu', 'waktu']);
            $table->time('waktu1_awal')->nullable();
            $table->time('waktu1_akhir')->nullable();
            $table->time('waktu2_awal')->nullable();
            $table->time('waktu2_akhir')->nullable();
            $table->float('humidity_awal')->nullable();
            $table->float('humidity_akhir')->nullable();
            $table->float('temperature_awal')->nullable();
            $table->float('temperature_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settingotomatis');
    }
};
