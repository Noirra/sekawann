

<?php if(auth()->guard()->check()): ?>
    <?php $userRole = Auth::user()->user_level; ?>
<?php endif; ?>

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('header'); ?>
    <style>
        body {
            background-color: #fff;
            width: 100vw;
            height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('components.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid text-center">
        <h3 class="" style="color: #06c3ee">Pakaian Terbaru</h3>
        <div class="d-flex flex-wrap justify-content-evenly">
            <?php $__currentLoopData = $data_pakaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id);
                    $pakaianStok = $items->pakaian_stok;
                    $kategoriStatus = $kategori->kategori_pakaian_status;
                ?>
                <?php if($pakaianStok > 0 && $kategoriStatus > 0): ?>
                    <div class="card m-2" style="width: 18rem;" style="background-color: #06c3ee">
                        <?php if($items->pakaian_gambar_url === '' || $items->pakaian_gambar_url === null): ?>
                            <img width="100%" height="100%" src="<?php echo e(asset('img/clothes.png')); ?>" class="card-img-top"
                                alt="...">
                        <?php else: ?>
                            <img width="100%" height="100%"
                                src="<?php echo e(asset('storage/pakaian/gambar/' . basename($items->pakaian_gambar_url))); ?>"
                                class="card-img-top" alt="...">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($items->pakaian_nama); ?></h5>
                            <p class="card-text">Rp. <?php echo e($items->pakaian_harga); ?></p>
                            <a href="<?php echo e(route('detail', ['pakaian_id' => $items->pakaian_id])); ?>"
                                class="btn" style="background-color: #06c3ee">Lihat Detail</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="container-flex text-center p-4" style="background: #06c3ee">
        <div class="card text-center" style="background: #06c3ee">
            <div class="card-header" style="background: #06c3ee">
            </div>
            <div class="card-body">
                <h5 class="card-title">Thrift Shop</h5>
                <p class="card-text">Dompet Anda adalah Sahabat Terbaik Kami</p>
                <a href="#" class="btn" style="background-color: #a9e4f1">Fashion Terjangkau, Harga Tak Tertandingi.</a>
            </div>
            <div class="card-footer text-body-secondary" style="background: #06c3ee">
                Copyright &copy; Thrift Shop 2023
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Sekolah\Kelas11\--NEW_TEFA_FINAL--\--FILE_FINAL_PROJECT_FULLSTACK--\Thrift_App\resources\views/web/view/dashboard.blade.php ENDPATH**/ ?>