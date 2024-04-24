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
            font-family: Arial, sans-serif;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>
    <?php echo $__env->make('layouts.nav_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <section class="pt-2 container pb-20">
    <div class="card text-center border-2">
            <div class="card-body" style="background-color: #06c3ee">
                <h2 class="card-title">Data Pembelian</h2>
                <h4 class="card-text" style="color: white">Halaman Data Pembelian</h4>
            </div>
        </div>
        <div class="pt-2 container pb-20">
            <div class="row gap-4 justify-content-sm-around">
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal Pembelian</th>
                                <th>Total Harga</th>
                                <th>Status Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data_pembelian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $user = \App\Models\Data_User::find($items->pembelian_user_id); ?>
                                <?php $metode = \App\Models\Metode_Pembayaran::find($items->pembelian_metode_pembayaran_id); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($user->user_fullname); ?></td>
                                    <td><?php echo e($metode->metode_pembayaran_jenis); ?></td>
                                    <td><?php echo e($items->pembelian_tanggal); ?></td>
                                    <td>Rp. <?php echo e($items->pembelian_total_harga); ?></td>
                                    <?php switch($items->pembelian_status):
                                        case ('beli'): ?>
                                            <td><button class="btn btn-outline-warning w-100">Beli</button></td>
                                        <?php break; ?>

                                        <?php case ('proses'): ?>
                                            <td><button class="btn btn-outline-info w-100">Proses</button></td>
                                        <?php break; ?>

                                        <?php case ('selesai'): ?>
                                            <td><button class="btn btn-outline-success w-100">Selesai</button></td>
                                        <?php break; ?>

                                        <?php case ('batal'): ?>
                                            <td><button class="btn btn-outline-danger w-100">Batal</button></td>
                                        <?php break; ?>

                                        <?php default: ?>
                                            <td><button class="btn btn-outline-danger w-100">Kesalahan Data</button></td>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </tr>
                                
                                <div class="modal" id="viewPembelianModal_<?php echo e($items->pembelian_id); ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="fs-5">Lihat Detail Data Pembelian Pakaian</h1>
                                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <?php
                                                    $details = \App\Models\Detail_Pembelian::where('detail_pembelian_pembelian_id', $items->pembelian_id)->get();
                                                ?>
                                                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $pakaian = \App\Models\Data_Pakaian::find($detail->detail_pembelian_pakaian_id);
                                                    ?>
                                                    <li class="list-group-item">
                                                        <?php echo e($pakaian->pakaian_nama); ?> - Rp. <?php echo e($detail->detail_pembelian_total_harga); ?>

                                                        <span class="badge">Jumlah : <?php echo e($detail->detail_pembelian_jumlah); ?></span>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal" id="updatePembelianModal_<?php echo e($items->pembelian_id); ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="fs-5">Ubah Data Pembelian Pakaian</h1>
                                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?php echo e(route('data_pembelian.update', ['pembelian_id' => $items->pembelian_id])); ?>" method="post">
                                            <div class="modal-body">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="hidden" name="user" value="<?php echo e($items->pembelian_user_id); ?>" />
                                                <input type="hidden" name="metode_pembayaran" value="<?php echo e($items->pembelian_metode_pembayaran_id); ?>" />
                                                <input type="hidden" name="total_harga" value="<?php echo e($items->pembelian_total_harga); ?>" />
                                                <div class="m-2">
                                                    <label for="tanggal">Tanggal Pembelian</label>
                                                    <input type="date" name="tanggal" id="tanggal" value="<?php echo e($items->pembelian_tanggal); ?>" />
                                                </div>
                                                <div class="m-2 d-grid">
                                                    <label for="status">Status Pembelian</label>
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" name="status" id="status0_<?php echo e($items->pembelian_status); ?>" value="beli" <?php echo e($items->pembelian_status == 'beli' ? 'checked' : ''); ?>>
                                                        <label class="btn btn-outline-warning" for="status0_<?php echo e($items->pembelian_status); ?>">Beli</label>
                                                        <input type="radio" name="status" id="status1_<?php echo e($items->pembelian_status); ?>" value="proses" <?php echo e($items->pembelian_status == 'proses' ? 'checked' : ''); ?>>
                                                        <label class="btn btn-outline-info" for="status1_<?php echo e($items->pembelian_status); ?>">Proses</label>
                                
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="viewPembelianModal_<?php echo e($items->pembelian_id); ?>" tabindex="-1"
                                    aria-labelledby="viewPembelianModalLabel_<?php echo e($items->pembelian_id); ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="viewPembelianModalLabel_<?php echo e($items->pembelian_id); ?>">Lihat Detail
                                                    Data Pembelian Pakaian</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <?php
                                                        $details = \App\Models\Detail_Pembelian::where('detail_pembelian_pembelian_id', $items->pembelian_id)->get();
                                                    ?>
                                                    <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $pakaian = \App\Models\Data_Pakaian::find($detail->detail_pembelian_pakaian_id);
                                                        ?>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center">
                                                            <?php echo e($pakaian->pakaian_nama); ?> - Rp.
                                                            <?php echo e($detail->detail_pembelian_total_harga); ?>

                                                            <span class="badge rounded-pill"
                                                                style="background-color: #8423ff">Jumlah :
                                                                <?php echo e($detail->detail_pembelian_jumlah); ?></span>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="updatePembelianModal_<?php echo e($items->pembelian_id); ?>" tabindex="-1"
                                    aria-labelledby="updatePembelianModalLabel_<?php echo e($items->pembelian_id); ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="updatePembelianModalLabel_<?php echo e($items->pembelian_id); ?>">Ubah
                                                    Data Pembelian Pakaian</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="<?php echo e(route('data_pembelian.update', ['pembelian_id' => $items->pembelian_id])); ?>"
                                                method="post">
                                                <div class="modal-body">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" name="user" class="form-control"
                                                        id="user" value="<?php echo e($items->pembelian_user_id); ?>" />
                                                    <input type="hidden" name="metode_pembayaran" class="form-control"
                                                        id="metode_pembayaran"
                                                        value="<?php echo e($items->pembelian_metode_pembayaran_id); ?>" />
                                                    <input type="hidden" name="total_harga" class="form-control"
                                                        id="total_harga" value="<?php echo e($items->pembelian_total_harga); ?>" />
                                                    <div class="m-2">
                                                        <label for="nama" class="form-label">Tanggal Pembelian</label>
                                                        <input type="date" name="tanggal" class="form-control"
                                                            id="tanggal" placeholder="Masukkan Tanggal Pembelian"
                                                            value="<?php echo e($items->pembelian_tanggal); ?>" />
                                                    </div>
                                                    <div class="m-2 d-grid">
                                                        <label for="status" class="form-label">Status Pembelian</label>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic radio toggle button group">
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status0_<?php echo e($items->pembelian_status); ?>"
                                                                value="beli" autocomplete="off"
                                                                <?php echo e($items->pembelian_status == 'beli' ? 'checked' : ''); ?>>
                                                            <label class="btn btn-outline-warning"
                                                                for="status0_<?php echo e($items->pembelian_status); ?>">Beli</label>
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status1_<?php echo e($items->pembelian_status); ?>"
                                                                value="proses" autocomplete="off"
                                                                <?php echo e($items->pembelian_status == 'proses' ? 'checked' : ''); ?>>
                                                            <label class="btn btn-outline-info"
                                                                for="status1_<?php echo e($items->pembelian_status); ?>">Proses</label>
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status2_<?php echo e($items->pembelian_status); ?>"
                                                                value="selesai" autocomplete="off"
                                                                <?php echo e($items->pembelian_status == 'selesai' ? 'checked' : ''); ?>>
                                                            <label class="btn btn-outline-success"
                                                                for="status2_<?php echo e($items->pembelian_status); ?>">Selesai</label>
                                                            <input type="radio" class="btn-check" name="status"
                                                                id="status3_<?php echo e($items->pembelian_status); ?>"
                                                                value="batal" autocomplete="off"
                                                                <?php echo e($items->pembelian_status == 'batal' ? 'checked' : ''); ?>>
                                                            <label class="btn btn-outline-danger"
                                                                for="status3_<?php echo e($items->pembelian_status); ?>">Batal</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn" style="background-color: #06c3ee">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" data-bs-backdrop="static"
                                    id="deletePembelianModal_<?php echo e($items->pembelian_id); ?>" tabindex="-1"
                                    aria-labelledby="deletePembelianModalLabel_<?php echo e($items->pembelian_id); ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #06c3ee">
                                                <h1 class="modal-title fs-5"
                                                    id="deletePembelianModalLabel_<?php echo e($items->pembelian_id); ?>">
                                                    Konfirmasi Hapus</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Data yang dipilih akan dihapus? Apakah anda yakin?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak (Batal Hapus)</button>
                                                <form class="d-grid"
                                                    action="<?php echo e(route('data_pembelian.delete', ['pembelian_id' => $items->pembelian_id])); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-danger">Ya (Konfirmasi Hapus)</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($data_pembelian->links('vendor.pagination.bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="fixed-bottom p-3" style="background-color: #06c3ee">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Thrift Shop 2023</div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\.SEKOLAH\final\Project_Laravel-main\resources\views/web/data/data_pembelian.blade.php ENDPATH**/ ?>