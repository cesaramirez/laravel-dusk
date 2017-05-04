<nav class="uk-background-primary uk-light" uk-navbar>
    <div class="uk-navbar-left">
      <a href="{{ route('home') }}" class="uk-navbar-item uk-logo">{{ config('app.name') }}</a>
    </div>
    <div class="uk-navbar-right uk-margin-right">
      @if (auth()->guest())
        <ul class="uk-navbar-nav">
          <li class="{{ request()->is('login') ? 'uk-active' : '' }}">
            <a href="{{ route('login') }}">Login</a>
          </li>
          <li class="{{ request()->is('register') ? 'uk-active' : '' }}">
            <a href="{{ route('register') }}">Register</a>
          </li>
        </ul>
      @else
        <ul class="uk-navbar-nav">
          <li>
            <a class="uk-button-link uk-link-reset">
              {{ auth()->user()->name }}
              <span class="uk-margin-small-right uk-margin-small-left" uk-icon="icon: chevron-down"></span>
            </a>
            <div class="uk-navbar-dropdown">
              <ul class="uk-nav uk-navbar-dropdown-nav">
                <li class="uk-active uk-text-center">
                  <a  class="uk-link-reset uk-text-bold"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>

              </li>
            </ul>
          </div>

        </li>
      </ul>
      @endif
    </div>
</nav>
