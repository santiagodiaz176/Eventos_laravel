<header class="section page-header">
  <!-- RD Navbar-->
  <div class="rd-navbar-wrap">
    <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-static" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="5px" data-lg-stick-up-offset="5px" data-md-stick-up="true" data-lg-stick-up="true">
      <div class="rd-navbar-main-outer">
        <div class="rd-navbar-main">
          <!-- RD Navbar Panel-->
          <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
            <!-- RD Navbar Brand-->
            <div class="rd-navbar-brand">
              <a class="brand" href="{{ url('/') }}">
                <div class="brand__name">
                  <img class="brand__logo-dark" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="237" height="35"/>
                  <img class="brand__logo-light" src="{{ asset('images/DDDD.png') }}" alt="Logo Dreams" width="237" height="35"/>
                </div>
                <span class="brand__slogan">Amamos lo que hacemos</span>
              </a>
            </div>
          </div>
          <!-- RD Navbar Nav-->
          <div class="rd-navbar-nav-wrap">
            <div class="rd-navbar-element">
              <a href="{{ route('login') }}"
                  class="button button-sm button-primary"
                  style="background-color:#1e90ff;border-color:#1e90ff;">
                  Iniciar sesión
              </a>
            </div>

            <!-- RD Navbar Nav-->
            <ul class="rd-navbar-nav">
              <li class="{{ Request::is('/') ? 'active' : '' }}">
                  <a href="{{ url('/') }}">Inicio<span></span><span></span><span></span><span></span></a>
              </li>
              <li class="{{ Request::is('somos') ? 'active' : '' }}">
                  <a href="{{ url('somos') }}">Quienes Somos<span></span><span></span><span></span><span></span></a>
              </li>
              <li class="{{ Request::is('servicios') ? 'active' : '' }}">
                  <a href="{{ url('servicios') }}">Servicios<span></span><span></span><span></span><span></span></a>
              </li>
              <li class="{{ Request::is('contacto') ? 'active' : '' }}">
                  <a href="{{ url('contacto') }}">Contáctenos<span></span><span></span><span></span><span></span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
