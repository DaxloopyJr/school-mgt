<?php $__env->startSection('title', 'Generate Certificate'); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Class</label>
            <select name="class_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e(request('class_id') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select></div>
        <div class="col-md-2"><label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm"><option value="">All</option>
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>" <?php echo e(request('section_id') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Load Students</button></div>
    </form>
</div>
<?php if($students->isNotEmpty()): ?>
<div class="table-card p-3">
    <form method="POST"><?php echo csrf_field(); ?>
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-4"><label class="form-label small">Certificate Template</label>
                <select name="certificate_id" class="form-select form-select-sm" required>
                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id); ?>"><?php echo e($name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></div>
            <div class="col-md-3"><button class="btn btn-success"><i class="bi bi-award me-1"></i>Generate</button></div>
        </div>
        <table class="table table-sm table-hover">
            <thead class="table-light"><tr><th><input type="checkbox" onclick="document.querySelectorAll('.stu-check').forEach(c => c.checked = this.checked)"></th><th>Roll</th><th>Student</th></tr></thead>
            <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr><td><input class="stu-check" type="checkbox" name="students[]" value="<?php echo e($s->id); ?>"></td>
                        <td><?php echo e($s->roll_no); ?></td><td><?php echo e($s->fullName()); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </form>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/certificates/generate.blade.php ENDPATH**/ ?>