<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TicketFlow') }} — Support Intelligence</title>
    <meta name="description" content="Professional ticketing system for managing support requests and customer service">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #0d0d0f;
            --paper: #f5f2ec;
            --cream: #ede9e0;
            --accent: #c8452a;
            --accent-light: #e8604a;
            --gold: #c9a84c;
            --muted: #8a8580;
            --border: #d8d3c8;
            --card-bg: #ffffff;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Noise texture overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.5;
        }

        /* ─── HEADER ─── */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            padding: 0 2.5rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(245, 242, 236, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo-mark {
            width: 32px;
            height: 32px;
            background: var(--ink);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-mark svg { color: var(--paper); }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--ink);
            letter-spacing: -0.01em;
        }

        nav { display: flex; align-items: center; gap: 1rem; }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
            letter-spacing: 0.01em;
        }
        .nav-link:hover { color: var(--ink); }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.25rem;
            background: var(--ink);
            color: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.2s, transform 0.15s;
            letter-spacing: 0.01em;
        }
        .btn-primary:hover { background: #1e1e22; transform: translateY(-1px); }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            padding-top: 64px;
            position: relative;
        }

        /* Decorative diagonal background split */
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(108deg, transparent 55%, var(--cream) 55%);
            pointer-events: none;
            z-index: 0;
        }

        .hero-left {
            position: relative;
            z-index: 1;
            padding: 5rem 2.5rem 4rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.75rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.1s forwards;
        }

        .eyebrow-line {
            width: 28px;
            height: 1px;
            background: var(--accent);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 5.5vw, 5.5rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.02em;
            color: var(--ink);
            margin-bottom: 1.75rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.25s forwards;
        }

        h1 em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-desc {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--muted);
            max-width: 440px;
            margin-bottom: 2.5rem;
            font-weight: 300;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.4s forwards;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.55s forwards;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.9rem 2rem;
            background: var(--accent);
            color: #fff;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            letter-spacing: 0.01em;
        }
        .btn-hero-primary:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(200, 69, 42, 0.3);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            padding-bottom: 2px;
            transition: border-color 0.2s, color 0.2s;
        }
        .btn-ghost:hover { border-color: var(--ink); }

        /* Social proof */
        .social-proof {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 3.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
            opacity: 0;
            animation: fadeUp 0.6s ease 0.7s forwards;
        }

        .avatars {
            display: flex;
        }

        .avatars img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--paper);
            margin-right: -8px;
            object-fit: cover;
        }

        .proof-text {
            font-size: 0.8rem;
            color: var(--muted);
            line-height: 1.4;
        }
        .proof-text strong { color: var(--ink); font-weight: 500; }

        /* ─── HERO RIGHT - Cards ─── */
        .hero-right {
            position: relative;
            z-index: 1;
            padding: 5rem 4rem 4rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.25rem;
        }

        .auth-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06), 0 0 0 0 transparent;
            transition: box-shadow 0.3s, transform 0.25s;
            opacity: 0;
            animation: fadeUp 0.6s ease var(--delay, 0.5s) forwards;
        }
        .auth-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .auth-card.dark {
            background: var(--ink);
            border-color: #2a2a30;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: var(--cream);
            color: var(--ink);
        }

        .auth-card.dark .card-icon {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--ink);
        }
        .auth-card.dark .card-title { color: #fff; }

        .card-sub {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 2px;
        }
        .auth-card.dark .card-sub { color: rgba(255,255,255,0.45); }

        .card-btn-primary {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.8rem;
            background: var(--ink);
            color: var(--paper);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .card-btn-primary:hover { background: #1e1e22; }

        .card-btn-light {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.8rem;
            background: var(--paper);
            color: var(--ink);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .card-btn-light:hover { background: var(--cream); }

        .card-note {
            margin-top: 0.85rem;
            font-size: 0.72rem;
            text-align: center;
            color: var(--muted);
        }
        .auth-card.dark .card-note { color: rgba(255,255,255,0.3); }

        /* Decorative ticket snippet inside dark card */
        .ticket-snippet {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            padding: 0.85rem 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .ticket-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
        }

        .ticket-info { flex: 1; }

        .ticket-id {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            color: var(--gold);
            letter-spacing: 0.1em;
        }

        .ticket-subject {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.7);
            margin-top: 2px;
        }

        .ticket-badge {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            padding: 0.2rem 0.5rem;
            background: rgba(201, 168, 76, 0.15);
            color: var(--gold);
            border-radius: 4px;
            letter-spacing: 0.05em;
        }

        /* ─── FEATURES ─── */
        #features {
            background: var(--ink);
            padding: 6rem 4rem;
            position: relative;
            overflow: hidden;
        }

        #features::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 0;
            right: 0;
            height: 60px;
            background: var(--paper);
            clip-path: ellipse(55% 100% at 50% 0%);
        }

        .features-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .features-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .features-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .features-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -0.02em;
        }

        .features-title em {
            font-style: italic;
            color: var(--gold);
        }

        .features-sub {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.45);
            margin-top: 1rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            overflow: hidden;
        }

        .feature-card {
            background: var(--ink);
            padding: 2.5rem 2rem;
            transition: background 0.25s;
        }
        .feature-card:hover { background: #131318; }

        .feature-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            color: var(--gold);
        }

        .feature-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.6rem;
        }

        .feature-desc {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.4);
            line-height: 1.65;
        }

        /* Feature number accent */
        .feature-number {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.15);
            letter-spacing: 0.1em;
            margin-bottom: 1.5rem;
        }

        /* ─── FOOTER ─── */
        footer {
            background: #060608;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 2rem 4rem;
        }

        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            font-size: 0.9rem;
        }

        .footer-copy {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.2);
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.25);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: rgba(255,255,255,0.6); }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── PILLS ─── */
        .pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.32s forwards;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.75rem;
            border: 1px solid var(--border);
            border-radius: 99px;
            font-size: 0.75rem;
            color: var(--muted);
            background: var(--card-bg);
            font-weight: 400;
        }

        .pill-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }
            .hero::after { display: none; }
            .hero-left { padding: 4rem 2rem 2rem; }
            .hero-right { padding: 0 2rem 4rem; }
            .features-grid { grid-template-columns: 1fr; }
            #features { padding: 5rem 2rem; }
            footer { padding: 2rem; }
        }

        @media (max-width: 600px) {
            header { padding: 0 1.25rem; }
            h1 { font-size: 2.8rem; }
            .hero-left { padding: 3.5rem 1.25rem 2rem; }
            .hero-right { padding: 0 1.25rem 3rem; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <a class="logo" href="#">
            <div class="logo-mark">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <span class="logo-text">Ticketing System</span>
        </a>

        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">
                        Dashboard
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">
                            Get started
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- HERO -->
    <main>
        <section class="hero">
            <!-- Left: Copy -->
            <div class="hero-left">
                <span class="eyebrow">
                    <span class="eyebrow-line"></span>
                    Support Intelligence Platform
                </span>

                <h1>
                    Resolve tickets.<br>
                    <em>Faster.</em><br>
                    Together.
                </h1>

                <div class="pill-row">
                    <span class="pill"><span class="pill-dot"></span> Real-time Updates</span>
                    <span class="pill"><span class="pill-dot"></span> Team Collaboration</span>
                    <span class="pill"><span class="pill-dot"></span> Analytics & Reports</span>
                </div>

                <p class="hero-desc">
                    A modern ticketing system built for teams who move fast. Assign, track, and close support requests — all in one beautiful workspace.
                </p>

                <div class="hero-cta">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-hero-primary">
                            Start for free
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endif
                    <a href="#features" class="btn-ghost">
                        See features
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>

                <div class="social-proof">
                    <div class="avatars">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                        <img src="https://randomuser.me/api/portraits/men/46.jpg" alt="User">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                    </div>
                    <p class="proof-text">
                        Trusted by <strong>1,000+ support teams</strong> worldwide.<br>
                        No credit card required.
                    </p>
                </div>
            </div>

            <!-- Right: Auth Cards -->
            <div class="hero-right">
                <!-- Sign In Card -->
                <div class="auth-card" style="--delay: 0.45s">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <div>
                            <div class="card-title">Welcome back</div>
                            <div class="card-sub">Sign in to your workspace</div>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="card-btn-primary">Log in to your account</a>
                    <p class="card-note">Secure login · 2FA supported</p>
                </div>

                <!-- Register Card (dark) -->
                <div class="auth-card dark" style="--delay: 0.6s">
                    <div class="ticket-snippet">
                        <div class="ticket-dot"></div>
                        <div class="ticket-info">
                            <div class="ticket-id">#TKT-0042</div>
                            <div class="ticket-subject">Payment gateway not responding</div>
                        </div>
                        <span class="ticket-badge">OPEN</span>
                    </div>

                    <div class="card-header">
                        <div class="card-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="card-title">New here?</div>
                            <div class="card-sub">Create your free account</div>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="card-btn-light">Create account — it's free</a>
                    <p class="card-note">14-day trial · Cancel anytime</p>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features">
            <div class="features-inner">
                <div class="features-header">
                    <p class="features-eyebrow">Why Ticket System</p>
                    <h2 class="features-title">Everything your team<br><em>needs to succeed</em></h2>
                    <p class="features-sub">Powerful tools that help you close more tickets, keep customers happy, and sleep at night.</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-number">01</div>
                        <div class="feature-icon-wrap">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="feature-name">Real-time Updates</div>
                        <p class="feature-desc">Get instant notifications the moment tickets are created, updated, or resolved. Never miss a beat.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-number">02</div>
                        <div class="feature-icon-wrap">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="feature-name">Team Collaboration</div>
                        <p class="feature-desc">Assign tickets, add internal notes, and work together seamlessly — with full visibility across your team.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-number">03</div>
                        <div class="feature-icon-wrap">
                            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="feature-name">Analytics & Reports</div>
                        <p class="feature-desc">Track response times, customer satisfaction scores, and team performance with beautiful dashboards.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <span class="footer-logo">Ticket System</span>
            <span class="footer-copy">&copy; {{ date('Y') }} Ticket System. All rights reserved.</span>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
