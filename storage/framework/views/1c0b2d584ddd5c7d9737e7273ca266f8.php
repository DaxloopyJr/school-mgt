<?php $__env->startSection('title', 'Teacher Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#4e73df"><div class="card-body">
            <div class="text-muted small text-uppercase">Total Students</div><div class="fs-4 fw-bold"><?php echo e($studentsCount); ?></div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#1cc88a"><div class="card-body">
            <div class="text-muted small text-uppercase">My Homeworks</div><div class="fs-4 fw-bold"><?php echo e($homeworks->count()); ?></div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#f6c23e"><div class="card-body">
            <div class="text-muted small text-uppercase">Weekly Periods</div><div class="fs-4 fw-bold"><?php echo e($routines->count()); ?></div>
        </div></div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="table-card p-3">
            <h6><i class="bi bi-calendar3-week me-1"></i>My Class Routine</h6>
            <table class="table table-sm table-striped small">
                <thead class="table-light"><tr><th>Day</th><th>Class</th><th>Section</th><th>Subject</th><th>Time</th><th>Room</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $routines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr><td><?php echo e($r->day); ?></td><td><?php echo e($r->schoolClass->name ?? '-'); ?></td><td><?php echo e($r->section->name ?? '-'); ?></td><td><?php echo e($r->subject->name ?? '-'); ?></td><td><?php echo e($r->start_time); ?> - <?php echo e($r->end_time); ?></td><td><?php echo e($r->classRoom->name ?? '-'); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-muted text-center">No routine assigned.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="table-card p-3 mb-3">
            <h6><i class="bi bi-pencil-square me-1"></i>Recent Homework</h6>
            <ul class="list-group list-group-flush small">
                <?php $__empty_1 = true; $__currentLoopData = $homeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between"><span><?php echo e(\Illuminate\Support\Str::limit($h->description, 40)); ?></span><span class="text-muted"><?php echo e($h->homework_date); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">No homework added yet.</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="table-card p-3">
            <h6><i class="bi bi-megaphone me-1"></i>Notices</h6>
            <ul class="list-group list-group-flush small">
                <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between"><span><?php echo e($n->title); ?></span><span class="text-muted"><?php echo e($n->publish_date); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/dashboard/teacher.blade.php ENDPATH**/ ?>