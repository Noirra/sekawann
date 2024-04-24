

<?php $__env->startSection('title', 'Login - Web Perpustakaan'); ?>

<?php $__env->startSection('icon', 'img/book_1.png'); ?>

<?php $__env->startSection('header'); ?>
    <style>
        body {
            background: radial-gradient(circle at top right, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at left bottom, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at top left, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at right bottom, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at center, #dcdaff 30%, transparent 31%);
            background-size: 4em 4em;
            background-color: #ffffff;
            opacity: 1
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <section class="login-container">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif($errors->has('message')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> <?php echo e($errors->first('message')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card shadow-lg">
            <div class="card-header">
                <img src="<?php echo e(asset('img/logo.svg')); ?>" alt="img-logo" class="img-logo" loading="lazy" />
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('user.login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group my-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan username Anda" required />
                        </div>
                    </div>
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password Anda" required />
                        </div>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group my-3 d-grid">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('register')); ?>" class="link-underline link-underline-opacity-0">
                    <p class="text-center" style="color: #8423ff;">
                        Tidak punya akun? Silahkan mendaftar
                    </p>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Sekolah\Kelas11\TEFA\--FINAL_PROJECT--\Thrift_App\resources\views/public/login.blade.php ENDPATH**/ ?>