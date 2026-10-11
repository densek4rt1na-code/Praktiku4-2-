@extends('layouts.app', ['title' => 'Ringkasan'])

@section('content')
    <x-flash-message />
    <div class="page-heading">
        <div><div class="eyebrow"><span></span> PUSAT KENDALI PESISIR</div><h1>Selamat datang di <em>Smart Meritim</em></h1><p>Pantau armada, hasil tangkapan, dan kondisi perairan dalam satu tempat.</p></div>
        <div class="live-pill"><span></span> DATA LANGSUNG</div>
    </div>

    <section class="metric-grid" aria-label="Ringkasan data">
        <article class="metric-card"><div class="metric-top"><span>Total Armada</span><span class="metric-icon blue">◒</span></div><div class="metric-value">{{ number_format($shipCount, 0, ',', '.') }} <small>kapal</small></div><div class="metric-note"><span class="status-dot teal"></span> {{ $sailingCount }} kapal sedang berlayar</div></article>
        <article class="metric-card"><div class="metric-top"><span>Total Tangkapan</span><span class="metric-icon aqua">♧</span></div><div class="metric-value">{{ number_format((float) $catchWeight, 0, ',', '.') }} <small>kg</small></div><div class="metric-note">Akumulasi catatan hasil tangkapan</div></article>
        <article class="metric-card"><div class="metric-top"><span>Kapal Bersandar</span><span class="metric-icon amber">⚓</span></div><div class="metric-value">{{ $activeParkingCount }} <small>kapal</small></div><div class="metric-note">Tercatat sedang berada di area parkir</div></article>
        <article class="metric-card weather-card"><div class="metric-top"><span>Cuaca Perairan</span><span class="metric-icon sky">☼</span></div><div class="metric-value">{{ $weather?->suhu ? number_format((float) $weather->suhu, 1, ',', '.') . '°' : '—' }} <small>{{ $weather?->kondisi ?? 'Belum ada data' }}</small></div><div class="metric-note">Angin {{ $weather?->kecepatan_angin ?? '—' }} km/jam <span class="note-divider">·</span> Kelembapan {{ $weather?->kelembapan ?? '—' }}%</div></article>
    </section>

    <section class="content-grid">
        <article class="panel table-panel">
            <div class="panel-head"><div><h2>Aktivitas Tangkapan</h2><p>Data tangkapan terbaru dari armada</p></div><a class="text-link" href="{{ route('section', 'tangkapan') }}">Lihat semua <span>→</span></a></div>
            <div class="table-wrap"><table><thead><tr><th>JENIS IKAN</th><th>KAPAL</th><th>BERAT</th><th>TANGGAL</th></tr></thead><tbody>
                @forelse ($catches as $catch)
                    <tr><td><span class="fish-symbol">♧</span><strong>{{ $catch->jenis_ikan }}</strong></td><td>{{ $catch->kapal?->nama_kapal ?? '—' }}</td><td>{{ number_format((float) $catch->berat, 0, ',', '.') }} kg</td><td>{{ $catch->tanggal_tangkap?->translatedFormat('d M Y') }}</td></tr>
                @empty
                    <tr><td colspan="4" class="empty">Belum ada data. Jalankan <code>php artisan db:seed</code> untuk mengisi data contoh.</td></tr>
                @endforelse
            </tbody></table></div>
        </article>
        <article class="panel ship-panel">
            <div class="panel-head"><div><h2>Status Armada</h2><p>Armada terdaftar terkini</p></div><a class="icon-link" href="{{ route('section', 'kapal') }}" aria-label="Lihat data kapal">↗</a></div>
            <div class="ship-list">
                @forelse ($ships as $ship)
                    <div class="ship-row"><div class="ship-avatar">⌁</div><div class="ship-info"><strong>{{ $ship->nama_kapal }}</strong><small>{{ $ship->jenis_kapal }} · {{ $ship->nama_kapten }}</small></div><x-status-badge :status="$ship->status" /></div>
                @empty
                    <div class="empty">Data kapal akan tampil setelah seeder dijalankan.</div>
                @endforelse
            </div>
            <div class="market-note"><div class="market-icon">↗</div><div><small>HARGA PASAR TERBARU</small><strong>{{ $fishPrice?->jenis_ikan ?? 'Belum ada data' }} <span>{{ $fishPrice ? 'Rp ' . number_format((float) $fishPrice->harga_per_kg, 0, ',', '.') . '/kg' : '' }}</span></strong><small>{{ $fishPrice?->lokasi_pasar ?? 'Lengkapi data dengan seeder' }}</small></div></div>
        </article>
    </section>
@endsection
