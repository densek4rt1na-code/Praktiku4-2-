<?php

namespace App\Http\Controllers;

use App\Models\Cuaca;
use App\Models\FishPrice;
use App\Models\Kapal;
use App\Models\Parking;
use App\Models\Tangkapan;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'activeSection' => 'dashboard',
            'ships' => Kapal::query()->latest()->take(5)->get(),
            'catches' => Tangkapan::query()->with('kapal')->latest('tanggal_tangkap')->take(6)->get(),
            'shipCount' => Kapal::query()->count(),
            'sailingCount' => Kapal::query()->where('status', 'Berlayar')->count(),
            'catchWeight' => Tangkapan::query()->sum('berat'),
            'activeParkingCount' => Parking::query()->where('status', 'Parkir')->count(),
            'weather' => Cuaca::query()->latest('update_terakhir')->first(),
            'fishPrice' => FishPrice::query()->latest('tanggal_update')->first(),
        ]);
    }
}
