<!-- Navigation-->
<nav style="background-color: black !important;" class="navbar navbar-expand-lg navbar-dark static-top py-3">
    <div class="container">
        <a href="/" class="navbar-brand">HikingYuk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                @if(auth()->user())
                <li class="nav-item mx-3">
                    <a class="nav-link" href="/dashboard/cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $Carts->where('user_id', auth()->user()->id)->count() }}
                        </span>
                    </a>
                </li>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->username }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <a href="/login" class="btn-custom-light px-3 py-1">Login</a>
                @endif
            </ul>
        </div>
    </div>
</nav>