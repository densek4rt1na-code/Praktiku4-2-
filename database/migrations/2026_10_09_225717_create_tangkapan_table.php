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
        Schema::create('tangkapan', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('kapal_id')->constrained('kapal')->cascadeOnDelete();
            $table->string('jenis_ikan', 100);
            $table->decimal('berat', 10, 2);
            $table->date('tanggal_tangkap');
            $table->string('lokasi_tangkap', 150)->nullable();
            $table->string('foto_bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tangkapan');
    }
};
