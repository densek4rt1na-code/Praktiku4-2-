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
        Schema::create('harga_ikan', function (Blueprint $table): void {
            $table->id();
            $table->string('jenis_ikan', 100);
            $table->decimal('harga_per_kg', 12, 2);
            $table->string('lokasi_pasar', 150);
            $table->date('tanggal_update');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_ikan');
    }
};
