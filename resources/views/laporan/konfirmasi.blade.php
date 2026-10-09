@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Konfirmasi Laporan</h2>

    {{-- Penggunaan Komponen Blade <x-alert> --}}
    <x-alert>
        Laporan banjir berhasil dikirim! Terima kasih atas partisipasi Anda.
    </x-alert>

    <div style="background-color: #f7faff; border: 1.5px solid #90caf9; padding: 16px; border-radius: 10px; margin-bottom: 20px;">
        <p style="margin-bottom: 8px;"><strong>Nama Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
        <p style="margin-bottom: 8px;"><strong>Lokasi Kejadian:</strong> {{ $laporan->lokasi }}</p>
        <p><strong>Tinggi Genangan Air:</strong> {{ $laporan->tinggi_genangan }} cm</p>
        <p style="margin-top: 8px;"><strong>Tanggal Kejadian:</strong> {{ $laporan->tanggal_kejadian->format('d-m-Y') }}</p>
    </div>

    <a href="{{ route('laporan.index') }}" class="btn">Lihat Semua Laporan</a>
</div>
@endsection