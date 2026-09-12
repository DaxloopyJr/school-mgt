<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - <?php echo e(config('app.name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --sms-sidebar: #1e293b; --sms-sidebar-active: #334155; }
        body { background: #f1f5f9; font-family: 'Segoe UI', system-ui, sans-serif; }
        #sidebar { width: 250px; min-height: 100vh; background: var(--sms-sidebar); position: fixed; top: 0; left: 0; z-index: 1040; overflow-y: auto; transition: margin .25s; }
        #sidebar .brand { padding: 1rem; color: #fff; font-weight: 700; font-size: 1.05rem; border-bottom: 1px solid #334155; display: block; text-decoration: none; }
        #sidebar .menu-section { color: #94a3b8; font-size: .68rem; text-transform: uppercase; letter-spacing: .08em; padding: .9rem 1rem .3rem; }
        #sidebar a.menu-link { color: #cbd5e1; text-decoration: none; display: block; padding: .5rem 1rem; font-size: .86rem; border-left: 3px solid transparent; }
        #sidebar a.menu-link:hover, #sidebar a.menu-link.active { background: var(--sms-sidebar-active); color: #fff; border-left-color: #4e73df; }
        #sidebar a.menu-link i { width: 1.2rem; display: inline-block; }
        #main { margin-left: 250px; min-height: 100vh; }
        #topbar { background: #fff; padding: .65rem 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1030; }
        #content { padding: 1.25rem; }
        .stat-card { border: none; border-left: 4px solid; border-radius: .5rem; }
        .table-card { background: #fff; border-radius: .5rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        @media (max-width: 991px) {
            #sidebar { margin-left: -250px; }
            #sidebar.show { margin-left: 0; }
            #main { margin-left: 0; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<?php $role = auth()->user()->role; $menu = config('menu'); ?>
<nav id="sidebar">
    <a class="brand" href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-mortarboard-fill me-2"></i><?php echo e(config('app.name')); ?></a>
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
            <button class="btn btn-sm btn-outline-secondary d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')"><i class="bi bi-list"></i></button>
            <span class="fw-semibold"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></span>
        </div>
        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img src="<?php echo e(auth()->user()->avatarUrl()); ?>" class="rounded-circle me-2" width="34" height="34" alt="">
                <span class="text-dark small"><?php echo e(auth()->user()->name); ?> <span class="badge bg-primary"><?php echo e(ucfirst(auth()->user()->role)); ?></span></span>
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
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/layouts/app.blade.php ENDPATH**/ ?>