<!-- Navbar start -->
<div class="container-fluid nav-bar">
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg py-4">
            <a href="dashboard" class="navbar-brand">
                <h1 class="text-primary fw-bold mb-0"><span class="text-primary">Career</span><span
                        class="text-dark">Catalyst</span></h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="dashboard" class="nav-item nav-link">Home</a>
                    <a href="about" class="nav-item nav-link">About</a>
                    <a href="services" class="nav-item nav-link">Services</a>
                    <a href="contact" class="nav-item nav-link">Contact</a>
                </div>
                @auth
                    <div class="profile-info">
                        <span class="text-secondary me-3">Welcome, <span
                                class="text-primary fw-bold">{{ Auth::user()->name }}</span></span>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary me-3">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="login" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Login</a>
                @endauth
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
