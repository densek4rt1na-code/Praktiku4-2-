<div style="background-color: #f7faff; border: 1.5px solid #90caf9; padding: 16px; border-radius: 10px; margin-bottom: 14px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
        <strong style="color: #0d47a1;">{{ $item->nama_pelapor }}</strong>
        
        {{-- Logika Penentuan Status --}}
        @if($item->tinggi_genangan < 30)
            <span class="status-badge waspada">Waspada</span>
        @elseif($item->tinggi_genangan >= 30 && $item->tinggi_genangan <= 70)
            <span class="status-badge siaga">Siaga</span>
        @else
            <span class="status-badge awas">Awas</span>
        @endif
    </div>

    <div style="font-size: 0.9rem; color: #444;">
        <p style="margin-bottom: 4px;"><strong>Lokasi:</strong> {{ $item->lokasi }}</p>
        <p><strong>Tinggi Genangan:</strong> {{ $item->tinggi_genangan }} cm</p>
        <p style="margin-top: 4px;"><strong>Tanggal:</strong> {{ $item->tanggal_kejadian->format('d-m-Y') }}</p>
    </div>
</div>