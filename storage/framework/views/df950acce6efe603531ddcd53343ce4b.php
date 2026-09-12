<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="mb-0"><?php echo e($title); ?></h5>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control form-control-sm" placeholder="Search...">
                <button class="btn btn-sm btn-outline-primary ms-1"><i class="bi bi-search"></i></button>
            </form>
            <?php if(Route::has($route . '.create')): ?>
                <a href="<?php echo e(route($route . '.create')); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($f['list'] ?? true): ?><th><?php echo e($f['label']); ?></th><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($items->currentPage() - 1) * $items->perPage()); ?></td>
                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($f['list'] ?? true): ?>
                                <td>
                                    <?php if(($f['type'] ?? '') === 'file' && $item->{$f['name']}): ?>
                                        <?php $ext = strtolower(pathinfo($item->{$f['name']}, PATHINFO_EXTENSION)); ?>
                                        <?php if(in_array($ext, ['jpg','jpeg','png'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" target="_blank"><img src="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" width="42" height="42" class="rounded object-fit-cover" alt=""></a>
                                        <?php elseif(in_array($ext, ['mp4'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" target="_blank" class="badge bg-danger text-decoration-none"><i class="bi bi-camera-video"></i> Video</a>
                                        <?php elseif(in_array($ext, ['mp3'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" target="_blank" class="badge bg-warning text-dark text-decoration-none"><i class="bi bi-music-note"></i> Audio</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(asset('storage/' . $item->{$f['name']})); ?>" target="_blank" class="badge bg-secondary text-decoration-none"><i class="bi bi-file-earmark"></i> <?php echo e(strtoupper($ext)); ?></a>
                                        <?php endif; ?>
                                    <?php elseif(($f['type'] ?? '') === 'checkbox'): ?>
                                        <span class="badge bg-<?php echo e($item->{$f['name']} ? 'success' : 'secondary'); ?>"><?php echo e($item->{$f['name']} ? 'Yes' : 'No'); ?></span>
                                    <?php elseif(isset($f['relation'])): ?>
                                        <?php echo e(data_get($item, $f['relation'], '-')); ?>

                                    <?php else: ?>
                                        <?php echo e(\Illuminate\Support\Str::limit($item->{$f['name']}, 60)); ?>

                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td class="text-end text-nowrap">
                            <?php echo $__env->yieldContent('row-actions'); ?>
                            <?php if(Route::has($route . '.edit')): ?>
                                <a href="<?php echo e(route($route . '.edit', $item->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <?php endif; ?>
                            <?php if(Route::has($route . '.destroy')): ?>
                                <form method="POST" action="<?php echo e(route($route . '.destroy', $item->id)); ?>" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="20" class="text-center text-muted py-4">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php echo e($items->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/crud/index.blade.php ENDPATH**/ ?>