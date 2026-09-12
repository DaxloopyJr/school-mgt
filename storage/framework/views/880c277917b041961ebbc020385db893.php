<?php $__env->startSection('title', ($item ? 'Edit ' : 'Add ') . $title); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-4" style="max-width: 900px;">
    <h5 class="mb-3"><?php echo e($item ? 'Edit' : 'Add'); ?> <?php echo e($title); ?></h5>
    <form method="POST" action="<?php echo e($item ? route($route . '.update', $item->id) : route($route . '.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if($item): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
        <div class="row g-3">
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $type = $f['type'] ?? 'text'; $value = old($f['name'], $item->{$f['name']} ?? ($f['default'] ?? '')); ?>
                <div class="col-md-<?php echo e($f['col'] ?? ($type === 'textarea' ? 12 : 6)); ?>">
                    <label class="form-label"><?php echo e($f['label']); ?> <?php if(!empty($f['required'])): ?><span class="text-danger">*</span><?php endif; ?></label>
                    <?php if($type === 'textarea'): ?>
                        <textarea name="<?php echo e($f['name']); ?>" class="form-control" rows="<?php echo e($f['rows'] ?? 3); ?>" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>><?php echo e($value); ?></textarea>
                    <?php elseif($type === 'select'): ?>
                        <select name="<?php echo e($f['name']); ?>" class="form-select" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                            <option value="">-- Select <?php echo e($f['label']); ?> --</option>
                            <?php $__currentLoopData = ($f['options'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k); ?>" <?php echo e((string)$value === (string)$k ? 'selected' : ''); ?>><?php echo e($v); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php elseif($type === 'checkbox'): ?>
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="<?php echo e($f['name']); ?>" value="0">
                            <input class="form-check-input" type="checkbox" name="<?php echo e($f['name']); ?>" value="1" <?php echo e($value ? 'checked' : ''); ?>>
                            <label class="form-check-label"><?php echo e($f['hint'] ?? 'Enabled'); ?></label>
                        </div>
                    <?php elseif($type === 'file'): ?>
                        <input type="file" name="<?php echo e($f['name']); ?>" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.mp4,.mp3" <?php echo e(!empty($f['required']) && !$item ? 'required' : ''); ?>>
                        <?php if($item && $item->{$f['name']}): ?>
                            <small class="text-muted">Current: <a href="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" target="_blank">view file</a></small>
                        <?php endif; ?>
                        <small class="text-muted d-block">Allowed: jpg, png, jpeg, pdf, doc, docx, mp4, mp3 (max 20MB)</small>
                    <?php elseif($type === 'number' || $type === 'integer'): ?>
                        <input type="number" step="<?php echo e($f['step'] ?? 'any'); ?>" name="<?php echo e($f['name']); ?>" value="<?php echo e($value); ?>" class="form-control" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                    <?php elseif($type === 'date'): ?>
                        <input type="date" name="<?php echo e($f['name']); ?>" value="<?php echo e($value); ?>" class="form-control" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                    <?php elseif($type === 'time'): ?>
                        <input type="time" name="<?php echo e($f['name']); ?>" value="<?php echo e($value); ?>" class="form-control" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                    <?php elseif($type === 'email'): ?>
                        <input type="email" name="<?php echo e($f['name']); ?>" value="<?php echo e($value); ?>" class="form-control" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                    <?php elseif($type === 'password'): ?>
                        <input type="password" name="<?php echo e($f['name']); ?>" class="form-control" <?php echo e(!empty($f['required']) && !$item ? 'required' : ''); ?> placeholder="<?php echo e($item ? 'Leave blank to keep current' : ''); ?>">
                    <?php else: ?>
                        <input type="text" name="<?php echo e($f['name']); ?>" value="<?php echo e($value); ?>" class="form-control" <?php echo e(!empty($f['required']) ? 'required' : ''); ?>>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-4">
            <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i><?php echo e($item ? 'Update' : 'Save'); ?></button>
            <a href="<?php echo e(route($route . '.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/crud/form.blade.php ENDPATH**/ ?>