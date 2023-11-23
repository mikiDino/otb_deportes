<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" data-module="Dashboard">
                    Dashboard
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('categorias') ? 'active' : '' }}" href="/categorias" data-module="Categorías">
                    Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('equipos') ? 'active' : '' }}" href="/equipos" data-module="Equipos">
                    Equipos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('jugadores') ? 'active' : '' }}" href="/jugadores" data-module="Jugadores">
                    Jugadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('fixture') ? 'active' : '' }}" href="/fixture" data-module="Fixture">
                    Fixture
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('reportes') ? 'active' : '' }}" href="/reportes" data-module="Reportes">
                    Reportes
                </a>
            </li> --}}
            <!-- Agrega más enlaces a tus módulos aquí -->
        </ul>
    </div>
</nav>
