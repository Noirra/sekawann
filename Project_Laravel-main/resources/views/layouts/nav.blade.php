@auth
    @php $userRole = Auth::user()->user_level; @endphp
@endauth

<nav class="navbar shadow-xl navbar-expand-lg" style="background-color: #06c3ee;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><img width="150px" src="{{ asset('img/logo.svg') }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if ($userRole === 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-grid" href="{{ route('admin') }}"><button class="btn btn-light"><i
                        class="bi bi-collection"></i> Dashboard</button></a>
                    </li>
                @endif
            </ul>
            <form action="{{ route('search') }}" class="d-flex form-inline mx-auto" method="get">
                <input class="form-control mr-sm-1" type="search" name="search" placeholder="Search"
                    aria-label="Search" style="border-radius: 5px 0px 0px 5px">
                <button class="btn btn-light my-1 my-sm-0" type="submit"
                    style="border-radius:0px 5px 5px 0px">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link d-grid" href="{{ route('checkout') }}"><button class="btn btn-light"><i
                    class="bi bi-basket"></i> Cart</button></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid" href="{{ route('profil') }}"><button class="btn btn-light"><i
                    class="bi bi-person-circle"></i> Profile</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
