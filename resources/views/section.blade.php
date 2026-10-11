@extends('layouts.app', ['title' => $title])

@section('content')
    <div class="page-heading section-heading"><div><div class="eyebrow"><span></span> DATA SMART MARITIM</div><h1>{{ $title }}</h1><p>{{ $subtitle }}</p></div></div>
    <section class="panel table-panel full-panel"><div class="panel-head"><div><h2>{{ $title }}</h2><p>{{ number_format($rows->count(), 0, ',', '.') }} catatan tersimpan</p></div><span class="live-pill"><span></span> TERHUBUNG KE DATABASE</span></div>
        <div class="table-wrap"><table><thead><tr>
            @switch($activeSection)
                @case('kapal') <th>NAMA KAPAL</th><th>JENIS</th><th>NAMA KAPTEN</th><th>STATUS</th> @break
                @case('tangkapan') <th>JENIS IKAN</th><th>KAPAL</th><th>BERAT</th><th>TANGGAL</th><th>LOKASI</th> @break
                @case('monitoring') <th>KAPAL</th><th>LOKASI TERAKHIR</th><th>STATUS</th><th>WAKTU</th> @break
                @case('parkir') <th>KAPAL</th><th>LOKASI PARKIR</th><th>MASUK</th><th>KELUAR</th><th>STATUS</th><th>BIAYA</th> @break
                @case('harga-ikan') <th>JENIS IKAN</th><th>HARGA / KG</th><th>LOKASI PASAR</th><th>TANGGAL UPDATE</th> @break
                @case('cuaca') <th>KONDISI</th><th>SUHU</th><th>ANGIN</th><th>KELEMBAPAN</th><th>WAKTU UPDATE</th> @break
            @endswitch
        </tr></thead><tbody>
            @forelse ($rows as $row)
                <tr>
                    @switch($activeSection)
                        @case('kapal') <td><strong>{{ $row->nama_kapal }}</strong></td><td>{{ $row->jenis_kapal }}</td><td>{{ $row->nama_kapten }}</td><td><span class="badge badge-blue">{{ $row->status }}</span></td> @break
                        @case('tangkapan') <td><strong>{{ $row->jenis_ikan }}</strong></td><td>{{ $row->kapal?->nama_kapal }}</td><td>{{ number_format((float) $row->berat, 0, ',', '.') }} kg</td><td>{{ $row->tanggal_tangkap?->translatedFormat('d M Y') }}</td><td>{{ $row->lokasi_tangkap }}</td> @break
                        @case('monitoring') <td><strong>{{ $row->kapal?->nama_kapal }}</strong></td><td>{{ $row->lokasi }}</td><td><span class="badge {{ $row->status_monitoring === 'Aman' ? 'badge-green' : 'badge-amber' }}">{{ $row->status_monitoring }}</span></td><td>{{ $row->waktu_monitoring?->translatedFormat('d M Y, H:i') }}</td> @break
                        @case('parkir') <td><strong>{{ $row->kapal?->nama_kapal }}</strong></td><td>{{ $row->lokasi_parkir }}</td><td>{{ $row->waktu_masuk?->translatedFormat('d M Y, H:i') }}</td><td>{{ $row->waktu_keluar?->translatedFormat('d M Y, H:i') ?? '—' }}</td><td><span class="badge badge-blue">{{ $row->status }}</span></td><td>Rp {{ number_format((float) $row->biaya, 0, ',', '.') }}</td> @break
                        @case('harga-ikan') <td><strong>{{ $row->jenis_ikan }}</strong></td><td>Rp {{ number_format((float) $row->harga_per_kg, 0, ',', '.') }}</td><td>{{ $row->lokasi_pasar }}</td><td>{{ $row->tanggal_update?->translatedFormat('d M Y') }}</td> @break
                        @case('cuaca') <td><strong>{{ $row->kondisi }}</strong></td><td>{{ $row->suhu }} °C</td><td>{{ $row->kecepatan_angin }} km/jam</td><td>{{ $row->kelembapan }}%</td><td>{{ $row->update_terakhir?->translatedFormat('d M Y, H:i') }}</td> @break
                    @endswitch
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Belum ada data. Jalankan <code>php artisan db:seed</code> untuk menampilkan data contoh.</td></tr>
            @endforelse
        </tbody></table></div>
    </section>
@endsection
