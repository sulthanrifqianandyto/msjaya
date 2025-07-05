<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MS Jaya Admin | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --bg-main: #FAF9F6;       /* Soft Beige */
    --bg-sidebar: #14532D;    /* Dark Green */
    --bg-card: #A3B18A;       /* Olive */
    --text-light: #111111;    /* Hitam */
    --accent: #A8FF3E;        /* Neon Lime */
    --accent-hover: #C1FF6D;  /* Versi lebih terang untuk hover */
    --error: #dc2626;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-main);
            color: var(--text-light);
            display: flex;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .sidebar {
    width: 240px;
    background-color: var(--bg-sidebar);
    padding: 2rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    position: fixed;
    height: 100%;
    overflow-y: auto; /* Tambahkan ini */
    transition: transform 0.3s ease;
}


        .sidebar img {
            width: 160px;
            margin: 0 auto 2rem;
        }

        .sidebar a, .sidebar form button {
            color: var(--bg-main);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            transition: background 0.3s;
            display: block;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .sidebar a:hover, .sidebar a.active,
        .sidebar form button:hover {
            background-color: var(--accent);
            color: var(--text-light);
        }

        .sidebar-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            left: 1rem;
            background-color: var(--bg-sidebar);
            color: white;
            border: none;
            padding: 1rem;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            margin-left: 240px;
            transition: margin-left 0.3s ease;
        }

        .card {
            background-color: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-240px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                padding: 1rem;
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>

    <div class="sidebar">
        <img src="{{ asset('images/logo.png') }}" alt="MS Jaya Logo">

        <a href="{{ route('admin.admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.pelanggan.index') }}" class="{{ request()->is('admin/pelanggan*') ? 'active' : '' }}">Pelanggan</a>
        <a href="{{ route('admin.bahanbaku.index') }}" class="{{ request()->is('admin/bahanbaku*') ? 'active' : '' }}">Bahan Baku</a>
        <a href="{{ route('admin.produksi.index') }}" class="{{ request()->is('admin/produksi*') ? 'active' : '' }}">Produksi</a>
        <a href="{{ route('admin.milestone.index') }}" class="{{ request()->is('admin/milestone*') ? 'active' : '' }}">Target</a>
        <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}">Pesanan</a>
        <a href="{{ route('admin.distribusi.index') }}" class="{{ request()->is('admin/distribusi*') ? 'active' : '' }}">Distribusi</a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="card">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
