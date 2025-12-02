<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fitkomove')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@400;600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- GLOBAL THEME --- */
        :root {
            --primary-red: #E60000;
            --dark-bg: #0a0a0a;
            --card-bg: #141414;
        }

        body {
            background-color: var(--dark-bg);
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
            padding-top: 76px; /* Mencegah konten tertutup Navbar */
        }

        h1, h2, h3, h4, h5, .navbar-brand, .btn {
            font-family: 'Teko', sans-serif; /* Font Sporty yang Tegas */
            text-transform: uppercase;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: rgba(0, 0, 0, 0.95);
            border-bottom: 2px solid var(--primary-red);
            backdrop-filter: blur(10px);
        }
        
        .nav-link {
            font-size: 1.2rem;
            color: #ccc !important;
            transition: color 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-red) !important;
        }

        /* --- BUTTONS --- */
        .btn-red {
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 0;
            padding: 10px 30px;
            font-size: 1.3rem;
            letter-spacing: 1px;
            transition: all 0.3s;
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%); /* Efek miring sporty */
        }

        .btn-red:hover {
            background-color: #ff1a1a;
            transform: translateX(5px);
            color: white;
        }

        .btn-outline-red {
            background-color: transparent;
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            border-radius: 0;
            padding: 8px 30px;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        .btn-outline-red:hover {
            background-color: var(--primary-red);
            color: white;
        }

        /* --- CARDS & FORMS --- */
        .custom-card {
            background-color: var(--card-bg);
            border: 1px solid #333;
            border-radius: 8px;
            overflow: hidden;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #444;
            color: white;
            padding: 12px;
        }

        .form-control:focus {
            background-color: #222;
            border-color: var(--primary-red);
            color: white;
            box-shadow: 0 0 10px rgba(230, 0, 0, 0.3);
        }

        /* Hero Image Overlay */
        .hero-overlay {
            background: linear-gradient(90deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 100%);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fs-2" href="{{ url('/') }}">
                <span style="color: white;">FIT</span><span style="color: var(--primary-red);">KOMOVE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                        <li class="nav-item"><a href="{{ url('/dashboard') }}" class="btn btn-red">Dashboard</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-red">Sign Up</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-black text-center py-4 border-top border-dark mt-auto">
        <p class="mb-0 text-secondary">&copy; {{ date('Y') }} SportTracker Inc.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>