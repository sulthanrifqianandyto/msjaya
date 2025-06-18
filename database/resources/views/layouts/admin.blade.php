<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --bg-main: #1f2937;
            --bg-sidebar: #111827;
            --bg-card: #1e293b;
            --text-light: #f3f4f6;
            --accent: #10b981;
            --accent-hover: #059669;
            --error: #f87171;
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
        }

        .sidebar {
            width: 220px;
            background-color: var(--bg-sidebar);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .sidebar a {
            color: var(--text-light);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: var(--accent);
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .card {
            background-color: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1.2rem;
            border: none;
            border-radius: 6px;
            background-color: #374151;
            color: #f9fafb;
        }

        button {
            width: 100%;
            padding: 0.7rem;
            background-color: var(--accent);
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--accent-hover);
        }

        .error {
            color: var(--error);
            text-align: center;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="/dashboard" class="active">Dashboard</a>
        <a href="/users">Users</a>
        <a href="/settings">Settings</a>
        <a href="/logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>
