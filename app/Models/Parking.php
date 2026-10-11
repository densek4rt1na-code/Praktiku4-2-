<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parking extends Model
{
    protected $table = 'parkir';

    protected $fillable = ['kapal_id', 'lokasi_parkir', 'waktu_masuk', 'waktu_keluar', 'status', 'biaya', 'foto_bukti'];

    protected function casts(): array
    {
        return ['waktu_masuk' => 'datetime', 'waktu_keluar' => 'datetime', 'biaya' => 'decimal:2'];
    }

    public function kapal(): BelongsTo
    {
        return $this->belongsTo(Kapal::class);
    }
}
