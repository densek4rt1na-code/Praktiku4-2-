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
        Schema::create('kapal', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_kapal', 100)->unique();
            $table->string('jenis_kapal', 50);
            $table->string('nama_kapten', 100);
            $table->string('status', 20)->default('Bersandar');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapal');
    }
};
