<?php $__env->startSection('title', 'Take Exam - ' . $exam->title); ?>
<?php $__env->startSection('content'); ?>
<div class="table-card p-4 mx-auto" style="max-width: 860px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0"><?php echo e($exam->title); ?></h5>
            <div class="small text-muted"><?php echo e($exam->subject->name ?? ''); ?> &middot; <?php echo e($questions->count()); ?> questions &middot; <?php echo e($exam->total_mark); ?> marks</div>
        </div>
        <span class="badge bg-danger fs-6" id="timer"><?php echo e($exam->duration_minutes); ?>:00</span>
    </div>
    <?php if($questions->isEmpty()): ?>
        <div class="alert alert-warning">No questions have been attached to this exam yet.</div>
    <?php else: ?>
    <form method="POST" action="<?php echo e(route('online-exams.submit', $exam->id)); ?>" id="examForm"><?php echo csrf_field(); ?>
        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border rounded p-3 mb-3">
                <div class="fw-semibold mb-2">Q<?php echo e($i + 1); ?>. <?php echo e($q->question); ?> <span class="badge bg-light text-dark border"><?php echo e($q->mark); ?> mark</span></div>
                <?php if($q->type === 'mcq'): ?>
                    <?php $__currentLoopData = ['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($opt): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[<?php echo e($q->id); ?>]" value="<?php echo e($key); ?>" id="q<?php echo e($q->id); ?><?php echo e($key); ?>">
                                <label class="form-check-label" for="q<?php echo e($q->id); ?><?php echo e($key); ?>"><?php echo e($key); ?>. <?php echo e($opt); ?></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php elseif($q->type === 'true_false'): ?>
                    <div class="form-check"><input class="form-check-input" type="radio" name="answers[<?php echo e($q->id); ?>]" value="true" id="q<?php echo e($q->id); ?>t">
                        <label class="form-check-label" for="q<?php echo e($q->id); ?>t">True</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="answers[<?php echo e($q->id); ?>]" value="false" id="q<?php echo e($q->id); ?>f">
                        <label class="form-check-label" for="q<?php echo e($q->id); ?>f">False</label></div>
                <?php else: ?>
                    <input type="text" name="answers[<?php echo e($q->id); ?>]" class="form-control" placeholder="Your answer">
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button class="btn btn-success" onclick="return confirm('Submit your answers? This cannot be undone.')"><i class="bi bi-check2-circle me-1"></i>Submit Exam</button>
    </form>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    let seconds = <?php echo e((int) $exam->duration_minutes * 60); ?>;
    const el = document.getElementById('timer');
    const form = document.getElementById('examForm');
    const t = setInterval(() => {
        seconds--;
        const m = Math.floor(seconds / 60), s = seconds % 60;
        el.textContent = m + ':' + String(s).padStart(2, '0');
        if (seconds <= 0) { clearInterval(t); if (form) form.submit(); }
    }, 1000);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/online-exam/take.blade.php ENDPATH**/ ?>