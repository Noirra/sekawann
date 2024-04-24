

<?php $__env->startSection('title', 'Registrasi - Web Perpustakaan'); ?>

<?php $__env->startSection('icon', 'img/book_1.png'); ?>

<?php $__env->startSection('header'); ?>
    <style>
        body {
            background: radial-gradient(circle at top right, transparent 10%, #a9e4f1 10%, #a9e4f1 20%, transparent 21%), radial-gradient(circle at left bottom, transparent 10%, #a9e4f1 10%, #a9e4f1 20%, transparent 21%), radial-gradient(circle at top left, transparent 10%, #a9e4f1 10%, #a9e4f1 20%, transparent 21%), radial-gradient(circle at right bottom, transparent 10%, #a9e4f1 10%, #a9e4f1 20%, transparent 21%), radial-gradient(circle at center, #a9e4f1 30%, transparent 31%);
            background-size: 4em 4em;
            background-color: #ffffff;
            opacity: 1
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <section class="pt-4 container">
        <div class="card shadow-lg">
            <div class="card-header">
                <img src="<?php echo e(asset('img/logo.svg')); ?>" alt="img-logo" class="img-logo" loading="lazy" />
            </div>
            <div class="card-body container-fluid px-4 pt-4">
                <form class="row g-3 needs-validation" action="<?php echo e(route('user.register')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-label col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="username" id="username" value="<?php echo e(old('username')); ?>"
                                class="form-control" placeholder="Masukkan username Anda" required />
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
                    </div>
                    <div class="form-label col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-geo-alt-fill"></i>
                            </span>
                            <input type="text" name="alamat" id="alamat" value="<?php echo e(old('alamat')); ?>"
                                class="form-control" placeholder="Masukkan alamat Anda" required />
                        </div>
                        <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-label col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                                class="form-control" placeholder="Masukkan email Anda" required />
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-label col-md-6">
                        <label for="notelp" class="form-label">No. Telp</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="tel" name="notelp" id="notelp" value="<?php echo e(old('notelp')); ?>"
                                class="form-control" placeholder="Masukkan nomor telepon Anda" required />
                        </div>
                        <?php $__errorArgs = ['notelp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-label col-md-6 my-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" value="<?php echo e(old('password')); ?>"
                                class="form-control" placeholder="Masukkan password Anda" required />
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
                    </div>
                    <div class="form-label col-md-6 my-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="valid_password" id="valid_password"
                                value="<?php echo e(old('valid_password')); ?>"class="form-control"
                                placeholder="Konfirmasi password Anda" required />
                        </div>
                        <?php $__errorArgs = ['valid_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" style="background-color: #06c3ee; color: white">Register</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="<?php echo e(route('login')); ?>" class="link-underline link-underline-opacity-0">
                    <p class="text-center" style="color: #06c3ee;">
                        Sudah punya akun? Silahkan masuk
                    </p>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Sekolah\Kelas11\--NEW_TEFA_FINAL--\--FILE_FINAL_PROJECT_FULLSTACK--\Thrift_App\resources\views/public/register.blade.php ENDPATH**/ ?>