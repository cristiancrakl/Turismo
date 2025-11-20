<!-- Custom Topbar -->
<nav class="custom-navbar">
    <div class="navbar-content">
        <!-- Left side navigation links -->
        <div class="navbar-left">
            <a href="{{ url('dashboard') }}" class="nav-link">Home</a>
            <a href="{{ route('contactanos') }}" class="nav-link">Contactanos</a>
            <a href="{{ route('about') }}" class="nav-link">About Us</a>
            <a href="#" class="nav-link">Booking</a>
            <a href="#" class="nav-link">FAQ</a>
        </div>

        <!-- Right side user panel -->
        <div class="navbar-right">
            <div class="user-info">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="user-avatar" alt="User Image">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <a href="{{ route('interests.settings') }}" class="settings-btn" title="Configurar Gustos">
                    <i class="fas fa-heart"></i>
                </a>
                <button class="logout-btn"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    title="Cerrar Sesión">
                    <i class="fas fa-power-off"></i>
                </button>
            </div>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                @csrf
            </form>
        </div>
    </div>
</nav>
<!-- /.custom-navbar -->