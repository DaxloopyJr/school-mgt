<?php $__env->startSection('title', 'Courses'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4 class="mb-3">Our Courses</h4>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <?php if($c->image): ?><img src="<?php echo e(asset('storage/' . $c->image)); ?>" class="card-img-top" alt=""><?php endif; ?>
                    <div class="card-body">
                        <span class="badge bg-primary mb-1"><?php echo e($c->courseCategory->name ?? 'Course'); ?></span>
                        <h6><?php echo e($c->title); ?></h6>
                        <p class="small text-muted"><?php echo e(\Illuminate\Support\Str::limit($c->overview, 100)); ?></p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between small">
                        <span><?php echo e($c->duration); ?></span>
                        <a href="<?php echo e(route('front.courses.show', $c->id)); ?>">Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-muted">Courses will appear here soon.</div>
        <?php endif; ?>
    </div>
    <div class="mt-3"><?php echo e($items->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/front/courses.blade.php ENDPATH**/ ?>