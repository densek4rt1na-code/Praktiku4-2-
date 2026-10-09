@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Pelaporan Banjir</h2>

    @if($errors->any())
        <div style="background:#ffebee;border:1px solid #ef9a9a;color:#b71c1c;padding:12px;border-radius:10px;margin-bottom:16px;font-size:0.9rem;">
            <ul style="margin-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_pelapor">Nama Pelapor:</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Masukkan nama Anda" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi Kejadian:</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Masukkan lokasi kejadian" required>
        </div>

        <div class="form-group">
            <label for="tinggi_genangan">Tinggi Genangan Air (cm):</label>
            <input type="number" id="tinggi_genangan" name="tinggi_genangan" min="0" value="{{ old('tinggi_genangan') }}" placeholder="Contoh: 50" required>
        </div>

        <div class="form-group">
            <label for="tanggal_kejadian">Tanggal Kejadian:</label>
            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" required>
        </div>

        <button type="submit" class="btn">Kirim Laporan</button>
    </form>
</div>
@endsection