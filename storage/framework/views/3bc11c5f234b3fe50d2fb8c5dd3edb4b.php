<?php $__env->startSection('title', 'Chat Box'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-lg-4">
        <?php if($pendingInvites->isNotEmpty()): ?>
            <div class="table-card p-3 mb-3">
                <h6 class="small text-uppercase text-muted">Chat Invitations</h6>
                <?php $__currentLoopData = $pendingInvites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span><?php echo e($inv->fromUser->name ?? ''); ?> <span class="badge bg-secondary"><?php echo e($inv->fromUser->role ?? ''); ?></span></span>
                        <form method="POST" action="<?php echo e(route('chat.invite.respond', $inv->id)); ?>" class="d-flex gap-1"><?php echo csrf_field(); ?>
                            <button name="action" value="accept" class="btn btn-sm btn-success">Accept</button>
                            <button name="action" value="reject" class="btn btn-sm btn-outline-danger">Reject</button>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="table-card p-3">
            <h6 class="small text-uppercase text-muted">Contacts</h6>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('chat.index', ['with' => $c->id])); ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2 <?php echo e($active && $active->id === $c->id ? 'active' : ''); ?>">
                        <img src="<?php echo e($c->avatarUrl()); ?>" class="rounded-circle" width="30" height="30" alt="">
                        <span class="small"><?php echo e($c->name); ?> <span class="badge bg-light text-dark border"><?php echo e($c->role); ?></span></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-muted small py-2">No contacts available. Send an invitation first.</div>
                <?php endif; ?>
            </div>
            <?php if(auth()->user()->role !== 'admin'): ?>
                <hr>
                <form method="POST" action="<?php echo e(route('chat.invite')); ?>" class="d-flex gap-1"><?php echo csrf_field(); ?>
                    <select name="user_id" class="form-select form-select-sm">
                        <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?> (<?php echo e($u->role); ?>)</option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn btn-sm btn-outline-primary">Invite</button>
                </form>
            <?php endif; ?>
            <?php if($blockedUsers->isNotEmpty()): ?>
                <hr>
                <h6 class="small text-uppercase text-muted">Blocked Users</h6>
                <?php $__currentLoopData = $blockedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between small mb-1">
                        <span><?php echo e($b->blockedUser->name ?? ''); ?></span>
                        <form method="POST" action="<?php echo e(route('chat.unblock', $b->blocked_user_id)); ?>"><?php echo csrf_field(); ?>
                            <button class="btn btn-sm btn-link p-0">Unblock</button></form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if($active): ?>
            <div class="table-card d-flex flex-column" style="height: 70vh;">
                <div class="p-2 border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <img src="<?php echo e($active->avatarUrl()); ?>" class="rounded-circle" width="34" height="34" alt="">
                        <strong><?php echo e($active->name); ?></strong> <span class="badge bg-secondary"><?php echo e($active->role); ?></span>
                    </div>
                    <form method="POST" action="<?php echo e(route('chat.block')); ?>" onsubmit="return confirm('Block this user?')"><?php echo csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?php echo e($active->id); ?>">
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-slash-circle"></i></button>
                    </form>
                </div>
                <div class="flex-grow-1 overflow-auto p-3" id="chatBox" data-fetch="<?php echo e(route('chat.fetch', $active->id)); ?>" data-me="<?php echo e(auth()->id()); ?>"></div>
                <form method="POST" action="<?php echo e(route('chat.send')); ?>" enctype="multipart/form-data" class="p-2 border-top d-flex gap-2">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="receiver_id" value="<?php echo e($active->id); ?>">
                    <input type="file" name="file" class="form-control form-control-sm" style="max-width: 180px;" title="Attachment (max 10MB)">
                    <input type="text" name="message" class="form-control form-control-sm" placeholder="Type a message..." autocomplete="off">
                    <button class="btn btn-sm btn-primary"><i class="bi bi-send"></i></button>
                </form>
            </div>
        <?php else: ?>
            <div class="table-card p-5 text-center text-muted">Select a contact to start chatting.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php if($active): ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    const box = document.getElementById('chatBox');
    const url = box.dataset.fetch;
    const canPin = <?php echo e(in_array(auth()->user()->role, ['admin','teacher']) ? 'true' : 'false'); ?>;
    function render(msgs) {
        let html = '';
        msgs.sort((a, b) => (b.pinned - a.pinned));
        msgs.forEach(m => {
            const align = m.mine ? 'text-end' : 'text-start';
            const bubble = m.mine ? 'bg-primary text-white' : 'bg-light border';
            let body = '';
            if (m.pinned) body += '<div class="small"><i class="bi bi-pin-angle-fill text-warning"></i> pinned</div>';
            if (m.message) body += '<div>' + $('<div>').text(m.message).html() + '</div>';
            if (m.file) body += '<div><a href="' + m.file + '" target="_blank" class="small">attachment</a></div>';
            body += '<div class="small opacity-75">' + m.time + (canPin ? ' <form method="POST" action="/chat/pin/' + m.id + '" class="d-inline"><input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><button class="btn btn-link btn-sm p-0 text-warning"><i class="bi bi-pin-angle"></i></button></form>' : '') + '</div>';
            html += '<div class="' + align + ' mb-2"><div class="d-inline-block p-2 rounded ' + bubble + '" style="max-width:70%;">' + body + '</div></div>';
        });
        box.innerHTML = html || '<div class="text-muted text-center small mt-4">No messages yet. Say hello!</div>';
    }
    function poll() { $.getJSON(url, render); }
    poll();
    setInterval(poll, 4000);
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/chat/index.blade.php ENDPATH**/ ?>