@props([
    'title' => 'Nusa Event — Panel Admin',
    'description' => 'Panel pengelolaan katalog sewa dan konten website Nusa Event.',
    'type' => 'guest',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description }}">
    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-7.2.0-web/css/all.min.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">

    <style>
        :root {
            --bs-primary: #0d6865;
            --bs-primary-rgb: 13, 104, 101;
            --primary-light: #3f948f;
            --bs-secondary: #d99b4b;
            --bs-success: #10b981;
            --bs-warning: #d99b4b;
            --bs-danger: #d64545;
            --teal: #0d6865;
            --teal-dark: #084d4b;
            --mint: #e6f3ef;
            --gold: #d99b4b;
            --ink: #102a2b;
            --text-primary: #102a2b;
            --text-secondary: #4d6b68;
            --text-muted: #7b948f;
            --border-color: #dce9e5;
            --bg-light: #f2f8f5;
            --bg-white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        h1, .h1 {
            font-weight: 800;
        }

        /* ===== NAVBAR (shared across all pages) ===== */
        .site-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .site-navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .site-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--teal);
            font-family: 'Archivo', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .site-brand i {
            color: var(--gold);
            font-size: 1.4rem;
        }

        .site-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .site-nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .site-nav-link:hover {
            color: var(--bs-primary);
        }

        .site-navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-nav-outline {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-nav-outline:hover {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
        }

        .btn-nav-primary {
            background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(13, 104, 101, 0.28);
        }

        .btn-nav-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 104, 101, 0.38);
            color: white;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .site-nav {
                display: none;
            }

            .site-navbar-container {
                padding: .85rem 1.25rem;
            }

            .btn-nav-outline {
                padding: 0.55rem 0.9rem;
                font-size: 0.85rem;
            }
        }

        /* ===== GUEST PAGE STYLES ===== */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section {
            padding: 6rem 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(13, 104, 101, 0.28);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 104, 101, 0.38);
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--bg-white);
            border-top: 1px solid var(--border-color);
            padding: 3rem 0;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-brand p {
            color: var(--text-secondary);
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .footer-links {
            display: flex;
            gap: 4rem;
        }

        .footer-column h4 {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 0.75rem;
        }

        .footer-column a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: var(--bs-primary);
        }

        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: var(--bs-primary);
            color: white;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }

            .footer-links {
                flex-direction: column;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        /* ===== AUTH PAGE STYLES ===== */
        .auth-section {
            min-height: calc(100vh - 73px);
            margin-top: 73px;
            background:
                radial-gradient(circle at 15% 20%, rgba(217, 155, 75, .35), transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(230, 243, 239, .25), transparent 50%),
                linear-gradient(135deg, #0d6865 0%, #102a2b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        /* decorative background shapes */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .bg-shapes .shape {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(230, 243, 239, .22);
            background: rgba(230, 243, 239, .06);
            animation: float 15s infinite ease-in-out;
        }

        .bg-shapes .shape:nth-child(1) {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .bg-shapes .shape:nth-child(2) {
            width: 300px;
            height: 300px;
            bottom: -50px;
            right: -50px;
            animation-delay: -5s;
        }

        .bg-shapes .shape:nth-child(3) {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            33% {
                transform: translateY(-30px) rotate(10deg);
            }
            66% {
                transform: translateY(20px) rotate(-5deg);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 30px 60px -20px rgba(6, 34, 33, 0.55);
            padding: 2.75rem;
            border: 1px solid rgba(230, 243, 239, 0.4);
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--teal), var(--gold));
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo .icon-wrapper {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
            border-radius: 1.4rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 14px 30px rgba(13, 104, 101, 0.28);
        }

        .brand-logo .icon-wrapper i {
            font-size: 2rem;
            color: var(--gold);
        }

        .brand-kicker {
            display: inline-block;
            color: var(--teal);
            font-family: 'Archivo', sans-serif;
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
            margin-bottom: .6rem;
        }

        .brand-logo h1 {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
        }

        .brand-logo p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .form-floating {
            margin-bottom: 1.25rem;
        }

        .form-floating .form-control {
            height: 60px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fbfcfa;
            color: var(--text-primary);
        }

        .form-floating .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(13, 104, 101, 0.12);
            background: #ffffff;
        }

        .form-floating label {
            padding: 1rem 1rem 1rem 3rem;
            color: var(--text-muted);
        }

        .form-floating .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
            z-index: 5;
            transition: color 0.3s ease;
        }

        .form-floating:focus-within .input-icon {
            color: var(--bs-primary);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            z-index: 5;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--bs-primary);
        }

        .form-check-input:checked {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 4px rgba(13, 104, 101, 0.12);
            border-color: var(--teal);
        }

        .form-check-label {
            color: var(--text-secondary);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--bs-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--bs-primary);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            height: 56px;
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: .01em;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(13, 104, 101, 0.35);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-login i {
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: translateX(5px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            padding: 0 1rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
        }

        .btn-social {
            flex: 1;
            height: 50px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-social:hover {
            border-color: var(--bs-primary);
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .btn-social i {
            font-size: 1.25rem;
        }

        .btn-social.google i {
            color: #ea4335;
        }

        .btn-social.github i {
            color: #333;
        }

        .signup-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
        }

        .signup-link a {
            color: var(--bs-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--bs-primary);
            text-decoration: underline;
        }

        /* Auth responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .brand-logo .icon-wrapper {
                width: 64px;
                height: 64px;
            }

            .brand-logo .icon-wrapper i {
                font-size: 2rem;
            }

            .brand-logo h1 {
                font-size: 1.5rem;
            }

            .social-login {
                flex-direction: column;
            }
        }

        /* Input autofill styling */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px #f8fafc inset;
            -webkit-text-fill-color: var(--text-primary);
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
    {{ $styles ?? '' }}
    @stack('styles')
</head>

<body>
    {{-- Navbar (shared across all pages) --}}
    <nav class="site-navbar">
        <div class="site-navbar-container">
            <a href="{{ route('home') }}" class="site-brand">
                <i class="fa-solid fa-sparkles"></i>
                <span>Nusa Event</span>
            </a>

            <ul class="site-nav">
                <li><a href="{{ route('home') }}#katalog" class="site-nav-link">Katalog Sewa</a></li>
                <li><a href="{{ route('services') }}" class="site-nav-link">Layanan</a></li>
                <li><a href="{{ route('collaborations') }}" class="site-nav-link">Kerja Sama</a></li>
                <li><a href="{{ route('contact') }}" class="site-nav-link">Kontak</a></li>
            </ul>

            <div class="site-navbar-actions">
                <a href="{{ route('home') }}" class="btn-nav btn-nav-outline">
                    <i class="fas fa-arrow-left"></i> Kembali ke situs
                </a>
            </div>
        </div>
    </nav>

    @if($type === 'auth')
        {{-- Auth Pages: gradient section with animated shapes --}}
        <section class="auth-section">
            <div class="bg-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>

            {{ $slot }}
        </section>
    @else
        {{-- Guest Pages: main content + footer --}}
        <main>
            {{ $slot }}
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-container">
                    <div class="footer-brand">
                        <a href="{{ route('home') }}" class="site-brand">
                            <i class="fa-solid fa-sparkles"></i>
                            <span>Nusa Event</span>
                        </a>
                        <p>Penyewaan perlengkapan acara dengan antar, pasang, dan penarikan.</p>
                    </div>

                    <div class="footer-links">
                        <div class="footer-column">
                            <h4>Katalog</h4>
                            <ul>
                                <li><a href="{{ route('home') }}#katalog">Semua item</a></li>
                                <li><a href="{{ route('services') }}">Layanan</a></li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h4>Perusahaan</h4>
                            <ul>
                                <li><a href="{{ route('about') }}">Tentang kami</a></li>
                                <li><a href="{{ route('collaborations') }}">Kerja sama</a></li>
                                <li><a href="{{ route('testimonials') }}">Testimoni</a></li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h4>Bantuan</h4>
                            <ul>
                                <li><a href="{{ route('contact') }}">Kontak</a></li>
                                <li><a href="{{ route('login') }}">Panel admin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} Nusa Event. Seluruh hak cipta dilindungi.</p>
                </div>
            </div>
        </footer>
    @endif

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Smooth scroll for same-page anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    {{ $scripts ?? '' }}
    @stack('scripts')
</body>

</html>
