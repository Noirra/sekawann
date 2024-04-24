<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('custom/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('custom/overide.css')); ?>" rel="stylesheet" />
    
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('custom/script.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
</head>

<body>
    <div class="preloader">
        <div class="preloader-spinner"></div>
    </div>
    <header>
        <?php echo $__env->yieldContent('header'); ?>
    </header>
    <main>
        <?php echo $__env->yieldContent('main'); ?>
    </main>
    <footer class="pt-4">
        <?php echo $__env->yieldContent('footer'); ?>
    </footer>
</body>

</html>
<?php /**PATH D:\Sekolah\Kelas11\TEFA\--FINAL_PROJECT--\Thrift_App\resources\views/layouts/app.blade.php ENDPATH**/ ?>