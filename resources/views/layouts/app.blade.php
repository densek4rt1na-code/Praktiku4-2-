<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporBanjir - BPBD Kabupaten Bandung</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #eef6fc;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #1565c0;
            color: white;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            flex-wrap: wrap;
            gap: 12px;
        }

        header h1 {
            font-size: 1.4rem;
        }

        header h1 a {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #bbdefb;
        }

        .nav-logout-btn {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-logout-btn:hover {
            background: #d32f2f;
            border-color: #d32f2f;
            color: #ffffff;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 32px 28px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(25, 118, 210, 0.12);
            border: 2px solid #bbdefb;
        }

        h2 {
            color: #1565c0;
            text-align: center;
            margin-bottom: 24px;
            font-size: 1.5rem;
        }

        footer {
            background-color: #0d47a1;
            color: #ffffff;
            text-align: center;
            padding: 14px;
            font-size: 0.85rem;
        }

        /* Utility Form Styles */
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; color: #0d47a1; font-weight: 600; font-size: 0.9rem; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"] {
            width: 100%; padding: 12px 14px; border: 1.5px solid #90caf9;
            border-radius: 10px; font-size: 0.95rem; outline: none; background-color: #f7faff;
        }
        input:focus { border-color: #1e88e5; background-color: #fff; }
        .btn {
            display: block; width: 100%; padding: 12px; background-color: #1976d2; color: white;
            text-align: center; border: none; border-radius: 10px; font-size: 1rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background-color 0.2s;
        }
        .btn:hover { background-color: #1565c0; }

        /* Badge Status */
        .status-badge {
            padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: bold; color: white;
        }
        .waspada { background-color: #fbc02d; color: #333; } /* Yellow */
        .siaga { background-color: #f57c00; } /* Orange */
        .awas { background-color: #d32f2f; } /* Red */

        /* Alert Notifications */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-danger {
            background-color: #ffebee;
            border: 1px solid #ef9a9a;
            color: #b71c1c;
        }
        .alert-success {
            background-color: #e8f5e9;
            border: 1px solid #a5d6a7;
            color: #1b5e20;
        }
    </style>
</head>
<body>

    <header>
        <h1><a href="{{ route('laporan.create') }}">LaporBanjir</a></h1>
        <nav>
            <a href="{{ route('laporan.create') }}">Buat Laporan</a>

            @auth
                <a href="{{ route('laporan.index') }}">Daftar Laporan</a>
                <a href="{{ route('petugas.profile') }}">Profil Petugas</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="nav-logout-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} BPBD Kabupaten Bandung. All Rights Reserved.
    </footer>

</body>
</html>