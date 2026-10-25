<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // 1. Halaman Form Pelaporan
    public function create()
    {
        return view('laporan.create');
    }

    // 2. Simpan data form ke database, lalu tampilkan halaman konfirmasi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tinggi_genangan' => 'required|integer|min:0',
            'tanggal_kejadian' => 'required|date',
        ]);

        $laporan = Laporan::create($validated);

        return view('laporan.konfirmasi', compact('laporan'));
    }

    // 3. Halaman Daftar Laporan (data dari database)
    public function index()
    {
        $laporanList = Laporan::all();

        return view('laporan.index', compact('laporanList'));
    }
}
