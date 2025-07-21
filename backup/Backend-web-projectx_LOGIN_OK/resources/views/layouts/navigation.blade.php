<nav class="main-nav">
    <div class="nav-container">
        <div class="nav-content">
            <div class="nav-left">
                <!-- Logo -->
                <div class="nav-logo">
                    <a href="{{ route('dashboard') }}">
                        <span class="logo-text">📚 BookShop</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('start') }}" class="nav-link">Inicio</a>
                    <a href="{{ route('profiel') }}" class="nav-link">Perfil</a>
                    <a href="{{ route('addBook') }}" class="nav-link">Agregar Libro</a>
                </div>
            </div>

            <!-- User Menu -->
            <div class="nav-user">
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-email">{{ Auth::user()->email }}</span>
                </div>
                
                <div class="user-actions">
                    <a href="{{ route('profile.edit') }}" class="btn-profile">Mi Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="btn-logout">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>