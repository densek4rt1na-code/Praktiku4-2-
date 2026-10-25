@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Petugas BPBD</h2>
    <p style="text-align: center; color: #555; font-size: 0.9rem; margin-top: -16px; margin-bottom: 24px;">
        Informasi akun resmi petugas Badan Penanggulangan Bencana Daerah.
    </p>

    <div style="text-align: center; margin-bottom: 24px;">
        <div style="display: inline-flex; justify-content: center; align-items: center; width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #1565c0, #42a5f5); color: white; font-size: 2rem; font-weight: bold; box-shadow: 0 4px 12px rgba(21, 101, 192, 0.3);">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div style="margin-top: 10px;">
            <span style="background-color: #e8f5e9; color: #2e7d32; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 20px; border: 1px solid #a5d6a7;">
                Petugas Aktif
            </span>
        </div>
    </div>

    <div style="background-color: #f7faff; border: 1.5px solid #bbdefb; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        <div style="margin-bottom: 14px; border-bottom: 1px solid #e3f2fd; padding-bottom: 10px;">
            <div style="color: #0d47a1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                Nama Petugas
            </div>
            <div style="color: #212121; font-size: 1.1rem; font-weight: 600; margin-top: 4px;">
                {{ Auth::user()->name }}
            </div>
        </div>

        <div style="margin-bottom: 14px; border-bottom: 1px solid #e3f2fd; padding-bottom: 10px;">
            <div style="color: #0d47a1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                Alamat Email
            </div>
            <div style="color: #212121; font-size: 1.05rem; font-weight: 500; margin-top: 4px;">
                {{ Auth::user()->email }}
            </div>
        </div>

        <div>
            <div style="color: #0d47a1; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                Waktu Pembuatan Akun
            </div>
            <div style="color: #212121; font-size: 1rem; font-weight: 500; margin-top: 4px;">
                {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y, H:i:s') : 'Tidak diketahui' }}
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 12px; flex-direction: column;">
        <a href="{{ route('laporan.index') }}" class="btn">Lihat Daftar Laporan Banjir</a>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn" style="background-color: #d32f2f;">Logout dari Akun</button>
        </form>
    </div>
</div>
@endsection
