<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/admin-theme.css')); ?>" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background:
                radial-gradient(700px 400px at 90% -10%, rgba(124, 58, 237, .5), transparent 60%),
                radial-gradient(600px 400px at -10% 110%, rgba(56, 189, 248, .35), transparent 55%),
                linear-gradient(135deg, #4b5bd6 0%, #6d28d9 100%);
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            max-width: 440px;
            width: 100%;
            border: none;
            border-radius: 22px;
            box-shadow: 0 24px 60px rgba(20, 15, 60, .35);
        }
        .login-logo {
            width: 66px; height: 66px;
            border-radius: 18px;
            background: linear-gradient(135deg, #4b5bd6, #6d28d9);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.8rem;
            box-shadow: 0 10px 24px rgba(85, 110, 230, .4);
        }
        .login-card .input-group-text { background: #f5f7fb; }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center px-3">
    <div class="card login-card">
        <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
                <span class="login-logo"><i class="bi bi-mortarboard-fill"></i></span>
                <h4 class="mt-3 mb-1 fw-semibold"><?php echo e(config('app.name')); ?></h4>
                <p class="text-muted small mb-0">Sign in to your account</p>
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
                <div class="row mt-1 g-1">
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