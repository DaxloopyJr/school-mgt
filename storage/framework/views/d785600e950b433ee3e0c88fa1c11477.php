<?php $__env->startSection('title', 'News'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4 class="mb-3">News & Announcements</h4>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <?php if($n->image): ?><img src="<?php echo e(asset('storage/' . $n->image)); ?>" class="card-img-top" alt=""><?php endif; ?>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo e($n->publish_date?->toDateString()); ?> &middot; <?php echo e($n->newsCategory->name ?? ''); ?></div>
                        <h6><?php echo e($n->title); ?></h6>
                        <p class="small text-muted"><?php echo e(\Illuminate\Support\Str::limit($n->description, 100)); ?></p>
                        <a href="<?php echo e(route('front.news.show', $n->id)); ?>" class="small">Read more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-muted">No news published yet.</div>
        <?php endif; ?>
    </div>
    <div class="mt-3"><?php echo e($items->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/front/news.blade.php ENDPATH**/ ?>