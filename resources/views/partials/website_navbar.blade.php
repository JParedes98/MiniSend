<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="">
            <img src="{{ asset('/images/logo.svg') }}" alt="">
            <span class="align-middle">MiniSend</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about"><i class="fab fa-linode"></i> ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features"><i class="fas fa-mail-bulk"></i> SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact"><i class="fas fa-phone"></i> CONTACT</a>
                </li>

                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link" type="button" id="account_menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> ACCOUNT <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="account_menu">
                            @guest
                                <a class="dropdown-item" href="{{ route('login') }}">SIGN IN</a>
                                <a class="dropdown-item" href="{{ route('register') }}">SIGN UP</a>
                            @else
                                <a class="dropdown-item" href="{{ route('home') }}">DASHBOARD</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    LOGOUT
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>