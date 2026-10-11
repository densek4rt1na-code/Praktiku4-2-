@extends('layouts.app', ['title' => $title])

@section('content')
    <x-page-heading :title="$title" description="Tambah, ubah, atau hapus catatan yang tersimpan." :action-url="route('resources.create', $resource)" action-label="Tambah data" />
    <x-flash-message />
    <section class="panel table-panel full-panel">
        <div class="panel-head"><div><h2>Daftar {{ $title }}</h2><p>{{ number_format($records->total(), 0, ',', '.') }} catatan tersimpan</p></div><span class="live-pill"><span></span> TERHUBUNG KE DATABASE</span></div>
        <div class="table-wrap"><table><thead><tr>
            @foreach ($fields as $field) <th>{{ strtoupper($field['label']) }}</th> @endforeach
            <th>AKSI</th>
        </tr></thead><tbody>
            @forelse ($records as $record)
                <tr>
                    @foreach ($fields as $field)
                        @php($value = ($field['relation'] ?? false) ? $record->kapal?->nama_kapal : data_get($record, $field['name']))
                        <td>
                            @if ($field['type'] === 'currency')
                                Rp {{ number_format((float) $value, 0, ',', '.') }}
                            @elseif ($field['name'] === 'biaya' || $field['name'] === 'harga_per_kg')
                                Rp {{ number_format((float) $value, 0, ',', '.') }}
                            @elseif ($field['type'] === 'date')
                                {{ $value?->translatedFormat('d M Y') ?? '—' }}
                            @elseif ($field['type'] === 'datetime-local')
                                {{ $value?->translatedFormat('d M Y, H:i') ?? '—' }}
                            @else
                                {{ filled($value) ? $value : '—' }}
                            @endif
                        </td>
                    @endforeach
                    <td><div class="row-actions"><a class="edit-button" href="{{ route('resources.edit', [$resource, $record->id]) }}">Ubah</a><form method="POST" action="{{ route('resources.destroy', [$resource, $record->id]) }}" onsubmit="return confirm('Hapus catatan ini?')">@csrf @method('DELETE')<button class="delete-button" type="submit">Hapus</button></form></div></td>
                </tr>
            @empty
                <tr><td colspan="{{ count($fields) + 1 }}" class="empty">Belum ada data di modul ini. Tekan “Tambah data” untuk membuat catatan pertama.</td></tr>
            @endforelse
        </tbody></table></div>
        @if ($records->hasPages()) <div class="pagination-wrap">{{ $records->links() }}</div> @endif
    </section>
@endsection
