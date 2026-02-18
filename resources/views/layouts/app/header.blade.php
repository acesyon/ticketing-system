<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap');

            body {
                font-family: 'DM Sans', sans-serif;
                background: #0f0f0f !important;
                color: #e8e4de;
                min-height: 100vh;
            }

            /* ══════════════════════════════
               HEADER
            ══════════════════════════════ */
            .marca-header {
                position: sticky;
                top: 0;
                z-index: 50;
                width: 100%;
                height: 56px;
                display: flex;
                align-items: center;
                padding: 0 1.5rem;
                background: rgba(10, 10, 10, 0.95);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border-bottom: 1px solid rgba(193, 154, 107, 0.18);
                gap: 0.75rem;
            }

            /* ── Sidebar toggle (mobile) ── */
            .marca-sidebar-toggle {
                display: none;
                background: none;
                border: none;
                color: #a09890;
                cursor: pointer;
                padding: 0.35rem;
                border-radius: 4px;
                transition: color 0.15s;
            }

            .marca-sidebar-toggle:hover { color: #c19a6b; }

            @media (max-width: 1023px) {
                .marca-sidebar-toggle { display: flex; align-items: center; }
            }

            /* ── Nav ── */
            .marca-nav {
                display: flex;
                align-items: center;
                gap: 0.1rem;
                margin-left: 1.25rem;
            }

            @media (max-width: 1023px) { .marca-nav { display: none; } }

            .marca-nav-item {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.38rem 0.7rem;
                font-size: 0.78rem;
                font-weight: 400;
                letter-spacing: 0.04em;
                color: #9a9088;
                text-decoration: none;
                border-radius: 3px;
                border-bottom: 1px solid transparent;
                transition: color 0.15s, border-color 0.15s;
                white-space: nowrap;
            }

            .marca-nav-item svg {
                width: 14px;
                height: 14px;
                opacity: 0.7;
            }

            .marca-nav-item:hover {
                color: #e8e4de;
            }

            .marca-nav-item.active {
                color: #c19a6b;
                border-bottom-color: #c19a6b;
            }

            /* ── Spacer ── */
            .marca-spacer { flex: 1; }

            /* ── Icon actions ── */
            .marca-actions {
                display: flex;
                align-items: center;
                gap: 0.1rem;
            }

            .marca-action-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                background: none;
                border: none;
                border-radius: 4px;
                color: #7a726a;
                cursor: pointer;
                text-decoration: none;
                transition: color 0.15s, background 0.15s;
            }

            .marca-action-btn:hover {
                color: #c19a6b;
                background: rgba(193, 154, 107, 0.08);
            }

            .marca-action-btn svg {
                width: 17px;
                height: 17px;
            }

            @media (max-width: 1023px) {
                .marca-action-btn.desktop-only { display: none; }
            }

            /* ── Thin gold accent line ── */
            .marca-header-accent {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, #c19a6b 30%, #c19a6b 70%, transparent);
                opacity: 0.5;
            }

            /* ══════════════════════════════
               MOBILE SIDEBAR
            ══════════════════════════════ */
            .marca-mobile-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 260px;
                background: #0a0a0a;
                border-right: 1px solid rgba(193, 154, 107, 0.15);
                z-index: 60;
                display: flex;
                flex-direction: column;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            .marca-mobile-sidebar.open {
                transform: translateX(0);
            }

            .marca-sidebar-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 1.25rem;
                border-bottom: 1px solid rgba(193, 154, 107, 0.12);
            }

            .marca-sidebar-close {
                background: none;
                border: none;
                color: #6a6260;
                cursor: pointer;
                padding: 0.3rem;
                border-radius: 3px;
                transition: color 0.15s;
            }

            .marca-sidebar-close:hover { color: #c19a6b; }

            .marca-sidebar-nav {
                flex: 1;
                padding: 1rem 0.75rem;
                overflow-y: auto;
            }

            .marca-sidebar-group-label {
                font-size: 0.62rem;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: #4a4440;
                font-weight: 500;
                padding: 0.5rem 0.5rem 0.4rem;
                margin-bottom: 0.2rem;
            }

            .marca-sidebar-item {
                display: flex;
                align-items: center;
                gap: 0.6rem;
                padding: 0.55rem 0.75rem;
                font-size: 0.82rem;
                color: #8a827a;
                text-decoration: none;
                border-radius: 3px;
                border-left: 2px solid transparent;
                transition: color 0.15s, background 0.15s, border-color 0.15s;
                margin-bottom: 0.1rem;
            }

            .marca-sidebar-item svg {
                width: 15px;
                height: 15px;
                opacity: 0.7;
                flex-shrink: 0;
            }

            .marca-sidebar-item:hover {
                color: #e8e4de;
                background: rgba(193, 154, 107, 0.06);
            }

            .marca-sidebar-item.active {
                color: #c19a6b;
                background: rgba(193, 154, 107, 0.08);
                border-left-color: #c19a6b;
            }

            .marca-sidebar-footer {
                padding: 0.75rem;
                border-top: 1px solid rgba(193, 154, 107, 0.1);
            }

            /* Sidebar overlay */
            .marca-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.6);
                z-index: 55;
                backdrop-filter: blur(2px);
            }

            .marca-overlay.open { display: block; }

            /* ══════════════════════════════
               PAGE CONTENT WRAPPER
            ══════════════════════════════ */
            .marca-page {
                min-height: calc(100vh - 56px);
            }
        </style>
    </head>

    <body>

        {{-- ══ HEADER ══ --}}
        <header class="marca-header" style="position: relative;">
            <div class="marca-header-accent"></div>

            {{-- Mobile toggle --}}
            <button class="marca-sidebar-toggle" onclick="marcaSidebarOpen()" aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
            </button>

            {{-- Logo --}}
            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            {{-- Desktop nav --}}
            <nav class="marca-nav">
                <a href="{{ route('dashboard') }}"
                   class="marca-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    {{ __('Dashboard') }}
                </a>
            </nav>

            <div class="marca-spacer"></div>

            {{-- Icon actions --}}
            <div class="marca-actions">
                {{-- Search --}}
                <a href="#" class="marca-action-btn" title="{{ __('Search') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>

                {{-- Repository --}}
                <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="marca-action-btn desktop-only" title="{{ __('Repository') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                    </svg>
                </a>

                {{-- Documentation --}}
                <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="marca-action-btn desktop-only" title="{{ __('Documentation') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </a>
            </div>

            {{-- User menu --}}
            <x-desktop-user-menu />
        </header>

        {{-- ══ MOBILE SIDEBAR OVERLAY ══ --}}
        <div class="marca-overlay" id="marcaOverlay" onclick="marcaSidebarClose()"></div>

        {{-- ══ MOBILE SIDEBAR ══ --}}
        <aside class="marca-mobile-sidebar" id="marcaSidebar">
            <div class="marca-sidebar-header">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <button class="marca-sidebar-close" onclick="marcaSidebarClose()" aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="marca-sidebar-nav">
                <div class="marca-sidebar-group-label">{{ __('Platform') }}</div>

                <a href="{{ route('dashboard') }}"
                   class="marca-sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    {{ __('Dashboard') }}
                </a>
            </nav>

            <div class="marca-sidebar-footer">
                <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="marca-sidebar-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                    </svg>
                    {{ __('Repository') }}
                </a>
                <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="marca-sidebar-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    {{ __('Documentation') }}
                </a>
            </div>
        </aside>

        {{-- ══ PAGE SLOT ══ --}}
        <main class="marca-page">
            {{ $slot }}
        </main>

        @fluxScripts

        <script>
            function marcaSidebarOpen() {
                document.getElementById('marcaSidebar').classList.add('open');
                document.getElementById('marcaOverlay').classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function marcaSidebarClose() {
                document.getElementById('marcaSidebar').classList.remove('open');
                document.getElementById('marcaOverlay').classList.remove('open');
                document.body.style.overflow = '';
            }

            // Close on ESC
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') marcaSidebarClose();
            });
        </script>
    </body>
</html>