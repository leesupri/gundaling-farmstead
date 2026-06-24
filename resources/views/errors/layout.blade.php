<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gundaling Farmstead')</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --farm-950: #0e1810;
            --farm-900: #162318;
            --farm-700: #1e4b1f;
            --farm-600: #2c5f2d;
            --farm-200: #b3d9b7;
            --earth-200: #f9f6ef;
            --earth-600: #7b4b2d;
            --gold: #f5c542;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem 1.5rem;
            background: var(--earth-200);
            color: var(--farm-950);
            font-family: 'Nunito', ui-sans-serif, system-ui, sans-serif;
        }
        .mascot {
            height: 12rem;
            margin-bottom: 1.5rem;
            animation: float 3.6s ease-in-out infinite;
        }
        @media (prefers-reduced-motion: reduce) {
            .mascot { animation: none; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .code {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: clamp(3rem, 10vw, 5rem);
            color: var(--farm-700);
            line-height: 1;
            margin: 0;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: clamp(1.4rem, 4vw, 2rem);
            margin: 0.5rem 0 0.75rem;
            color: var(--farm-950);
        }
        p.message {
            max-width: 32rem;
            color: var(--earth-600);
            font-size: 1.05rem;
            line-height: 1.6;
            margin: 0 0 2rem;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 2.5rem;
        }
        .btn {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            transition: opacity 0.2s ease;
            cursor: pointer;
        }
        .btn:hover { opacity: 0.85; }
        .btn-primary { background: var(--farm-600); color: #fff; }
        .btn-secondary { background: #fff; color: var(--farm-700); border: 1px solid var(--farm-200); }
        .btn-gold { background: var(--gold); color: var(--farm-950); }
        nav.quicklinks {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            justify-content: center;
            font-size: 0.9rem;
        }
        nav.quicklinks a {
            color: var(--farm-700);
            text-decoration: none;
            border-bottom: 1px solid transparent;
            cursor: pointer;
        }
        nav.quicklinks a:hover {
            border-bottom-color: var(--farm-700);
        }
    </style>
</head>
<body>
    @yield('content')

    <nav class="quicklinks" aria-label="Quick links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('menu') }}">Menu</a>
        <a href="{{ route('reservations') }}">Reservations</a>
        <a href="{{ route('promo') }}">Promo</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
</body>
</html>
