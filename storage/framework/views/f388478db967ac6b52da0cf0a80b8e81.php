<?php $__env->startSection('title', 'Online Exams'); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Online Exams</h5>
        <?php if(in_array(auth()->user()->role, ['admin', 'teacher'])): ?>
            <a href="<?php echo e(route('online-exams.create')); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
        <?php endif; ?>
    </div>
    <table class="table table-hover align-middle small">
        <thead class="table-light"><tr><th>#</th><th>Title</th><th>Class</th><th>Subject</th><th>Date</th><th>Duration</th><th>Total Mark</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e($item->schoolClass->name ?? '-'); ?></td>
                    <td><?php echo e($item->subject->name ?? '-'); ?></td>
                    <td><?php echo e($item->date?->toDateString()); ?></td>
                    <td><?php echo e($item->duration_minutes); ?> min</td>
                    <td><?php echo e($item->total_mark); ?></td>
                    <td><span class="badge bg-<?php echo e($item->status === 'published' ? 'success' : ($item->status === 'closed' ? 'secondary' : 'warning')); ?>"><?php echo e(ucfirst($item->status)); ?></span></td>
                    <td class="text-end text-nowrap">
                        <?php if(auth()->user()->role === 'student'): ?>
                            <?php if(isset($attempts[$item->id])): ?>
                                <span class="badge bg-info">Score: <?php echo e($attempts[$item->id]); ?></span>
                            <?php elseif($item->status === 'published'): ?>
                                <a href="<?php echo e(route('online-exams.take', $item->id)); ?>" class="btn btn-sm btn-success">Take Exam</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('online-exams.questions', $item->id)); ?>" class="btn btn-sm btn-outline-secondary" title="Manage Questions"><i class="bi bi-list-check"></i></a>
                            <a href="<?php echo e(route('online-exams.edit', $item->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('online-exams.destroy', $item->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this exam?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="9" class="text-center text-muted py-4">No online exams found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($items->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/online-exam/index.blade.php ENDPATH**/ ?>