<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-3">
    <h5 class="mb-3"><?php echo e($title); ?></h5>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $ext = strtolower(pathinfo($item->file ?? '', PATHINFO_EXTENSION)); ?>
            <div class="col-md-6">
                <div class="border rounded p-3 d-flex gap-3 align-items-start h-100">
                    <div class="fs-2">
                        <?php if(in_array($ext, ['jpg','jpeg','png'])): ?> <i class="bi bi-file-image text-success"></i>
                        <?php elseif($ext === 'pdf'): ?> <i class="bi bi-file-pdf text-danger"></i>
                        <?php elseif(in_array($ext, ['doc','docx'])): ?> <i class="bi bi-file-word text-primary"></i>
                        <?php elseif($ext === 'mp4'): ?> <i class="bi bi-camera-video text-danger"></i>
                        <?php elseif($ext === 'mp3'): ?> <i class="bi bi-music-note-beamed text-warning"></i>
                        <?php else: ?> <i class="bi bi-file-earmark text-secondary"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow-1">
                        <strong><?php echo e($item->title); ?></strong>
                        <div class="small text-muted"><?php echo e($item->schoolClass->name ?? 'All classes'); ?> &middot; <?php echo e($item->subject->name ?? ''); ?> &middot; <?php echo e($item->upload_date?->toDateString()); ?></div>
                        <?php if($item->description): ?><div class="small"><?php echo e(\Illuminate\Support\Str::limit($item->description, 100)); ?></div><?php endif; ?>
                    </div>
                    <?php if($item->file): ?>
                        <a href="<?php echo e(asset('storage/' . $item->file)); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12"><div class="text-muted text-center py-4">No <?php echo e(strtolower($title)); ?> available yet.</div></div>
        <?php endif; ?>
    </div>
    <div class="mt-3"><?php echo e($items->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/study-material/list.blade.php ENDPATH**/ ?>