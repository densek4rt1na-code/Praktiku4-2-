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
        Schema::create('cuaca', function (Blueprint $table): void {
            $table->id();
            $table->decimal('suhu', 5, 2)->nullable();
            $table->string('kondisi', 50);
            $table->unsignedSmallInteger('kecepatan_angin')->nullable();
            $table->unsignedTinyInteger('kelembapan')->nullable();
            $table->dateTime('update_terakhir')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuaca');
    }
};
