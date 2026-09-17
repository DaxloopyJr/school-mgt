<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ $cms['settings']['school_name'] ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/front-theme.css') }}?v=2.0" rel="stylesheet">
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-es sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('front.home') }}">
            @if (!empty($cms['settings']['logo']))<img src="{{ asset('storage/' . $cms['settings']['logo']) }}" height="30" alt="">@endif
            <i class="bi bi-mortarboard-fill"></i><span>{{ $cms['settings']['school_name'] ?? config('app.name') }}</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('front.home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.news') }}">News</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.courses') }}">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('front.contact') }}">Contact</a></li>
                @foreach ($cms['menus'] as $m)
                    <li class="nav-item"><a class="nav-link" href="{{ $m->url }}">{{ $m->title }}</a></li>
                @endforeach
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0"><a class="btn-es" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
            </ul>
        </div>
    </div>
</nav>

@if (session('success'))
    <div class="container mt-3"><div class="alert alert-success shadow-sm"><i class="bi bi-check-circle me-1"></i>{{ session('success') }}</div></div>
@endif

@yield('content')

<footer class="pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h6>{{ $cms['settings']['school_name'] ?? config('app.name') }}</h6>
                <p class="small mb-2">{{ $cms['settings']['address'] ?? '' }}</p>
                <p class="small mb-2"><i class="bi bi-telephone me-2"></i>{{ $cms['settings']['phone'] ?? '' }}</p>
                <p class="small mb-3"><i class="bi bi-envelope me-2"></i>{{ $cms['settings']['email'] ?? '' }}</p>
                <div class="d-flex gap-3">
                    @foreach ($cms['socials'] as $s)
                        <a href="{{ $s->url }}" target="_blank" aria-label="Social link"><i class="bi {{ $s->icon ?: 'bi-link-45deg' }}"></i></a>
                    @endforeach
                </div>
            </div>
            @foreach ($cms['footers'] as $w)
                <div class="col-md-4">
                    <h6>{{ $w->title }}</h6>
                    <div class="small">{!! nl2br(e($w->content)) !!}</div>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="text-center small">{{ $cms['settings']['footer_text'] ?? ('© ' . date('Y') . ' ' . config('app.name')) }}</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Glass navbar shadow on scroll
    (function () {
        var nav = document.querySelector('.navbar-es');
        if (!nav) return;
        window.addEventListener('scroll', function () {
            nav.classList.toggle('scrolled', window.scrollY > 12);
        }, { passive: true });
    })();
</script>
@stack('scripts')
</body>
</html>
