<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishPrice extends Model
{
    protected $table = 'harga_ikan';

    protected $fillable = ['jenis_ikan', 'harga_per_kg', 'lokasi_pasar', 'tanggal_update', 'foto'];

    protected function casts(): array
    {
        return ['tanggal_update' => 'date', 'harga_per_kg' => 'decimal:2'];
    }
}
