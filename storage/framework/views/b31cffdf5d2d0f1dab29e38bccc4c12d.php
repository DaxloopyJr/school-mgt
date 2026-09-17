<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Home'); ?> - <?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/front-theme.css')); ?>?v=2.0" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-es sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('front.home')); ?>">
            <?php if(!empty($cms['settings']['logo'])): ?><img src="<?php echo e(asset('storage/' . $cms['settings']['logo'])); ?>" height="30" alt=""><?php endif; ?>
            <i class="bi bi-mortarboard-fill"></i><span><?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.home')); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.news')); ?>">News</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.courses')); ?>">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.about')); ?>">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('front.contact')); ?>">Contact</a></li>
                <?php $__currentLoopData = $cms['menus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e($m->url); ?>"><?php echo e($m->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0"><a class="btn-es" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php if(session('success')): ?>
    <div class="container mt-3"><div class="alert alert-success shadow-sm"><i class="bi bi-check-circle me-1"></i><?php echo e(session('success')); ?></div></div>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<footer class="pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h6><?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></h6>
                <p class="small mb-2"><?php echo e($cms['settings']['address'] ?? ''); ?></p>
                <p class="small mb-2"><i class="bi bi-telephone me-2"></i><?php echo e($cms['settings']['phone'] ?? ''); ?></p>
                <p class="small mb-3"><i class="bi bi-envelope me-2"></i><?php echo e($cms['settings']['email'] ?? ''); ?></p>
                <div class="d-flex gap-3">
                    <?php $__currentLoopData = $cms['socials']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($s->url); ?>" target="_blank" aria-label="Social link"><i class="bi <?php echo e($s->icon ?: 'bi-link-45deg'); ?>"></i></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php $__currentLoopData = $cms['footers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <h6><?php echo e($w->title); ?></h6>
                    <div class="small"><?php echo nl2br(e($w->content)); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <hr>
        <div class="text-center small"><?php echo e($cms['settings']['footer_text'] ?? ('© ' . date('Y') . ' ' . config('app.name'))); ?></div>
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
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/layouts/front.blade.php ENDPATH**/ ?>