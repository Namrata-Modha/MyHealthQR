<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <!-- Logo & Branding -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" class="rounded-circle" alt="MyHealthQR Logo" style="height: 40px; width: 40px; object-fit: contain;">
            <span class="ms-2 fw-bold fs-5">MyHealthQR</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">Personal Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('medical-info') ? 'active' : '' }}" href="{{ route('medical.info') }}">Medical Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('logs') ? 'active' : '' }}" href="{{ route('logs') }}">Logs</a>
                </li>
                <!-- Logout -->
                <li class="nav-item ms-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light rounded-pill">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
