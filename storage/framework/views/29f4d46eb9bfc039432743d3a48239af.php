<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>
<section class="hero text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Welcome to <?php echo e($cms['settings']['school_name'] ?? config('app.name')); ?></h1>
        <p class="lead">Quality education, modern management, connected community.</p>
        <a href="<?php echo e(route('front.courses')); ?>" class="btn btn-light me-2">Explore Courses</a>
        <a href="<?php echo e(route('front.contact')); ?>" class="btn btn-outline-light">Contact Us</a>
    </div>
</section>
<div class="container mt-5">
    <h4 class="mb-3"><i class="bi bi-mortarboard me-1 text-primary"></i>Featured Courses</h4>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <?php if($c->image): ?><img src="<?php echo e(asset('storage/' . $c->image)); ?>" class="card-img-top" alt=""><?php endif; ?>
                    <div class="card-body">
                        <span class="badge bg-primary mb-1"><?php echo e($c->courseCategory->name ?? 'Course'); ?></span>
                        <h6 class="card-title"><?php echo e($c->title); ?></h6>
                        <p class="card-text small text-muted"><?php echo e(\Illuminate\Support\Str::limit($c->overview, 90)); ?></p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between small">
                        <span><i class="bi bi-clock me-1"></i><?php echo e($c->duration); ?></span>
                        <a href="<?php echo e(route('front.courses.show', $c->id)); ?>">Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-muted">Courses will appear here soon.</div>
        <?php endif; ?>
    </div>

    <h4 class="mb-3 mt-5"><i class="bi bi-newspaper me-1 text-primary"></i>Latest News</h4>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <?php if($n->image): ?><img src="<?php echo e(asset('storage/' . $n->image)); ?>" class="card-img-top" alt=""><?php endif; ?>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo e($n->publish_date?->toDateString()); ?> &middot; <?php echo e($n->newsCategory->name ?? ''); ?></div>
                        <h6><?php echo e($n->title); ?></h6>
                        <p class="small text-muted"><?php echo e(\Illuminate\Support\Str::limit($n->description, 90)); ?></p>
                        <a href="<?php echo e(route('front.news.show', $n->id)); ?>" class="small">Read more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-muted">No news published yet.</div>
        <?php endif; ?>
    </div>

    <?php if($testimonials->isNotEmpty()): ?>
        <h4 class="mb-3 mt-5"><i class="bi bi-chat-quote me-1 text-primary"></i>Testimonials</h4>
        <div class="row g-3 mb-4">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm text-center p-3">
                        <?php if($t->image): ?><img src="<?php echo e(asset('storage/' . $t->image)); ?>" class="rounded-circle mx-auto" width="64" height="64" alt=""><?php endif; ?>
                        <p class="small mt-2">"<?php echo e(\Illuminate\Support\Str::limit($t->description, 120)); ?>"</p>
                        <strong class="small"><?php echo e($t->name); ?></strong>
                        <span class="text-muted small"><?php echo e($t->designation); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/front/home.blade.php ENDPATH**/ ?>