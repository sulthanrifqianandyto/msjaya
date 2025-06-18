<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --bg-main: #1f2937;
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
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: var(--bg-card);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
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

        .footer-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="login-container">
        @yield('content')
    </div>
</body>
</html>
