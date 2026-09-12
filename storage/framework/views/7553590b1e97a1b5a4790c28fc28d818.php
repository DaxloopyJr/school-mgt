<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-3">
    <?php
        $cards = [
            ['label' => 'Active Students', 'value' => $students, 'icon' => 'bi-people-fill', 'color' => '#4e73df'],
            ['label' => 'Teachers', 'value' => $teachers, 'icon' => 'bi-person-workspace', 'color' => '#1cc88a'],
            ['label' => 'Staff Members', 'value' => $staff, 'icon' => 'bi-person-badge', 'color' => '#36b9cc'],
            ['label' => 'Parents', 'value' => $parents, 'icon' => 'bi-person-hearts', 'color' => '#f6c23e'],
            ['label' => 'Present Today', 'value' => $presentToday, 'icon' => 'bi-check2-circle', 'color' => '#1cc88a'],
            ['label' => 'Absent Today', 'value' => $absentToday, 'icon' => 'bi-x-circle', 'color' => '#e74a3b'],
            ['label' => 'Fees Today', 'value' => number_format($feesToday, 2), 'icon' => 'bi-cash-coin', 'color' => '#4e73df'],
            ['label' => 'Fees This Month', 'value' => number_format($feesMonth, 2), 'icon' => 'bi-graph-up', 'color' => '#6f42c1'],
        ];
    ?>
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card shadow-sm" style="border-left-color: <?php echo e($c['color']); ?>">
                <div class="card-body d-flex justify-content-between align-items-center py-3">
                    <div>
                        <div class="text-muted small text-uppercase"><?php echo e($c['label']); ?></div>
                        <div class="fs-4 fw-bold"><?php echo e($c['value']); ?></div>
                    </div>
                    <i class="bi <?php echo e($c['icon']); ?> fs-1" style="color: <?php echo e($c['color']); ?>33;"></i>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="table-card p-3 h-100">
            <h6><i class="bi bi-megaphone me-1"></i>Latest Notices</h6>
            <ul class="list-group list-group-flush small">
                <?php $__empty_1 = true; $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between"><span><?php echo e($n->title); ?></span><span class="text-muted"><?php echo e($n->publish_date); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">No notices yet.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="table-card p-3 h-100">
            <h6><i class="bi bi-calendar-event me-1"></i>Upcoming Events</h6>
            <ul class="list-group list-group-flush small">
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between"><span><?php echo e($e->title); ?></span><span class="text-muted"><?php echo e($e->from_date); ?></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-muted">No upcoming events.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>