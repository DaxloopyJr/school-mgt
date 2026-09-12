<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo e(config('app.name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #1e3a8a 0%, #4e73df 60%, #6ea8fe 100%); }
        .login-card { max-width: 430px; width: 100%; border: none; border-radius: 1rem; box-shadow: 0 1rem 3rem rgba(0,0,0,.25); }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="card login-card p-2">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size: 3rem;"></i>
                <h4 class="mt-2 mb-0"><?php echo e(config('app.name')); ?></h4>
                <p class="text-muted small">Sign in to your account</p>
            </div>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger py-2 small"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($error); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required autofocus placeholder="admin@school.com">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" required placeholder="password">
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button class="btn btn-primary w-100 py-2"><i class="bi bi-box-arrow-in-right me-1"></i>Sign In</button>
            </form>
            <div class="mt-4 small text-muted">
                <strong>Demo accounts</strong> (password: <code>password</code>):
                <div class="row mt-1">
                    <div class="col-6">Admin: admin@school.com</div>
                    <div class="col-6">Teacher: teacher@school.com</div>
                    <div class="col-6">Student: student@school.com</div>
                    <div class="col-6">Parent: parent@school.com</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\school-mgt\resources\views/auth/login.blade.php ENDPATH**/ ?>