<?php $__env->startSection('title', 'Messages'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="table-card p-3">
            <h6><i class="bi bi-pencil-square me-1"></i>Compose</h6>
            <form method="POST" action="<?php echo e(route('messages.store')); ?>"><?php echo csrf_field(); ?>
                <div class="mb-2"><label class="form-label small">To</label>
                    <select name="receiver_id" class="form-select form-select-sm" required>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>"><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select></div>
                <div class="mb-2"><label class="form-label small">Subject</label>
                    <input type="text" name="subject" class="form-control form-control-sm" required></div>
                <div class="mb-2"><label class="form-label small">Message</label>
                    <textarea name="message" rows="4" class="form-control form-control-sm" required></textarea></div>
                <button class="btn btn-sm btn-primary w-100"><i class="bi bi-send me-1"></i>Send Message</button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="table-card p-3 mb-3">
            <h6><i class="bi bi-inbox me-1"></i>Inbox</h6>
            <div class="list-group list-group-flush small">
                <?php $__empty_1 = true; $__currentLoopData = $inbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong><?php echo e($m->subject); ?></strong>
                            <span class="text-muted"><?php echo e($m->created_at->format('d M Y H:i')); ?></span>
                        </div>
                        <div class="text-muted">From: <?php echo e($m->sender->name ?? '-'); ?></div>
                        <div><?php echo e($m->message); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="list-group-item text-muted">Inbox is empty.</div>
                <?php endif; ?>
            </div>
            <?php echo e($inbox->links()); ?>

        </div>
        <div class="table-card p-3">
            <h6><i class="bi bi-send me-1"></i>Sent</h6>
            <div class="list-group list-group-flush small">
                <?php $__empty_1 = true; $__currentLoopData = $sent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between"><strong><?php echo e($m->subject); ?></strong>
                            <span class="text-muted"><?php echo e($m->created_at->format('d M Y H:i')); ?></span></div>
                        <div class="text-muted">To: <?php echo e($m->receiver->name ?? '-'); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="list-group-item text-muted">No sent messages.</div>
                <?php endif; ?>
            </div>
            <?php echo e($sent->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/messages/index.blade.php ENDPATH**/ ?>