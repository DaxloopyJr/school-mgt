<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/admin-theme.css')); ?>?v=2.0" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<?php $role = auth()->user()->role; $menu = config('menu'); ?>

<div id="sidebarBackdrop"></div>

<nav id="sidebar" aria-label="Main navigation">
    <a class="brand" href="<?php echo e(route('dashboard')); ?>">
        <i class="bi bi-mortarboard-fill"></i><span><?php echo e(config('app.name')); ?></span>
    </a>
    <div class="pb-4">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($item['section'])): ?>
                <?php
                    $roles = $item['roles'] ?? null;
                    $show = is_null($roles) || in_array($role, $roles);
                ?>
                <?php if($show): ?>
                    <div class="menu-section"><?php echo e($item['section']); ?></div>
                <?php endif; ?>
            <?php else: ?>
                <?php if(in_array($role, $item['roles'])): ?>
                    <a class="menu-link <?php echo e(request()->routeIs($item['route'] . '*') || request()->routeIs($item['route']) ? 'active' : ''); ?>" href="<?php echo e(route($item['route'])); ?>">
                        <i class="bi <?php echo e($item['icon']); ?>"></i> <?php echo e($item['label']); ?>

                    </a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</nav>

<div id="main">
    <div id="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-light d-lg-none" data-sidebar-toggle aria-label="Toggle navigation">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="page-title"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo e(route('front.home')); ?>" target="_blank" class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center">
                <i class="bi bi-globe me-1"></i>Website
            </a>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <span class="avatar-ring me-2"><img src="<?php echo e(auth()->user()->avatarUrl()); ?>" alt=""></span>
                    <span class="text-dark small user-name"><?php echo e(auth()->user()->name); ?> <span class="badge bg-primary"><?php echo e(ucfirst(auth()->user()->role)); ?></span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?php echo e(route('panel.profile')); ?>"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                            <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-triangle me-1"></i><?php echo e(session('error')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Please fix the following:</strong>
                <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?php echo e(asset('assets/js/admin-theme.js')); ?>?v=2.0"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/layouts/app.blade.php ENDPATH**/ ?>