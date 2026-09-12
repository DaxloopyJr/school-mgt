<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Class</label>
            <select name="class_id" class="form-select form-select-sm" required>
                <option value="">-- Select --</option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($class_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm"><option value="">All</option>
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($section_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php if($mode === 'subject'): ?>
            <div class="col-md-3">
                <label class="form-label small">Subject</label>
                <select name="subject_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($subject_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="col-md-2">
            <label class="form-label small">Month</label>
            <input type="number" name="month" min="1" max="12" value="<?php echo e($month); ?>" class="form-control form-control-sm">
        </div>
        <div class="col-md-2">
            <label class="form-label small">Year</label>
            <input type="number" name="year" value="<?php echo e($year); ?>" class="form-control form-control-sm">
        </div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
<?php if($rows->isNotEmpty()): ?>
<div class="table-card p-3">
    <div class="d-flex justify-content-between mb-2"><h6 class="mb-0"><?php echo e($title); ?> - <?php echo e($month); ?>/<?php echo e($year); ?></h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button></div>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th class="text-center text-success">Present</th><th class="text-center text-danger">Absent</th><th class="text-center text-warning">Late</th><th class="text-center">Half Day</th><th class="text-center">Attendance %</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $p = $r['att']['present'] ?? 0; $a = $r['att']['absent'] ?? 0; $l = $r['att']['late'] ?? 0; $h = $r['att']['half_day'] ?? 0;
                    $total = $p + $a + $l + $h; $pct = $total ? round(($p + $l + $h * 0.5) / $total * 100, 1) : 0;
                ?>
                <tr><td><?php echo e($r['student']->roll_no); ?></td><td><?php echo e($r['student']->fullName()); ?></td>
                    <td class="text-center"><?php echo e($p); ?></td><td class="text-center"><?php echo e($a); ?></td><td class="text-center"><?php echo e($l); ?></td><td class="text-center"><?php echo e($h); ?></td>
                    <td class="text-center"><span class="badge bg-<?php echo e($pct >= 75 ? 'success' : 'danger'); ?>"><?php echo e($pct); ?>%</span></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/attendance/report.blade.php ENDPATH**/ ?>