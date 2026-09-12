<?php $__env->startSection('title', $mode === 'subject' ? 'Subject Wise Attendance' : 'Student Attendance'); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Class <span class="text-danger">*</span></label>
            <select name="class_id" class="form-select form-select-sm" required>
                <option value="">-- Select --</option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($class_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm">
                <option value="">All</option>
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($section_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php if($mode === 'subject'): ?>
            <div class="col-md-3">
                <label class="form-label small">Subject <span class="text-danger">*</span></label>
                <select name="subject_id" class="form-select form-select-sm" required>
                    <option value="">-- Select --</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e($subject_id == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="col-md-2">
            <label class="form-label small">Date <span class="text-danger">*</span></label>
            <input type="date" name="date" value="<?php echo e($date); ?>" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100"><i class="bi bi-search me-1"></i>Load Students</button></div>
    </form>
</div>

<?php if($students->isNotEmpty()): ?>
<div class="table-card p-3">
    <form method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="class_id" value="<?php echo e($class_id); ?>">
        <input type="hidden" name="section_id" value="<?php echo e($section_id); ?>">
        <?php if($mode === 'subject'): ?><input type="hidden" name="subject_id" value="<?php echo e($subject_id); ?>"><?php endif; ?>
        <input type="hidden" name="date" value="<?php echo e($date); ?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Attendance for <?php echo e($date); ?></h6>
            <button type="button" class="btn btn-sm btn-outline-success" onclick="document.querySelectorAll('.status-p').forEach(r => r.checked = true)">Mark All Present</button>
        </div>
        <table class="table table-sm table-hover align-middle">
            <thead class="table-light"><tr><th>Roll</th><th>Student</th><th class="text-center">Present</th><th class="text-center">Absent</th><th class="text-center">Late</th><th class="text-center">Half Day</th></tr></thead>
            <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $st = $existing[$s->id] ?? 'present'; ?>
                    <tr>
                        <td><?php echo e($s->roll_no); ?></td>
                        <td><?php echo e($s->fullName()); ?></td>
                        <td class="text-center"><input class="form-check-input status-p" type="radio" name="status[<?php echo e($s->id); ?>]" value="present" <?php echo e($st === 'present' ? 'checked' : ''); ?>></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[<?php echo e($s->id); ?>]" value="absent" <?php echo e($st === 'absent' ? 'checked' : ''); ?>></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[<?php echo e($s->id); ?>]" value="late" <?php echo e($st === 'late' ? 'checked' : ''); ?>></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[<?php echo e($s->id); ?>]" value="half_day" <?php echo e($st === 'half_day' ? 'checked' : ''); ?>></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Attendance</button>
    </form>
</div>
<?php elseif(request()->filled('class_id')): ?>
    <div class="alert alert-info">No active students found for the selected filters.</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/attendance/take.blade.php ENDPATH**/ ?>