<?php if(auth()->guard()->check()): ?>
    <?php $userRole = Auth::user()->user_level; ?>
<?php endif; ?>

<?php $__env->startSection('title', 'Detail Pakaian'); ?>

<?php $__env->startSection('header'); ?>
    <style>
        body {
            background-color: whitesmoke;
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
    <?php
        $kategori_pakaian = \App\Models\Kategori_Pakaian::find($detail->pakaian_kategori_pakaian_id);
    ?>
    <div class="container-fluid p-3" style="background: whitesmoke">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session('updated')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo e(session('updated')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session('deleted')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo e(session('deleted')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card text-bg-dark mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <?php if($detail->pakaian_gambar_url === '' || $detail->pakaian_gambar_url === null): ?>
                        <img src="<?php echo e(asset('img/clothes.png')); ?>" class="img-fluid ratio-1x1" alt="...">
                    <?php else: ?>
                        <img src="<?php echo e(asset('storage/pakaian/gambar/' . basename($detail->pakaian_gambar_url))); ?>"
                            class="img-fluid ratio-1x1" alt="...">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <ul class="list-group mt-3">
                            <li class="list-group-item">
                                <h2><?php echo e($detail->pakaian_nama); ?></h2>
                            </li>
                            <li class="list-group-item">
                                <h3>Kategori : <?php echo e($kategori_pakaian->kategori_pakaian_nama); ?></h3>
                            </li>
                            <li class="list-group-item">
                                <h5>Stok Tersisa : <?php echo e($detail->pakaian_stok); ?></h5>
                            </li>
                            <li class="list-group-item">
                                <h5>Harga : Rp.<?php echo e($detail->pakaian_harga); ?></h5>
                            </li>
                        </ul>
                        <?php
                        $cart = Session::get('cart', []);
                        $foundInCart = false;
                        foreach ($cart as $item) {
                            if ($item['id'] == $detail->pakaian_id) {
                                $foundInCart = true;
                                break;
                            }
                        }
                        ?>
                        <?php if($foundInCart): ?>
                            <button type="button" class="btn btn-warning mt-2" disabled>Already in Cart</button>
                        <?php else: ?>
                            <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($detail->pakaian_id); ?>">
                                <input type="hidden" name="product_jumlah" value="1">
                                <button type="submit" class="btn mt-2" style="background: #06c3ee">Tambah ke Keranjang</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-center">
        <h3>Pakaian Lain</h3>
        <div class="d-flex flex-wrap justify-content-evenly">
            <?php $__currentLoopData = $data_pakaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $kategori = \App\Models\Kategori_Pakaian::find($items->pakaian_kategori_pakaian_id);
                    $pakaianStok = $items->pakaian_stok;
                    $kategoriStatus = $kategori->kategori_pakaian_status;
                ?>
                <?php if($pakaianStok > 0 && $kategoriStatus > 0): ?>
                    <div class="card text-bg-dark m-2" style="width: 18rem;">
                        <img width="100%" height="100%"
                            src="<?php echo e(asset('storage/pakaian/gambar/' . basename($items->pakaian_gambar_url))); ?>"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($items->pakaian_nama); ?></h5>
                            <p class="card-text">Rp. <?php echo e($items->pakaian_harga); ?></p>
                            <a href="<?php echo e(route('detail', ['pakaian_id' => $items->pakaian_id])); ?>"
                                class="btn" style="background: #06c3ee">Lihat Detail</a>
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
                <p class="card-text">Your Wallet is Our Best Friend</p>
                <a href="#" class="btn btn-primary">Affordable Fashion, Unbeatable Prices</a>
            </div>
            <div class="card-footer text-body-secondary" style="background: #06c3ee">
                Copyright &copy; Thrift Shop 2023
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\.SEKOLAH\final\Project_Laravel-main\resources\views/web/view/detail.blade.php ENDPATH**/ ?>