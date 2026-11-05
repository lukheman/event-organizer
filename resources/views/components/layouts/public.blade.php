@props([
    'title' => 'Lini Jaya Event Organizer',
    'description' => 'Partner event organizer untuk kegiatan yang berkesan.',
    'settings' => [],
    'socialLinks' => [],
])

@php
    $siteName = $settings['site_name'] ?? 'Lini Jaya Event';
    $waUrl = \App\Support\SiteContent::whatsappUrl($settings);
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description }}">
    <meta name="theme-color" content="#0d2620">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;600;800&family=Funnel+Sans:wght@400;500;600&family=Martian+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-7.2.0-web/css/all.min.css') }}">

    <style>
        :root {
            --color-primary: #f2b233;
            --color-secondary: #25d366;
            --color-bg: #0d2620;
            --color-bg-secondary: #08180f;
            --color-text: #eadfc8;
            --color-text-secondary: #8fa89e;
            --color-border: #08180f;
            --ink: var(--color-text);
            --teal: var(--color-primary);
            --teal-dark: var(--color-secondary);
            --mint: #12332b;
            --gold: var(--color-primary);
            --line: rgba(234, 223, 200, .14);
            --line-2: rgba(234, 223, 200, .3);
        }

        body {
            font-family: 'Funnel Sans', sans-serif;
            font-weight: 400;
            color: var(--color-text);
            background: var(--color-bg);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        p, .form-control, .btn, .nav-link, .form-select {
            font-size: 16px;
            line-height: 1.75;
        }

        .text-secondary {
            color: var(--color-text-secondary) !important;
        }

        .border-top, .border-bottom {
            border-color: var(--line) !important;
        }

        h1, .display-3 {
            font-size: clamp(52px, 8.5vw, 96px);
            line-height: 1.03;
        }

        h2, .display-6 {
            font-size: clamp(42px, 6vw, 84px);
            line-height: .94;
        }

        h3, .display-5 {
            font-size: clamp(34px, 4.5vw, 66px);
            line-height: 1;
        }

        h1, h2, h3, h4, h5, h6, .display-font {
            font-family: 'Funnel Display', sans-serif;
            font-weight: 800;
            letter-spacing: -.045em;
            line-height: 1.05;
        }

        h4, h5, h6 {
            font-weight: 800;
        }

        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
            font-family: 'Funnel Display', sans-serif;
            font-weight: 800;
            letter-spacing: -.045em;
            line-height: 1.02;
        }

        .display-1, .display-2, .display-3 {
            font-size: clamp(52px, 8.5vw, 96px);
        }

        .display-4 {
            font-size: clamp(44px, 6.5vw, 76px);
        }

        .display-5 {
            font-size: clamp(36px, 5vw, 66px);
        }

        .display-6 {
            font-size: clamp(42px, 6vw, 84px);
        }

        .lead {
            font-weight: 400;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .text-dark, .text-white {
            color: var(--color-text) !important;
        }

        .text-white-50 {
            color: var(--color-text-secondary) !important;
        }

        .bg-white, .bg-light {
            background: var(--color-bg-secondary) !important;
        }

        .badge.bg-light {
            background: var(--mint) !important;
            color: var(--color-text) !important;
        }

        .form-control, .form-select {
            background: var(--color-bg-secondary);
            border: 1px solid var(--line);
            color: var(--color-text);
        }

        .form-control:focus, .form-select:focus {
            background: var(--color-bg-secondary);
            border-color: var(--color-primary);
            color: var(--color-text);
            box-shadow: 0 0 0 4px rgba(242, 178, 51, .16);
        }

        .form-control::placeholder {
            color: var(--color-text-secondary);
        }

        .btn-light, .btn-outline-light {
            background: var(--color-primary);
            border: 1px solid var(--color-primary);
            color: #0d2620;
            border-radius: 100px;
            font-weight: 600;
        }

        .btn-light:hover, .btn-outline-light:hover {
            filter: brightness(1.08);
            color: #0d2620;
        }

        .btn-outline-secondary {
            border-color: var(--line-2);
            color: var(--color-text);
        }

        .btn-outline-secondary:hover {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: #0d2620;
        }

        .navbar-toggler {
            color: var(--color-text);
        }

        .navbar {
            background: rgba(13, 38, 32, .94);
            border-color: var(--line) !important;
            backdrop-filter: blur(12px);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            display: block;
            filter: brightness(0) invert(1);
        }

        .navbar .nav-link {
            color: var(--color-text) !important;
            font-weight: 400;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--color-primary) !important;
        }

        .btn-main {
            background: var(--color-primary);
            color: #0d2620;
            border: 1px solid var(--color-primary);
            border-radius: 100px;
            padding: .625rem 1.125rem;
            font-weight: 600;
        }

        .btn-main:hover,
        .btn-main:focus {
            filter: brightness(1.08);
            color: #0d2620;
        }

        .btn-ghost {
            background: transparent;
            color: var(--color-text);
            border: 1px solid var(--line-2);
            border-radius: 100px;
            padding: .625rem 1.125rem;
            font-weight: 600;
        }

        .btn-ghost:hover {
            color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .hero {
            background: var(--color-bg);
            padding: 8.25rem 0 5.25rem;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 28rem;
            height: 28rem;
            border-radius: 50%;
            right: -10rem;
            top: -12rem;
            background: radial-gradient(circle, rgba(242, 178, 51, .16), transparent 70%);
        }

        .hero-slider .carousel-inner,
        .hero-slider .carousel-item {
            min-height: 34rem;
        }

        .hero-slider .hero-slide {
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .hero-slider .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(16, 42, 43, .35), rgba(16, 42, 43, .05));
        }

        .hero-slider .carousel-indicators {
            bottom: .75rem;
        }

        .hero-slider .carousel-indicators button {
            width: 2rem;
            height: .25rem;
            border: 0;
            border-radius: 999px;
            background-color: var(--color-primary);
        }

        .hero-slider .carousel-control-prev,
        .hero-slider .carousel-control-next {
            width: 3rem;
        }

        @media (max-width: 991px) {
            .hero-slider .carousel-inner,
            .hero-slider .carousel-item {
                min-height: 24rem;
            }
        }

        .eyebrow {
            font-family: 'Martian Mono', monospace;
            color: var(--color-primary);
            font-weight: 400;
            letter-spacing: .1em;
            text-transform: uppercase;
            font-size: .72rem;
        }

        .availability {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            border-radius: 999px;
            padding: .3rem .6rem;
            font-size: .7rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: .01em;
            white-space: nowrap;
        }

        .availability i {
            font-size: .68rem;
        }

        .availability-available {
            background: rgba(37, 211, 102, .16);
            color: #7ef0a7;
        }

        .availability-limited {
            background: rgba(242, 178, 51, .16);
            color: var(--color-primary);
        }

        .availability-unavailable {
            background: rgba(255, 111, 97, .16);
            color: #ff8f84;
        }

        .media-frame .availability {
            box-shadow: rgba(0, 0, 0, .4) 0 14px 34px 0;
        }

        .card-clean {
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--color-bg-secondary);
            box-shadow: rgba(0, 0, 0, .28) 0 10px 26px 0;
            height: 100%;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        a.card-clean:hover {
            transform: translateY(-4px);
            box-shadow: rgba(34, 205, 190, .45) 0 14px 40px 0;
        }

        .icon-box {
            width: 3.2rem;
            height: 3.2rem;
            border-radius: 14px;
            background: var(--color-primary);
            color: #0d2620;
            display: grid;
            place-items: center;
            font-size: 1.15rem;
        }

        .section {
            padding: 5.25rem 0;
        }

        .cta-band {
            background: var(--mint);
            border: 1px solid var(--line);
            border-radius: 18px;
            position: relative;
            overflow: hidden;
        }

        .cta-band::after {
            content: '';
            position: absolute;
            width: 18rem;
            height: 18rem;
            border-radius: 50%;
            right: -6rem;
            top: -6rem;
            background: rgba(242, 178, 51, .16);
        }

        .cta-band > * {
            position: relative;
            z-index: 1;
        }

        .section-soft {
            background: var(--color-bg-secondary);
        }

        .section-head {
            max-width: 54rem;
        }

        .stat-value {
            font-family: 'Funnel Display', sans-serif;
            font-weight: 800;
            font-size: 1.9rem;
            line-height: 1;
            letter-spacing: -.03em;
            color: var(--color-primary);
        }

        .text-link {
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
        }

        .text-link:hover {
            filter: brightness(1.12);
        }

        .media-frame {
            border-radius: 14px;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: var(--mint);
            display: grid;
            place-items: center;
            color: var(--color-primary);
            font-size: 2rem;
        }

        .media-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .whatsapp {
            position: fixed;
            right: 1.25rem;
            bottom: 1.25rem;
            background: #25d366;
            color: #fff;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 1.55rem;
            z-index: 1040;
            box-shadow: 0 12px 25px rgba(37, 211, 102, .35);
        }

        .whatsapp:hover {
            color: #fff;
            background: #1ebe5b;
        }

        .footer {
            background: var(--color-bg-secondary);
            color: var(--color-text);
            padding: 3.5rem 0 2rem;
        }

        .footer a {
            color: var(--color-text);
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--color-primary);
        }

        .footer-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            display: block;
            margin-bottom: .75rem;
            filter: brightness(0) invert(1);
        }

        .footer-social a {
            width: 2.4rem;
            height: 2.4rem;
            border: 1px solid var(--line-2);
            border-radius: 50%;
            display: inline-grid;
            place-items: center;
        }

        .footer-bottom {
            border-top: 1px solid var(--line);
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 6.5rem;
        }

        @media (prefers-reduced-motion: no-preference) {
            .hero .container > * {
                animation: hero-rise .9s cubic-bezier(.2, .65, .3, 1) both;
            }

            .hero .container > *:nth-child(2) {
                animation-delay: .08s;
            }

            .hero .container > *:nth-child(3) {
                animation-delay: .16s;
            }

            .hero .container > *:nth-child(4) {
                animation-delay: .24s;
            }

            .hero .container > *:nth-child(5) {
                animation-delay: .32s;
            }

            .hero .container > *:nth-child(6) {
                animation-delay: .4s;
            }

            .reveal {
                opacity: 0;
                transform: translateY(26px);
                transition:
                    opacity .7s cubic-bezier(.2, .65, .3, 1),
                    transform .7s cubic-bezier(.2, .65, .3, 1);
                transition-delay: var(--reveal-delay, 0ms);
            }

            .reveal.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes hero-rise {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            .hero .container > * {
                animation: none;
            }

            .reveal {
                opacity: 1;
                transform: none;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: var(--color-bg-secondary);
                border: 1px solid var(--line);
                border-radius: 1rem;
                margin-top: .75rem;
                padding: 1rem;
            }
        }

        @media (max-width: 639.98px) {
            .container > .row {
                margin-left: 0;
                margin-right: 0;
            }

            h1, .display-3 {
                font-size: clamp(42px, 12vw, 54px);
                line-height: 1.02;
            }

            h2, .display-6,
            h3, .display-5 {
                font-size: clamp(32px, 9vw, 42px);
                line-height: 1;
            }

            .hero {
                padding: 7.5rem 0 3rem;
            }

            .section {
                padding: 3rem 0;
            }

            .card-clean {
                border-radius: 18px;
            }

            .hero .btn,
            .cta-band .btn {
                min-height: 44px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
        <nav class="navbar navbar-expand-lg py-3 fixed-top border-bottom">
    <div class="container">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $siteName }}">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="{{ $siteName }}">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-controls="siteNav" aria-expanded="false" aria-label="Buka menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div id="siteNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                 <li class="nav-item"><a class="nav-link nav-home {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                 <li class="nav-item"><a class="nav-link nav-section-link {{ request()->routeIs('services*') ? 'active' : '' }}" href="{{ route('home') }}#layanan">Layanan</a></li>
                 <li class="nav-item"><a class="nav-link nav-section-link" href="{{ route('home') }}#katalog">Perlengkapan</a></li>
                 <li class="nav-item"><a class="nav-link {{ request()->routeIs('collaborations*') ? 'active' : '' }}" href="{{ route('collaborations') }}">Kerja Sama</a></li>
                 <li class="nav-item"><a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">Testimoni</a></li>
                 <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
                 <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-main" href="{{ $waUrl }}" target="_blank" rel="noopener">
                        <i class="fa-brands fa-whatsapp me-1"></i> Konsultasi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{ $slot }}

<footer class="footer">
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-lg-5">
                <img class="footer-logo" src="{{ asset('assets/img/logo/logo.png') }}" alt="{{ $siteName }}">
                <p class="mb-3 text-white-50">{{ $settings['footer_tagline'] ?? 'Event organizer profesional untuk konsep, produksi, pelaksanaan, dan perlengkapan acara.' }}</p>
                <div class="footer-social d-flex gap-2">
                    @foreach ($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener" aria-label="{{ $link->platform }}" title="{{ $link->platform }}">
                            <i class="{{ $link->icon ?: 'fa-solid fa-link' }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="text-white fw-semibold mb-3">Jelajahi</div>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('home') }}#katalog">Perlengkapan</a>
                    <a href="{{ route('custom') }}">Rancang Kebutuhan</a>
                    <a href="{{ route('about') }}">Tentang Kami</a>
                    <a href="{{ route('services') }}">Layanan</a>
                    <a href="{{ route('collaborations') }}">Kerja Sama</a>
                    <a href="{{ route('testimonials') }}">Testimoni</a>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="text-white fw-semibold mb-3">Hubungi Kami</div>
                <div class="d-flex flex-column gap-2">
                    <span><i class="fa-solid fa-location-dot me-2"></i>{{ $settings['address'] ?? 'Alamat kantor belum diatur.' }}</span>
                    <a href="mailto:{{ $settings['email'] ?? 'halo@linijayaevent.id' }}"><i class="fa-solid fa-envelope me-2"></i>{{ $settings['email'] ?? 'halo@linijayaevent.id' }}</a>
                    <span><i class="fa-regular fa-clock me-2"></i>{{ $settings['operating_hours'] ?? 'Senin–Sabtu, 08.00–17.00' }}</span>
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp me-2"></i>Konsultasi via WhatsApp</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom pt-3 d-flex flex-column flex-md-row justify-content-between gap-2 small text-white-50">
            <span>&copy; {{ date('Y') }} {{ $siteName }}. Seluruh hak cipta dilindungi.</span>
            <span>Dirancang untuk acara yang berkesan.</span>
        </div>
    </div>
</footer>

<a class="whatsapp" href="{{ $waUrl }}" target="_blank" rel="noopener" aria-label="Konsultasi via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
<script>
    (function () {
        const sectionLinks = document.querySelectorAll('.nav-section-link');

        function updateActiveMenu() {
            const hash = window.location.hash;

            if (!['#layanan', '#katalog'].includes(hash)) {
                return;
            }

            document.querySelectorAll('.navbar .nav-link').forEach(function (link) {
                link.classList.remove('active');
            });

            sectionLinks.forEach(function (link) {
                link.classList.toggle('active', link.getAttribute('href').endsWith(hash));
            });
        }

        window.addEventListener('hashchange', updateActiveMenu);
        updateActiveMenu();
    })();
</script>
<script>
    (function () {
        if (!('IntersectionObserver' in window)) {
            return;
        }

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        const candidates = Array.from(document.querySelectorAll([
            '.section .section-head',
            '.section .cta-band',
            '.section .row > [class*="col-"]',
            '.section > .container > h2'
        ].join(',')));

        const elements = candidates.filter(function (element) {
            return !candidates.some(function (other) {
                return other !== element && other.contains(element);
            });
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -48px 0px' });

        elements.forEach(function (element) {
            const siblings = Array.from(element.parentElement.children).filter(function (sibling) {
                return elements.indexOf(sibling) !== -1;
            });

            element.style.setProperty('--reveal-delay', Math.min(siblings.indexOf(element), 5) * 70 + 'ms');
            element.classList.add('reveal');
            observer.observe(element);
        });
    })();
</script>
</body>
</html>
