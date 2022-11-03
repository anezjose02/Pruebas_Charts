@php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))

@if (config('adminlte.use_route_url', false))
    @php($logout_url = $logout_url ? route($logout_url) : '')
@else
    @php($logout_url = $logout_url ? url($logout_url) : '')
@endif

<li class="dropdown">
    <a class="nav-link dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="far fa-envelope"></i>
        <span class="contain-badge">
            <span class="badge bg-danger">2</span>
        </span>
    </a>


    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item disabled" href="#"> Mensajes</a></li>
    </ul>
</li>

<li class="dropdown">
    <a class="nav-link dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="contain-badge">
            <span class="badge bg-warning">10</span>
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item disabled" href="#"> Notificaciones</a></li>
    </ul>
</li>

<li class="dropdown">
    <a class="nav-link dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="#"> <i class="fas fa-user"></i> {{Auth::user()->name}} </a></li>

        {{-- <li><a class="dropdown-item disabled" href="#"> <i class="fas fa-user-cog"></i> Perfil</a></li> --}}
        <li><a class="dropdown-item" href="/temas"> <i class="fas fa-palette"></i> Temas - colores</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="">
            <a class="dropdown-item" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i>
                Cerrar sesión
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if (config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>