<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none" {{ $attributes }}>
    {{-- Outer border square --}}
    <rect x="1.5" y="1.5" width="37" height="37" rx="4" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>

    {{-- Inner M letterform — geometric, two strokes meeting at a point --}}
    <path
        d="M9 29 L9 11 L20 23 L31 11 L31 29"
        stroke="currentColor"
        stroke-width="2.5"
        stroke-linecap="round"
        stroke-linejoin="round"
        fill="none"
    />

    {{-- Bottom accent line --}}
    <line x1="13" y1="32.5" x2="27" y2="32.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" opacity="0.5"/>
</svg>