@php($badgeClass = match ($status) {
    'Berlayar', 'Aman', 'Selesai' => 'badge-green',
    'Maintenance', 'Waspada' => 'badge-amber',
    default => 'badge-blue',
})
<span {{ $attributes->class(['badge', $badgeClass]) }}>{{ $status }}</span>
