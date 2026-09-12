<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Home'); ?> - <?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></title>
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
        <a class="navbar-brand fw-bold" href="<?php echo e(route('front.home')); ?>">
            <?php if(!empty($cms['settings']['logo'])): ?><img src="<?php echo e(asset('storage/' . $cms['settings']['logo'])); ?>" height="30" class="me-1" alt=""><?php endif; ?>
            <i class="bi bi-mortarboard-fill me-1"></i><?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?>

        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.news')); ?>">News</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.courses')); ?>">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.about')); ?>">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.contact')); ?>">Contact</a></li>
                <?php $__currentLoopData = $cms['menus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e($m->url); ?>"><?php echo e($m->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item"><a class="nav-link btn btn-primary btn-sm text-white ms-lg-2 px-3" href="<?php echo e(route('login')); ?>">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php if(session('success')): ?>
    <div class="container mt-3"><div class="alert alert-success"><?php echo e(session('success')); ?></div></div>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<footer class="mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <h6 class="text-white"><?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></h6>
                <p class="small"><?php echo e($cms['settings']['address'] ?? ''); ?><br><?php echo e($cms['settings']['phone'] ?? ''); ?><br><?php echo e($cms['settings']['email'] ?? ''); ?></p>
                <div>
                    <?php $__currentLoopData = $cms['socials']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($s->url); ?>" class="me-2" target="_blank"><i class="bi <?php echo e($s->icon ?: 'bi-link-45deg'); ?>"></i></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php $__currentLoopData = $cms['footers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <h6 class="text-white"><?php echo e($w->title); ?></h6>
                    <div class="small"><?php echo nl2br(e($w->content)); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <hr class="border-secondary">
        <div class="text-center small"><?php echo e($cms['settings']['footer_text'] ?? ('© ' . date('Y') . ' ' . config('app.name'))); ?></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/layouts/front.blade.php ENDPATH**/ ?>