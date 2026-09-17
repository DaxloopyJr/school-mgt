<?php $__env->startSection('title', 'Contact'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4" style="max-width: 820px;">
    <h4>Contact Us</h4>
    <div class="row g-4 mt-1">
        <div class="col-md-5">
            <div class="border rounded p-3 h-100">
                <p class="mb-1"><i class="bi bi-geo-alt me-2 text-primary"></i><?php echo e($cms['settings']['address'] ?? 'School address'); ?></p>
                <p class="mb-1"><i class="bi bi-telephone me-2 text-primary"></i><?php echo e($cms['settings']['phone'] ?? ''); ?></p>
                <p class="mb-0"><i class="bi bi-envelope me-2 text-primary"></i><?php echo e($cms['settings']['email'] ?? ''); ?></p>
            </div>
        </div>
        <div class="col-md-7">
            <form method="POST" action="<?php echo e(route('front.contact.save')); ?>"><?php echo csrf_field(); ?>
                <div class="row g-2">
                    <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Your name" required></div>
                    <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email"></div>
                    <div class="col-md-6"><input type="text" name="phone" class="form-control" placeholder="Phone"></div>
                    <div class="col-md-6"><input type="text" name="subject" class="form-control" placeholder="Subject"></div>
                    <div class="col-12"><textarea name="message" rows="4" class="form-control" placeholder="Message" required></textarea></div>
                </div>
                <button class="btn btn-primary mt-3"><i class="bi bi-send me-1"></i>Send Message</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/front/contact.blade.php ENDPATH**/ ?>