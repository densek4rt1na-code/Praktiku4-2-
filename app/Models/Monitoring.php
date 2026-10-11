<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitoring extends Model
{
    protected $table = 'monitoring';

    protected $fillable = ['kapal_id', 'lokasi', 'status_monitoring', 'waktu_monitoring'];

    protected function casts(): array
    {
        return ['waktu_monitoring' => 'datetime'];
    }

    public function kapal(): BelongsTo
    {
        return $this->belongsTo(Kapal::class);
    }
}
