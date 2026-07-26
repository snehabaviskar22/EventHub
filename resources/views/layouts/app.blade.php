<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EventHub - College Event Management & Ticket Booking Platform">
    <title>@yield('title', 'EventHub') | EventHub</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #7C3AED;
            --secondary: #F472B6;
            --accent: #F59E0B;
            --bg: #FFF8F2;
            --card: #FFFFFF;
            --text: #2D1B3D;
            --primary-light: #ede4fe;
            --secondary-light: #fce7f3;
        }

        * { font-family: 'Poppins', sans-serif; }

        body {
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .text-primary-brand { color: var(--primary) !important; }
        .text-secondary-brand { color: var(--secondary) !important; }
        .text-accent-brand { color: var(--accent) !important; }
        .bg-primary-brand { background-color: var(--primary) !important; }
        .bg-secondary-brand { background-color: var(--secondary) !important; }
        .bg-accent-brand { background-color: var(--accent) !important; }
        .bg-cream { background-color: var(--bg) !important; }

        .btn-primary-brand {
            background: linear-gradient(135deg, var(--primary), #9333ea);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary-brand:hover {
            background: linear-gradient(135deg, #6d28d9, var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.35);
            color: white;
        }

        .btn-secondary-brand {
            background: linear-gradient(135deg, var(--secondary), #ec4899);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-secondary-brand:hover {
            background: linear-gradient(135deg, #db2777, var(--secondary));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(244, 114, 182, 0.35);
            color: white;
        }

        .btn-accent-brand {
            background: linear-gradient(135deg, var(--accent), #d97706);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-accent-brand:hover {
            background: linear-gradient(135deg, #b45309, var(--accent));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
            color: white;
        }

        .btn-outline-primary-brand {
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-outline-primary-brand:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 2px 20px rgba(124, 58, 237, 0.08);
            border-bottom: 1px solid rgba(124, 58, 237, 0.1);
        }
    @if(auth()->check() && auth()->user()->isAdmin())
        .navbar-custom {
            background: linear-gradient(135deg, rgba(124,58,237,0.97), rgba(45,27,61,0.97));
            box-shadow: 0 4px 24px rgba(124, 58, 237, 0.2);
        }
        .navbar-custom .nav-link, .navbar-custom .navbar-brand-custom {
            color: #fff !important;
        }
        .navbar-custom .nav-link:hover { color: var(--accent) !important; }
        .navbar-brand-custom {
            -webkit-text-fill-color: #fff;
        }
    @endif

        .card-custom {
            background: var(--card);
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(124, 58, 237, 0.08);
            transition: all 0.35s ease;
            overflow: hidden;
        }
        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(124, 58, 237, 0.18);
        }

        .event-card-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .card-custom:hover .event-card-img {
            transform: scale(1.05);
        }

        .badge-countdown {
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            color: white;
            font-weight: 600;
            padding: 0.4rem 0.85rem;
            border-radius: 2rem;
            font-size: 0.8rem;
        }

        .badge-free { background: #16a34a; color: white; }
        .badge-paid { background: var(--accent); color: white; }
        .badge-status-open { background: #16a34a; color: white; }
        .badge-status-closed { background: #dc2626; color: white; }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 1.25rem;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, #9333ea 40%, var(--secondary) 100%);
            color: white;
            border-radius: 0 0 2rem 2rem;
            padding: 4rem 0 5rem;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(245, 158, 11, 0.2);
            border-radius: 50%;
            filter: blur(60px);
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(244, 114, 182, 0.25);
            border-radius: 50%;
            filter: blur(50px);
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            transition: transform 0.3s ease;
        }
        .stat-card:hover { transform: scale(1.05); }

        .form-control-brand, .form-select-brand {
            border-radius: 0.75rem;
            border: 2px solid #e9d5ff;
            padding: 0.65rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control-brand:focus, .form-select-brand:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.15);
        }

        .footer-custom {
            background: linear-gradient(135deg, var(--text), #1a0f26);
            color: #e0d4e8;
            padding: 2.5rem 0 1.5rem;
            margin-top: auto;
        }
        .footer-custom a { color: var(--secondary); text-decoration: none; transition: color 0.2s; }
        .footer-custom a:hover { color: var(--accent); }

        .alert-brand { border-radius: 0.75rem; border: none; }

        .ticket-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
        }
        .ticket-card::before, .ticket-card::after {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: var(--bg);
            border-radius: 50%;
        }
        .ticket-card::before { left: -15px; top: 50%; transform: translateY(-50%); }
        .ticket-card::after { right: -15px; top: 50%; transform: translateY(-50%); }

        .ticket-divider {
            border-top: 2px dashed rgba(255,255,255,0.4);
            margin: 1.5rem 0;
        }

        .dashboard-card {
            border-radius: 1.25rem;
            border: none;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.1);
            transition: all 0.3s ease;
        }
        .dashboard-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(124, 58, 237, 0.15); }

        .icon-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .table-brand thead { background: var(--primary-light); color: var(--primary); }
        .table-brand th { font-weight: 600; }

        main { flex: 1 0 auto; }

        @media (max-width: 768px) {
            .hero-section { padding: 2.5rem 0 3rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
