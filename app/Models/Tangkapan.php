<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tangkapan extends Model
{
    protected $table = 'tangkapan';

    protected $fillable = ['kapal_id', 'jenis_ikan', 'berat', 'tanggal_tangkap', 'lokasi_tangkap', 'foto_bukti'];

    protected function casts(): array
    {
        return ['tanggal_tangkap' => 'date', 'berat' => 'decimal:2'];
    }

    public function kapal(): BelongsTo
    {
        return $this->belongsTo(Kapal::class);
    }
}
