<?php if(auth()->guard()->check()): ?>
    <?php $userRole = Auth::user()->user_level; ?>
<?php endif; ?>

<nav class="navbar shadow-xl navbar-expand-lg" style="background-color: #8423FF;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><img width="150px" src="<?php echo e(asset('img/logo.svg')); ?>"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link d-grid" href="<?php echo e(route('admin')); ?>"><button class="btn btn-light"><i
                        class="bi bi-collection"></i> Dashboard</button></a>
                    </li>
                <?php endif; ?>
            </ul>
            <form action="<?php echo e(route('search')); ?>" class="d-flex form-inline mx-auto" method="get">
                <input class="form-control mr-sm-1" type="search" name="search" placeholder="Search"
                    aria-label="Search" style="border-radius: 5px 0px 0px 5px">
                <button class="btn btn-light my-1 my-sm-0" type="submit"
                    style="border-radius:0px 5px 5px 0px">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link d-grid" href="<?php echo e(route('checkout')); ?>"><button class="btn btn-light"><i
                    class="bi bi-basket"></i> Cart</button></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid" href="<?php echo e(route('profil')); ?>"><button class="btn btn-light"><i
                    class="bi bi-person-circle"></i> Profile</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH D:\Sekolah\Kelas11\TEFA\--FINAL_PROJECT--\Thrift_App\resources\views/layouts/nav.blade.php ENDPATH**/ ?>