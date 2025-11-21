<footer class="footer-centered section bg-gray-darker">
  <div class="shell">
    <div class="range range-sm-center">
      <div class="cell-sm-10 cell-md-8 cell-lg-6">
        <!-- Brand -->
        <a class="brand" href="{{ url('/') }}">
          <div class="brand__name">
            <img src="{{ asset('images/invertido.png') }}" alt="Logo Dreams Footer" width="237" height="35"/>
          </div>
          <span class="brand__slogan">Amamos lo Que Hacemos</span>
        </a>
        <!-- RD Mailform -->
        <form class="rd-mailform form_inline" data-form-output="form-output-global" data-form-type="subscribe" method="POST" action="{{ route('newsletter.subscribe') }}">
          @csrf
          <div class="form__inner">
            <div class="form-wrap">
              <input class="form-input" id="subscribe-form-footer-email" type="email" name="email" required>
              <label class="form-label" for="subscribe-form-footer-email">Email</label>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-button">
              <button class="button button-link" type="submit">Suscribirse</button>
            </div>
          </div>
        </form>
        <ul class="list-icons list-inline-sm">
          <li><a class="icon icon-sm fa fa-instagram icon-style-camera" href="{{ config('social.instagram_url', 'https://www.instagram.com') }}" target="_blank"><span></span><span></span><span></span><span></span></a></li> <br>
          <li><a class="icon icon-sm fa fa-facebook icon-style-camera" href="{{ config('social.facebook_url', 'https://www.facebook.com') }}" target="_blank"><span></span><span></span><span></span><span></span></a></li>
        </ul>
        <!-- Rights-->
        <p class="rights"><span>Dreams</span><span>&nbsp;&copy;&nbsp;</span><span class="copyright-year"></span>. <br class="veil-xs"><a class="link-underline" href="#">Privacy Policy</a><span> Design&nbsp;by&nbsp;<a href="#">dahiana</a></span></p>
      </div>
    </div>
  </div>
</footer>
<div class="snackbars" id="form-output-global"></div>
