<?php $__env->startSection('title', 'Halaman Dashboard'); ?>

<?php if(auth()->guard()->check()): ?>
    <?php $userRole = Auth::user()->user_level; ?>
<?php endif; ?>

<?php $__env->startSection('header'); ?>
    <style>
        body {
            background: linear-gradient(to right, #a9e4f1, #ffffff);
            width: 100vw;
            height: 100vh;
            color: #333; /* Ubah warna teks menjadi abu-abu */
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
    <?php echo $__env->make('layouts.nav_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <section class="pt-2 container pb-5" >
        <div class="card text-center border-2" style="background-color: #06c3ee">
            <div class="card-body">
                <h2 class="card-title">Dashboard Admin</h2>
                <h4 class="card-text">
                    Halaman Dashboard Admin
                </h4>
            </div>
        </div>
        <div class="container-fluid px-4 pt-4 pb-5">
            <div class="row gap-4 justify-content-sm-around">
                
                <div class="card shadow-lg text-bg-primary mb-3" style="max-width: 18rem">
                    <div class="card-header">Data User</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e(count($data_user)); ?> User</h5>
                        <p class="card-text">
                            <?php echo e(count($data_user)); ?> Data User tersimpan pada database
                        </p>
                    </div>
                </div>

                
                <div class="card shadow-lg text-bg-success mb-3" style="max-width: 18rem">
                    <div class="card-header">Data Pakaian</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e(count($data_pakaian)); ?> Pakaian</h5>
                        <p class="card-text">
                            <?php echo e(count($data_pakaian)); ?> Data Pakaian terdapat pada database
                        </p>
                    </div>
                </div>

                
                <div class="card shadow-lg text-bg-warning mb-3" style="max-width: 18rem">
                    <div class="card-header">Data Pembelian</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e(count($data_pembelian)); ?> Pembelian</h5>
                        <p class="card-text">
                            <?php echo e(count($data_pembelian)); ?> Data Pembelian terdapat pada database
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="fixed-bottom p-3" style="background-color: #06c3ee;">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Thrift Shop 2023</div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\.SEKOLAH\final\Project_Laravel-main\resources\views/web/data/admin.blade.php ENDPATH**/ ?>