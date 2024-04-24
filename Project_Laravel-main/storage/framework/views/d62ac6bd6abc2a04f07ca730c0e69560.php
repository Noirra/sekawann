<nav class="navbar shadow-xl" style="background-color: #06c3ee;">
    <div class="container-fluid">
        <button type="button" class="btn btn-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
            aria-controls="offcanvasScrolling">
            <i class="bi bi-list"></i>
        </button>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" style="color: white;"
            tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header" style="background-color: #06c3ee; color: white; padding: 8px">
                <h4 class="offcanvas-title" id="offcanvasScrollingLabel">
                    Admin Dashboard
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" style="background-color: #5891bd;">
                <div class="text-light">
                    <h6>MENU</h6>
                </div>
                <div class="grid gap-4 text-light">
                    <div class="p-2">
                        <a href="<?php echo e(route('dashboard')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-house-door"></i> Home</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('admin')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-speedometer"></i> Dashboard</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('kategori_pakaian')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-tags-fill"></i> Data Kategori Pakaian</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('data_pakaian')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-journal-bookmark-fill"></i> Data Pakaian</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('data_user')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-columns-gap"></i> Data User</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('data_pembelian')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-table"></i> Data Pembelian</h6>
                        </a>
                    </div>
                    <div class="p-2">
                        <a href="<?php echo e(route('login')); ?>" class="list-group-item list-group-item-action">
                            <h6><i class="bi bi-box-arrow-left"></i> Logout</h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer" style="background-color: #06c3ee; color: white;">
                <div class="grid ps-4" style="padding: 13px">
                    <h6>
                        <i class="bi bi-person-lines-fill"></i> Login Sebagai : Admin
                    </h6>
                </div>
            </div>
        </div>
        <img width="150px" src="<?php echo e(asset('img/logo.svg')); ?>">
    </div>
</nav>
<?php /**PATH D:\Sekolah\Kelas11\--NEW_TEFA_FINAL--\--FILE_FINAL_PROJECT_FULLSTACK--\Thrift_App\resources\views/layouts/nav_admin.blade.php ENDPATH**/ ?>