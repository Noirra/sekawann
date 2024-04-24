

<?php if(auth()->guard()->check()): ?>
    <?php
        $userRole = Auth::user()->user_level;
        $user = Auth::user();
    ?>
<?php endif; ?>

<?php $__env->startSection('title', 'Checkout Pembelian'); ?>

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
    <div class="container mt-5 text-center">
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
        <?php $cart = Session::get('cart', []); ?>
        <?php if($cart): ?>
            <h3 class="text-light m-3">Data Pakaian untuk dibeli</h3>
            <div class="table-responsive">
                <form id="insert_pembelian" action="<?php echo e(route('action.create_data_pembelian')); ?>" method="post">
                    <table class="table align-middle table-bordered table-hover">
                        <thead class="align-middle text-center">
                            <tr>
                                <th>No</th>
                                <th>Pakaian</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php echo csrf_field(); ?>
                        <tbody class="table-group-divider">
                            <?php $__currentLoopData = Session::get('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $data = \App\Models\Data_Pakaian::find($items['id']); ?>
                                <tr>
                                    <input type="hidden" name="pakaian[]" value="<?php echo e($data->pakaian_id); ?>" required>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php if($data->pakaian_gambar_url === '' || $data->pakaian_gambar_url === null): ?>
                                            <img height="100px" width="100px" src="<?php echo e(asset('img/clothes.png')); ?>"
                                                alt="...">
                                        <?php else: ?>
                                            <img height="100px" width="100px"
                                                src="<?php echo e(asset('storage/pakaian/gambar/' . basename($data->pakaian_gambar_url))); ?>"
                                                alt="...">
                                        <?php endif; ?>
                                        <p><?php echo e($data->pakaian_nama); ?></p>
                                    </td>
                                    <td><?php echo e($data->pakaian_harga); ?></td>
                                    <td>
                                        <input class="w-100" style="border: none; text-align: center;" type="number"
                                            name="jumlah[]" value="<?php echo e($items['jumlah']); ?>"
                                            oninput="calculateTotal(this, <?php echo e($data->pakaian_harga); ?>, <?php echo e($loop->index); ?>)"
                                            min="1" max="<?php echo e($data->pakaian_stok); ?>" required>
                                    </td>
                                    <td>Rp. <input style="border: none; text-align: center;" type="number" name="total[]"
                                            readonly required></td>
                                    <td>
                                        <button type="button" onclick="removeItem(<?php echo e($data->pakaian_id); ?>)"
                                            class="btn btn-danger">Remove</button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="user" value="<?php echo e($user->user_id); ?>">
                            <input type="hidden" name="tanggal">
                            <input type="hidden" name="status" value="beli">
                            <tr>
                                <td colspan="6">Total Harga : Rp. <input style="border: none;" type="number"
                                        name="total_harga" id="total_harga" readonly required></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="text-light m-3">Pilih Metode Pembayaran</h3>
                    <div class="container d-flex flex-wrap justify-content-evenly">
                        <?php
                            $paymentMethods = [
                                'dana' => 'Dana',
                                'ovo' => 'OVO',
                                'bca' => 'BCA',
                                'cod' => 'COD',
                            ];
                        ?>

                        <?php
                            $ownedMethods = [];
                        ?>

                        <?php $__currentLoopData = $metode_pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->metode_pembayaran_user_id == $user->user_id): ?>
                                <?php
                                    $method = $item->metode_pembayaran_jenis;
                                    $ownedMethods[$method] = $item->metode_pembayaran_id;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(count($ownedMethods) > 0): ?>
                            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($ownedMethods[$method])): ?>
                                    <label style="width: 200px" class="card text-bg-light p-2">
                                        <img height="50px" src="<?php echo e(asset('img/' . $method . '.png')); ?>"
                                            class="mx-auto d-block" alt="...">
                                        <input class="m-2" type="radio" name="metode_pembayaran"
                                            value="<?php echo e($ownedMethods[$method]); ?>" required>
                                        <?php echo e($label); ?>

                                    </label>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-grid m-4">
                        <button type="submit" form="insert_pembelian" class="btn" style="background: #06c3ee">Simpan</button>
                    </div>
                <?php else: ?>
                    <label class="card text-bg-danger p-2">
                        <h5>Tolong tambahkan metode Pembayaran pada profil.</h5>
                    </label>
            </div>
            <div class="d-grid m-4">
                <button type="submit" form="insert_pembelian" class="btn disabled" style="background: #06c3ee">Simpan</button>
            </div>
        <?php endif; ?>
        </form>
        <script>
            function removeItem(id) {
                if (confirm("Apakah anda ingin menghapus pakaian ini?")) {
                    fetch("<?php echo e(route('cart.remove')); ?>", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-Token": "<?php echo e(csrf_token()); ?>"
                            },
                            body: JSON.stringify({
                                product_id: id
                            })
                        })
                        .then(response => {
                            window.location.reload();
                        })
                }
            }

            function calculateTotal(inputElement, harga, index) {
                var quantity = parseFloat(inputElement.value) || 0;
                var total = quantity * harga;
                var totalInput = document.getElementsByName("total[]")[index];
                totalInput.value = total;

                updateTotalHarga();
            }

            function updateTotalHarga() {
                var totalInputs = document.getElementsByName("total[]");
                var totalHargaInput = document.getElementById("total_harga");
                var sum = 0;
                for (var i = 0; i < totalInputs.length; i++) {
                    var total = parseFloat(totalInputs[i].value) || 0;
                    sum += total;
                }
                totalHargaInput.value = sum;
            }
            var jumlahInputs = document.getElementsByName("jumlah[]");
            for (var i = 0; i < jumlahInputs.length; i++) {
                calculateTotal(jumlahInputs[i], <?php echo e($data->pakaian_harga); ?>, i);
            }
            document.addEventListener("DOMContentLoaded", function() {
                var currentDate = new Date().toISOString().slice(0, 10);
                var tanggalInput = document.querySelector('input[name="tanggal"]');
                tanggalInput.value = currentDate;
            });
            window.onload = updateTotalHarga;
        </script>
    <?php else: ?>
        <h3 class=" m-3" style="color: #06c3ee">Anda tidak memiliki Pakaian untuk dibeli</h3>
        <hr />
        <h3 class="m-3" style="color: #06c3ee">Riwayat Pembelian</h3>
        <div class="table-responsive">
            <table class="table align-middle table-bordered table-hover">
                <thead class="align-middle text-center">
                    <tr>
                        <th>No</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal Pembelian</th>
                        <th>Total Harga</th>
                        <th>Status Pembelian</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $__currentLoopData = $data_pembelian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $user = \App\Models\Data_User::find($items->pembelian_user_id); ?>
                        <?php $metode = \App\Models\Metode_Pembayaran::find($items->pembelian_metode_pembayaran_id); ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($metode->metode_pembayaran_jenis); ?></td>
                            <td><?php echo e($items->pembelian_tanggal); ?></td>
                            <td>Rp. <?php echo e($items->pembelian_total_harga); ?></td>
                            <?php switch($items->pembelian_status):
                                case ('beli'): ?>
                                    <td><button type="button" class="btn btn-outline-warning btn-sm w-100">Beli</button></td>
                                <?php break; ?>

                                <?php case ('proses'): ?>
                                    <td><button type="button" class="btn btn-outline-info btn-sm w-100">Proses</button></td>
                                <?php break; ?>

                                <?php case ('selesai'): ?>
                                    <td><button type="button" class="btn btn-outline-success btn-sm w-100">Selesai</button></td>
                                <?php break; ?>

                                <?php case ('batal'): ?>
                                    <td><button type="button" class="btn btn-outline-danger btn-sm w-100">Batal</button></td>
                                <?php break; ?>

                                <?php default: ?>
                                    <td><button type="button" class="btn btn-outline-danger btn-sm w-100">Kesalahan Data</button>
                                    </td>
                                <?php break; ?>
                            <?php endswitch; ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#viewPembelianModal_<?php echo e($items->pembelian_id); ?>">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updatePembelianModal_<?php echo e($items->pembelian_id); ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <div class="modal fade" data-bs-backdrop="static"
                            id="viewPembelianModal_<?php echo e($items->pembelian_id); ?>" tabindex="-1"
                            aria-labelledby="viewPembelianModalLabel_<?php echo e($items->pembelian_id); ?>" aria-hidden="true">
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
                                                        style="background-color: #06c3ee">Jumlah :
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
                            aria-labelledby="updatePembelianModalLabel_<?php echo e($items->pembelian_id); ?>" aria-hidden="true">
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
                                            <input type="hidden" name="user" class="form-control" id="user"
                                                value="<?php echo e($items->pembelian_user_id); ?>" />
                                            <input type="hidden" name="metode_pembayaran" class="form-control"
                                                id="metode_pembayaran"
                                                value="<?php echo e($items->pembelian_metode_pembayaran_id); ?>" />
                                            <input type="hidden" name="total_harga" class="form-control"
                                                id="total_harga" value="<?php echo e($items->pembelian_total_harga); ?>" />
                                            <div class="m-2">
                                                <label for="nama" class="form-label">Tanggal Pembelian</label>
                                                <input type="date" name="tanggal" class="form-control" id="tanggal"
                                                    placeholder="Masukkan Tanggal Pembelian"
                                                    value="<?php echo e($items->pembelian_tanggal); ?>" readonly />
                                            </div>
                                            <div class="m-2 d-grid">
                                                <label for="status" class="form-label">Status Pembelian</label>
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="status"
                                                        id="status1_<?php echo e($items->pembelian_status); ?>" value="selesai"
                                                        autocomplete="off"
                                                        <?php echo e($items->pembelian_status == 'selesai' ? 'checked' : ''); ?>>
                                                    <label class="btn btn-outline-success"
                                                        for="status1_<?php echo e($items->pembelian_status); ?>">Selesai</label>
                                                    <input type="radio" class="btn-check" name="status"
                                                        id="status2_<?php echo e($items->pembelian_status); ?>" value="batal"
                                                        autocomplete="off"
                                                        <?php echo e($items->pembelian_status == 'batal' ? 'checked' : ''); ?>>
                                                    <label class="btn btn-outline-danger"
                                                        for="status2_<?php echo e($items->pembelian_status); ?>">Batal</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn" style="background: #06c3ee">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($data_pembelian->links('vendor.pagination.bootstrap-5')); ?>

        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Sekolah\Kelas11\--NEW_TEFA_FINAL--\--FILE_FINAL_PROJECT_FULLSTACK--\Thrift_App\resources\views/web/view/checkout.blade.php ENDPATH**/ ?>