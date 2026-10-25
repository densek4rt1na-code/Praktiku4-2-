<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#071522">
    <title>Masuk · Smart Meritim</title>
    <link rel="stylesheet" href="{{ asset('css/smartmeritim.css') }}">
</head>
<body>
    <div class="auth-page">
        <div class="auth-shell">
            <a class="brand auth-brand" href="{{ route('dashboard') }}">
                <span class="brand-mark">S<span>·</span></span>
                <span><strong>smart<span>meritim</span></strong><small>MONITORING PESISIR</small></span>
            </a>

            <div class="auth-card">
                <div class="eyebrow"><span></span> AUTENTIKASI PETUGAS</div>
                <h1>Masuk Sistem</h1>
                <p class="auth-subtitle">Silakan masukkan email dan kata sandi Anda untuk mengelola data maritim.</p>

                <x-flash-message />

                <form class="auth-form" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <label for="email">Alamat Email <span class="required-mark">*</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="contoh: admin@smartmeritim.id"
                        autocomplete="email"
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <label for="password">Kata Sandi <span class="required-mark">*</span></label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Masukkan kata sandi akun"
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <label class="remember-row" for="remember">
                        <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        Ingat sesi saya di perangkat ini
                    </label>

                    <button type="submit" class="primary-button auth-submit">
                        Masuk ke Sistem <span>→</span>
                    </button>
                </form>

                <div class="auth-switch">
                    Belum memiliki akun? <a href="{{ route('register') }}">Daftar akun baru</a>
                </div>

                <div class="seed-hint">
                    Akun uji coba default: <code>admin@smartmeritim.id</code> &nbsp;|&nbsp; Sandi: <code>password123</code>
                </div>
            </div>

            <div class="auth-foot">
                &larr; Kembali ke <a href="{{ route('dashboard') }}" style="color: #60d8bd;">Halaman Ringkasan</a>
            </div>
        </div>
    </div>
</body>
</html>
