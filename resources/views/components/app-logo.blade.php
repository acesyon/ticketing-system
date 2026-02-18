@props([
    'sidebar' => false,
])

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=DM+Sans:wght@300;400;500&display=swap');

    .marca-brand {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        user-select: none;
    }

    .marca-icon {
        width: 2rem;
        height: 2rem;
        background: #1a1a1a;
        border: 1px solid #c19a6b;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }

    .marca-icon::before {
        content: 'M';
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: #c19a6b;
        line-height: 1;
    }

    .marca-wordmark {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }

    .marca-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #1a1a1a;
    }

    .marca-sub {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.58rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #c19a6b;
        font-weight: 400;
        margin-top: 1px;
    }

    /* Dark mode (sidebar typically dark) */
    .dark .marca-name,
    [data-theme="dark"] .marca-name {
        color: #f0ece4;
    }

    .dark .marca-icon,
    [data-theme="dark"] .marca-icon {
        background: #0d0d0d;
    }

    /* Sidebar variant — slightly smaller */
    .marca-brand--sidebar .marca-icon {
        width: 1.75rem;
        height: 1.75rem;
    }

    .marca-brand--sidebar .marca-icon::before {
        font-size: 0.9rem;
    }

    .marca-brand--sidebar .marca-name {
        font-size: 0.9rem;
    }

    .marca-brand--sidebar .marca-sub {
        font-size: 0.55rem;
    }
</style>

@if($sidebar)
    <a href="{{ url('/') }}" class="marca-brand marca-brand--sidebar" {{ $attributes }}>
        <div class="marca-icon"></div>
        <div class="marca-wordmark">
            <span class="marca-name">Marca</span>
            <span class="marca-sub">Ticketing System</span>
        </div>
    </a>
@else
    <a href="{{ url('/') }}" class="marca-brand" {{ $attributes }}>
        <div class="marca-icon"></div>
        <div class="marca-wordmark">
            <span class="marca-name">Marca</span>
            <span class="marca-sub">Ticketing System</span>
        </div>
    </a>
@endif