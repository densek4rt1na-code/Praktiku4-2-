<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#071522">
    <title>{{ $title ?? 'Ringkasan' }} · Smart Meritim</title>
    <link rel="stylesheet" href="{{ asset('css/smartmeritim.css') }}">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('dashboard') }}">
                <span class="brand-mark">S<span>·</span></span>
                <span><strong>smart<span>meritim</span></strong><small>MONITORING PESISIR</small></span>
            </a>
            <div class="nav-label">MENU UTAMA</div>
            <nav class="side-nav" aria-label="Navigasi utama">
                <a class="{{ ($activeSection ?? '') === 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="nav-icon">⌂</span> Ringkasan</a>
                <a class="{{ ($activeSection ?? '') === 'kapal' ? 'active' : '' }}" href="{{ route('resources.index', 'kapal') }}"><span class="nav-icon">◒</span> Data Kapal</a>
                <a class="{{ ($activeSection ?? '') === 'tangkapan' ? 'active' : '' }}" href="{{ route('resources.index', 'tangkapan') }}"><span class="nav-icon">♧</span> Hasil Tangkapan</a>
                <a class="{{ ($activeSection ?? '') === 'monitoring' ? 'active' : '' }}" href="{{ route('resources.index', 'monitoring') }}"><span class="nav-icon">◎</span> Monitoring</a>
                <a class="{{ ($activeSection ?? '') === 'parkir' ? 'active' : '' }}" href="{{ route('resources.index', 'parkir') }}"><span class="nav-icon">⚓</span> Parkir Kapal</a>
                <a class="{{ ($activeSection ?? '') === 'harga-ikan' ? 'active' : '' }}" href="{{ route('resources.index', 'harga-ikan') }}"><span class="nav-icon">↗</span> Harga Ikan</a>
                <a class="{{ ($activeSection ?? '') === 'cuaca' ? 'active' : '' }}" href="{{ route('resources.index', 'cuaca') }}"><span class="nav-icon">☼</span> Kondisi Cuaca</a>
            </nav>
            <div class="sidebar-bottom">
                <div class="online"><span></span> Sistem beroperasi</div>
                <div class="sidebar-caption">SMART MARITIM <span>v1.0</span></div>
            </div>
        </aside>
        <main class="main-area">
            <header class="topbar">
                <div class="breadcrumb"><span>SMART MARITIM</span><b>/</b><strong>{{ strtoupper($title ?? 'RINGKASAN') }}</strong></div>
                <div class="topbar-right"><span class="top-date">{{ now()->translatedFormat('l, d F Y') }}</span><span class="user-name">Data Terpadu</span><div class="avatar" aria-hidden="true">SM</div></div>
            </header>
            <div class="page-content">@yield('content')</div>
            <footer class="footer">Smart Meritim <span>·</span> Sistem informasi dan pemantauan perikanan</footer>
        </main>
    </div>
</body>
</html>
