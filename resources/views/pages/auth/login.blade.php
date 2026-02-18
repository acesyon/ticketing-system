<x-layouts::auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap');

        .login-wrap {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'DM Sans', sans-serif;
            background: #0d0d0d;
        }

        /* ── Left panel ── */
        .login-panel-left {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            background: #0d0d0d;
        }

        .login-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 30% 40%, rgba(193,154,107,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 50% 50% at 70% 80%, rgba(193,154,107,0.10) 0%, transparent 60%);
            pointer-events: none;
        }

        .login-panel-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 59px, rgba(255,255,255,0.025) 60px),
                repeating-linear-gradient(90deg, transparent, transparent 59px, rgba(255,255,255,0.025) 60px);
            pointer-events: none;
        }

        .left-logo {
            position: absolute;
            top: 3rem;
            left: 3rem;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 0.12em;
            color: #c19a6b;
            text-transform: uppercase;
            z-index: 2;
        }

        .left-quote {
            position: relative;
            z-index: 2;
        }

        .left-quote-mark {
            font-family: 'Cormorant Garamond', serif;
            font-size: 7rem;
            line-height: 1;
            color: #c19a6b;
            opacity: 0.4;
            display: block;
            margin-bottom: -1.5rem;
        }

        .left-quote-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 3vw, 2.8rem);
            font-weight: 300;
            font-style: italic;
            color: #f0ece4;
            line-height: 1.35;
            margin-bottom: 1.5rem;
        }

        .left-tagline {
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #c19a6b;
            font-weight: 500;
        }

        .left-divider {
            width: 2.5rem;
            height: 1px;
            background: #c19a6b;
            display: inline-block;
            margin-right: 0.75rem;
            vertical-align: middle;
        }

        /* ── Right panel ── */
        .login-panel-right {
            background: #f7f5f1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
            overflow-y: auto;
        }

        .login-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #c19a6b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .login-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.4rem, 3.5vw, 3.2rem);
            font-weight: 400;
            color: #1a1a1a;
            line-height: 1.15;
            margin-bottom: 0.4rem;
        }

        .login-subheading {
            font-size: 0.85rem;
            color: #6b6560;
            margin-bottom: 2.4rem;
            font-weight: 300;
        }

        /* ── Password row with forgot link ── */
        .password-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 0.3rem;
        }

        .password-label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #5a5450;
            font-weight: 500;
        }

        .forgot-link {
            font-size: 0.78rem;
            color: #c19a6b !important;
            text-decoration: none;
            font-weight: 400;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }

        .forgot-link:hover {
            border-color: #c19a6b !important;
        }

        /* ── Remember me checkbox ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0.8rem 0 1.4rem;
        }

        .remember-row input[type="checkbox"] {
            appearance: none;
            width: 1rem;
            height: 1rem;
            border: 1px solid #c4bdb4;
            border-radius: 2px;
            background: #fff;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
            flex-shrink: 0;
            position: relative;
        }

        .remember-row input[type="checkbox"]:checked {
            background: #c19a6b;
            border-color: #c19a6b;
        }

        .remember-row input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 2.5px;
            top: 0.5px;
            width: 5px;
            height: 8px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .remember-row label {
            font-size: 0.82rem;
            color: #5a5450;
            cursor: pointer;
            user-select: none;
        }

        /* ── Submit button ── */
        .login-btn-wrap flux-button button,
        .login-btn-wrap [data-flux-button] button {
            background: #1a1a1a !important;
            color: #f7f5f1 !important;
            border: none !important;
            border-radius: 2px !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 0.78rem !important;
            letter-spacing: 0.18em !important;
            text-transform: uppercase !important;
            font-weight: 500 !important;
            padding: 0.9rem 2rem !important;
            width: 100% !important;
            transition: background 0.2s ease, transform 0.15s ease !important;
            cursor: pointer !important;
        }

        .login-btn-wrap flux-button button:hover,
        .login-btn-wrap [data-flux-button] button:hover {
            background: #c19a6b !important;
            transform: translateY(-1px) !important;
        }

        /* ── Footer link ── */
        .login-footer {
            margin-top: 1.6rem;
            padding-top: 1.4rem;
            border-top: 1px solid #e2ddd6;
            text-align: center;
            font-size: 0.82rem;
            color: #8a827a;
        }

        .login-footer a,
        .login-footer flux-link {
            color: #c19a6b !important;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }

        .login-footer a:hover,
        .login-footer flux-link:hover {
            border-color: #c19a6b !important;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-panel-right > * {
            animation: fadeUp 0.5s ease both;
        }

        .login-panel-right > *:nth-child(1) { animation-delay: 0.05s; }
        .login-panel-right > *:nth-child(2) { animation-delay: 0.10s; }
        .login-panel-right > *:nth-child(3) { animation-delay: 0.16s; }
        .login-panel-right > *:nth-child(4) { animation-delay: 0.22s; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .login-wrap {
                grid-template-columns: 1fr;
            }
            .login-panel-left {
                display: none;
            }
            .login-panel-right {
                padding: 2rem 1.5rem;
            }
        }
    </style>

    <div class="login-wrap">

        {{-- ── LEFT PANEL ── --}}
        <div class="login-panel-left">
            <span class="left-logo">Marca</span>
            <div class="left-quote">
                <span class="left-quote-mark">"</span>
                <p class="left-quote-text">Welcome back. Your work continues where you left it.</p>
                <span class="left-tagline">
                    <span class="left-divider"></span>Pick up right where you left off
                </span>
            </div>
        </div>

        {{-- ── RIGHT PANEL ── --}}
        <div class="login-panel-right">

            <p class="login-eyebrow">Welcome back</p>
            <h1 class="login-heading">Log in to<br>your account</h1>
            <p class="login-subheading">{{ __('Enter your credentials below to continue') }}</p>

            {{-- Session Status --}}
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                {{-- Password + Forgot link --}}
                <div style="margin-top: 1.1rem; position: relative;">
                    @if (Route::has('password.request'))
                        <div class="password-header">
                            <span class="password-label">{{ __('Password') }}</span>
                            <flux:link class="forgot-link" :href="route('password.request')" wire:navigate>
                                {{ __('Forgot password?') }}
                            </flux:link>
                        </div>
                    @endif

                    <flux:input
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Password')"
                        viewable
                    />
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <label for="remember">{{ __('Keep me signed in') }}</label>
                </div>

                <div class="login-btn-wrap">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                        {{ __('Log in') }}
                    </flux:button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="login-footer">
                    <span>{{ __("Don't have an account?") }}</span>
                    <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                </div>
            @endif

        </div>
    </div>
</x-layouts::auth>