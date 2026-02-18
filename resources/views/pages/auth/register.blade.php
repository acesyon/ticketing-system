<x-layouts::auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap');

        .register-wrap {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-family: 'DM Sans', sans-serif;
            background: #0d0d0d;
        }

        /* ── Left panel ── */
        .register-panel-left {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            background: #0d0d0d;
        }

        .register-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 30% 40%, rgba(193,154,107,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 50% 50% at 70% 80%, rgba(193,154,107,0.10) 0%, transparent 60%);
            pointer-events: none;
        }

        .register-panel-left::after {
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
        .register-panel-right {
            background: #f7f5f1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
            overflow-y: auto;
        }

        .register-eyebrow {
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #c19a6b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .register-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 3.5vw, 3rem);
            font-weight: 400;
            color: #1a1a1a;
            line-height: 1.15;
            margin-bottom: 0.4rem;
        }

        .register-subheading {
            font-size: 0.85rem;
            color: #6b6560;
            margin-bottom: 2.2rem;
            font-weight: 300;
        }

        /* ── Form fields ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
            margin-bottom: 1.1rem;
        }

        .field-label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #5a5450;
            font-weight: 500;
        }

        .field-label .optional {
            color: #b0a89e;
            font-style: italic;
            text-transform: none;
            letter-spacing: 0;
            font-weight: 300;
        }

        /* Override Flux input styling */
        .register-panel-right flux-input input,
        .register-panel-right [data-flux-input] input,
        .register-panel-right .flux-input input {
            background: #fff !important;
            border: 1px solid #ddd8d0 !important;
            border-radius: 2px !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 0.88rem !important;
            color: #1a1a1a !important;
            padding: 0.7rem 0.9rem !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
        }

        .register-panel-right flux-input input:focus,
        .register-panel-right [data-flux-input] input:focus {
            border-color: #c19a6b !important;
            box-shadow: 0 0 0 3px rgba(193,154,107,0.12) !important;
            outline: none !important;
        }

        /* ── Submit button ── */
        .register-btn-wrap {
            margin-top: 0.5rem;
        }

        .register-btn-wrap flux-button button,
        .register-btn-wrap [data-flux-button] button {
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

        .register-btn-wrap flux-button button:hover,
        .register-btn-wrap [data-flux-button] button:hover {
            background: #c19a6b !important;
            transform: translateY(-1px) !important;
        }

        /* ── Footer link ── */
        .register-footer {
            margin-top: 1.6rem;
            padding-top: 1.4rem;
            border-top: 1px solid #e2ddd6;
            text-align: center;
            font-size: 0.82rem;
            color: #8a827a;
        }

        .register-footer a,
        .register-footer flux-link {
            color: #c19a6b !important;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }

        .register-footer a:hover,
        .register-footer flux-link:hover {
            border-color: #c19a6b !important;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .register-panel-right > * {
            animation: fadeUp 0.5s ease both;
        }

        .register-panel-right > *:nth-child(1) { animation-delay: 0.05s; }
        .register-panel-right > *:nth-child(2) { animation-delay: 0.1s; }
        .register-panel-right > *:nth-child(3) { animation-delay: 0.18s; }
        .register-panel-right > *:nth-child(4) { animation-delay: 0.24s; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .register-wrap {
                grid-template-columns: 1fr;
            }
            .register-panel-left {
                display: none;
            }
            .register-panel-right {
                padding: 2rem 1.5rem;
            }
        }
    </style>

    <div class="register-wrap">

        {{-- ── LEFT PANEL ── --}}
        <div class="register-panel-left">
            <span class="left-logo">Marca</span>
            <div class="left-quote">
                <span class="left-quote-mark">"</span>
                <p class="left-quote-text">Every great journey begins with a single, deliberate step forward.</p>
                <span class="left-tagline">
                    <span class="left-divider"></span>Begin yours today
                </span>
            </div>
        </div>

        {{-- ── RIGHT PANEL ── --}}
        <div class="register-panel-right">

            <p class="register-eyebrow">New account</p>
            <h1 class="register-heading">Create your<br>account</h1>
            <p class="register-subheading">{{ __('Enter your details below to get started') }}</p>

            {{-- Session Status --}}
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                {{-- Name row --}}
                <div class="form-row">
                    <flux:input
                        name="first_name"
                        :label="__('First name')"
                        :value="old('first_name')"
                        type="text"
                        required
                        autofocus
                        autocomplete="given-name"
                        :placeholder="__('First name')"
                    />
                    <flux:input
                        name="last_name"
                        :label="__('Last name')"
                        :value="old('last_name')"
                        type="text"
                        required
                        autocomplete="family-name"
                        :placeholder="__('Last name')"
                    />
                </div>

                {{-- Middle name --}}
                <flux:input
                    name="middle_name"
                    :label="__('Middle name (optional)')"
                    :value="old('middle_name')"
                    type="text"
                    autocomplete="additional-name"
                    :placeholder="__('Middle name')"
                />

                {{-- Email --}}
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                {{-- Contact --}}
                <flux:input
                    name="contact_no"
                    :label="__('Contact number (optional)')"
                    :value="old('contact_no')"
                    type="tel"
                    autocomplete="tel"
                    :placeholder="__('e.g. +63 912 345 6789')"
                />

                {{-- Passwords --}}
                <div class="form-row">
                    <flux:input
                        name="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Password')"
                        viewable
                    />
                    <flux:input
                        name="password_confirmation"
                        :label="__('Confirm password')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Confirm password')"
                        viewable
                    />
                </div>

                <div class="register-btn-wrap">
                    <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                        {{ __('Create account') }}
                    </flux:button>
                </div>
            </form>

            <div class="register-footer">
                <span>{{ __('Already have an account?') }}</span>
                <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
            </div>

        </div>
    </div>
</x-layouts::auth>