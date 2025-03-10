<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2c3e50;">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('logo.png') }}" alt="MyHealthQR Logo" height="40" class="rounded-circle me-2">
            MyHealthQR
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('user.profile') }}">Personal Info</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('medical.info') }}">Medical Info</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('logs') }}">Logs</a>
                </li>
                <li class="nav-item mx-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light rounded-pill px-3">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
