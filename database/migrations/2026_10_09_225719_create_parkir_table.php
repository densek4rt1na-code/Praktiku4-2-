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
        Schema::create('parkir', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('kapal_id')->constrained('kapal')->cascadeOnDelete();
            $table->string('lokasi_parkir', 150);
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->string('status', 20)->default('Parkir');
            $table->decimal('biaya', 12, 2)->default(0);
            $table->string('foto_bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir');
    }
};
