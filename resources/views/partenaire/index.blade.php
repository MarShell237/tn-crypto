{{-- resources/views/partenaire/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Partenaires')

@section('content')
<div class="partners-page">
    <div class="header">
        <h1>Nos partenaires</h1>
        <p>Nous travaillons avec des structures reconnues pour vous offrir les meilleurs services.</p>
    </div>

    <div class="partners-grid">
        @foreach($partners as $p)
            @php
                $logoPath = 'image/partners/' . $p['logo'];
                $logoFullPath = public_path($logoPath);
                $hasLogo = file_exists($logoFullPath);
            @endphp

            <a class="partner-card" href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer">
                <div class="partner-logo">
                    @if($hasLogo)
                        <img src="{{ asset($logoPath) }}" alt="{{ $p['name'] }} logo" loading="lazy">
                    @else
                        {{-- fallback : première lettre --}}
                        <div class="partner-placeholder">{{ strtoupper(substr($p['name'], 0, 1)) }}</div>
                    @endif
                </div>

                <div class="partner-meta">
                    <h3>{{ $p['name'] }}</h3>
                    <p class="partner-desc">{{ $p['description'] ?? '' }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="partners-note">
        <p>Si vous souhaitez devenir partenaire, contactez-nous.</p>
    </div>
</div>

<style>
/* Container */
.partners-page {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

/* Header */
.partners-page .header h1 {
    font-size: 32px;
    color: #0e1577ff;
    margin-bottom: 6px;
}
.partners-page .header p {
    color: #555;
    margin-bottom: 24px;
}

/* Grid */
.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    align-items: stretch;
}

/* Card */
.partner-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    background: #fff;
    border-radius: 12px;
    padding: 18px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.06);
    transition: transform 0.18s ease, box-shadow 0.18s ease;
    color: inherit;
    min-height: 190px;
}

.partner-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.12);
}

.partner-logo {
    width: 100%;
    display:flex;
    align-items:center;
    justify-content:center;
    height: 100px;
    margin-bottom: 12px;
}

.partner-logo img {
    max-height: 96px;
    max-width: 160px;
    object-fit: contain;
}

/* placeholder */
.partner-placeholder {
    background: linear-gradient(135deg,#f0f4ff,#dfeeff);
    width:84px;
    height:84px;
    border-radius: 999px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    color:#0e1577ff;
    font-weight:700;
}

/* meta */
.partner-meta h3 {
    margin:6px 0 6px;
    color:#0e1577ff;
    font-size:18px;
}
.partner-desc {
    color:#666;
    font-size:13px;
    line-height:1.25;
}

/* note */
.partners-note {
    margin-top: 24px;
    color:#666;
    font-size:14px;
}

/* responsive */
@media (max-width: 640px) {
    .partner-card { padding: 14px; min-height: 150px; }
    .partner-logo { height: 78px; margin-bottom: 8px; }
}
</style>
@endsection
