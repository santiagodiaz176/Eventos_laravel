<header class="section page-header">
  <!-- RD Navbar -->
  <div class="rd-navbar-wrap">
    <nav class="rd-navbar"
      data-layout="rd-navbar-fixed"
      data-sm-layout="rd-navbar-fixed"
      data-sm-device-layout="rd-navbar-fixed"
      data-md-layout="rd-navbar-static"
      data-md-device-layout="rd-navbar-fixed"
      data-lg-device-layout="rd-navbar-static"
      data-lg-layout="rd-navbar-static"
      data-stick-up-clone="false"
      data-md-stick-up-offset="5px"
      data-lg-stick-up-offset="5px"
      data-md-stick-up="true"
      data-lg-stick-up="true">

      <div class="rd-navbar-main-outer">
        <div class="rd-navbar-main">

          <!-- Panel -->
          <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
              <span></span>
            </button>

            <!-- Logo -->
            <div class="rd-navbar-brand">
              <a class="brand" href="{{ route('usuario') }}">
                <div class="brand__name">
                  <img class="brand__logo-dark"
                       src="{{ asset('images/DDDD.png') }}"
                       alt="Logo Dreams"
                       width="237" height="35"/>
                  <img class="brand__logo-light"
                       src="{{ asset('images/DDDD.png') }}"
                       alt="Logo Dreams"
                       width="237" height="35"/>
                </div>
                <span class="brand__slogan">Amamos lo que hacemos</span>
              </a>
            </div>
          </div>

          <!-- Menu -->
          <div class="rd-navbar-nav-wrap">

            <!-- Redes + Cerrar sesión -->
            <div class="rd-navbar-element">
              <ul class="list-icons list-inline-sm">
                <li>
                  <a class="icon icon-sm fa fa-sign-out icon-style-camera"
                     href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     Cerrar sesión
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>

            <!-- Links -->
            <ul class="rd-navbar-nav">
              <li class="{{ Request::is('usuario/eventos') ? 'active' : '' }}">
                <a href="{{ route('eventos.index') }}">
                  Eventos<span></span><span></span><span></span><span></span>

              <li class="{{ Request::is('usuario') ? 'active' : '' }}">
                <a href="{{ route('usuario') }}">
                  Inicio<span></span><span></span><span></span><span></span>
                </a>
              </li>

              <li class="{{ Request::is('usuario/somos') ? 'active' : '' }}">
                <a href="{{ route('usuario.somos') }}">
                  Quienes Somos<span></span><span></span><span></span><span></span>
                </a>
              </li>

              <li class="{{ Request::is('usuario/servicios') ? 'active' : '' }}">
                <a href="{{ route('usuario.servicios') }}">
                  Servicios<span></span><span></span><span></span><span></span>
                </a>
              </li>
            </ul>

          </div>

        </div>
      </div>
    </nav>
  </div>
</header>
