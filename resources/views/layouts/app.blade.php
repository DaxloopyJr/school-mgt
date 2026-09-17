<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin-theme.css') }}?v=2.0" rel="stylesheet">
    @stack('styles')
</head>
<body>
@php $role = auth()->user()->role; $menu = config('menu'); @endphp

<div id="sidebarBackdrop"></div>

<nav id="sidebar" aria-label="Main navigation">
    <a class="brand" href="{{ route('dashboard') }}">
        <i class="bi bi-mortarboard-fill"></i><span>{{ config('app.name') }}</span>
    </a>
    <div class="pb-4">
        @foreach ($menu as $item)
            @if (isset($item['section']))
                @php
                    $roles = $item['roles'] ?? null;
                    $show = is_null($roles) || in_array($role, $roles);
                @endphp
                @if ($show)
                    <div class="menu-section">{{ $item['section'] }}</div>
                @endif
            @else
                @if (in_array($role, $item['roles']))
                    <a class="menu-link {{ request()->routeIs($item['route'] . '*') || request()->routeIs($item['route']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                @endif
            @endif
        @endforeach
    </div>
</nav>

<div id="main">
    <div id="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-light d-lg-none" data-sidebar-toggle aria-label="Toggle navigation">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="page-title">@yield('title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('front.home') }}" target="_blank" class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center">
                <i class="bi bi-globe me-1"></i>Website
            </a>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <span class="avatar-ring me-2"><img src="{{ auth()->user()->avatarUrl() }}" alt=""></span>
                    <span class="text-dark small user-name">{{ auth()->user()->name }} <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('panel.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-1"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Please fix the following:</strong>
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('assets/js/admin-theme.js') }}?v=2.0"></script>
@stack('scripts')
</body>
</html>
