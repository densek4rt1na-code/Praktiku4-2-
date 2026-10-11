<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuaca extends Model
{
    protected $table = 'cuaca';

    protected $fillable = ['suhu', 'kondisi', 'kecepatan_angin', 'kelembapan', 'update_terakhir'];

    protected function casts(): array
    {
        return ['suhu' => 'decimal:2', 'update_terakhir' => 'datetime'];
    }
}
