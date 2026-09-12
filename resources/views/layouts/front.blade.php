<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ $cms['settings']['school_name'] ?? config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .hero { background: linear-gradient(120deg, #1e3a8a, #4e73df); color: #fff; padding: 5rem 0; }
        .card-img-top { height: 180px; object-fit: cover; }
        footer { background: #1e293b; color: #cbd5e1; }
        footer a { color: #cbd5e1; text-decoration: none; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#1e293b;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('front.home') }}">
            @if (!empty($cms['settings']['logo']))<img src="{{ asset('storage/' . $cms['settings']['logo']) }}" height="30" class="me-1" alt="">@endif
            <i class="bi bi-mortarboard-fill me-1"></i>{{ $cms['settings']['school_name'] ?? config('app.name') }}
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('front.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.news') }}">News</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.courses') }}">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.contact') }}">Contact</a></li>
                @foreach ($cms['menus'] as $m)
                    <li class="nav-item"><a class="nav-link" href="{{ $m->url }}">{{ $m->title }}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link btn btn-primary btn-sm text-white ms-lg-2 px-3" href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

@if (session('success'))
    <div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>
@endif

@yield('content')

<footer class="mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <h6 class="text-white">{{ $cms['settings']['school_name'] ?? config('app.name') }}</h6>
                <p class="small">{{ $cms['settings']['address'] ?? '' }}<br>{{ $cms['settings']['phone'] ?? '' }}<br>{{ $cms['settings']['email'] ?? '' }}</p>
                <div>
                    @foreach ($cms['socials'] as $s)
                        <a href="{{ $s->url }}" class="me-2" target="_blank"><i class="bi {{ $s->icon ?: 'bi-link-45deg' }}"></i></a>
                    @endforeach
                </div>
            </div>
            @foreach ($cms['footers'] as $w)
                <div class="col-md-4">
                    <h6 class="text-white">{{ $w->title }}</h6>
                    <div class="small">{!! nl2br(e($w->content)) !!}</div>
                </div>
            @endforeach
        </div>
        <hr class="border-secondary">
        <div class="text-center small">{{ $cms['settings']['footer_text'] ?? ('© ' . date('Y') . ' ' . config('app.name')) }}</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
