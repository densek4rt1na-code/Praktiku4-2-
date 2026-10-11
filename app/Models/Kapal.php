<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kapal extends Model
{
    protected $table = 'kapal';

    protected $fillable = ['nama_kapal', 'jenis_kapal', 'nama_kapten', 'status', 'foto'];

    public function tangkapan(): HasMany
    {
        return $this->hasMany(Tangkapan::class);
    }

    public function monitoring(): HasMany
    {
        return $this->hasMany(Monitoring::class);
    }

    public function parkir(): HasMany
    {
        return $this->hasMany(Parking::class);
    }
}
