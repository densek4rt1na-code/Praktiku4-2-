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
        Schema::create('monitoring', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('kapal_id')->constrained('kapal')->cascadeOnDelete();
            $table->string('lokasi', 150);
            $table->string('status_monitoring', 20)->default('Aman');
            $table->dateTime('waktu_monitoring')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};
