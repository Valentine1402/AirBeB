<div class="my_nav">
  <div class="nav_item">

    <div class="navbar-left">
        <a href="{{ route('home') }}"><img src="/img/logo.png" alt="logo"></a>
    </div>
    <div class="navbar-right">
      <ul class="menu">
        <li><a href="{{ route('apartment-register') }}">Offri una casa</a></li>
        @guest
          @if(Request::path() === 'login' || Request::path() == 'register')
            <li><a href="{{route('register')}}" id="register">Registrati</a></li>
            <li><a href="{{route('login')}}" id="login">Accedi</a></li>
          @else
            <li><span id="register">Registrati</a></li>
            <li><span id="login">Accedi</a></li>
          @endif
        @else
          <li><a href="{{ route('user-apartments', Auth::id()) }}">I miei appartamenti</a></li>
          <li><a href="{{ route('user-messages', Auth::id()) }}">Messaggi</a></li>
          <li class="user-avatar">
            <a href="{{route('user-info', Auth::id())}}">
            <img src="{{Storage::url(Auth::user() -> avatar)}}" alt="" width="45" height="45" title="Ciao {{ Auth::user() -> name }}, clicca qui per cambiare il tuo avatar!">
            </a>
          </li>
            <li>
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Logout
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endguest
      </ul>
      <div class="dropdown-menu">
        <i class="fas fa-bars toggle-dropdown"></i>
        <i class="fas fa-times toggle-dropdown hide"></i>
        <div class="dropdown-content hide">
          <ul class="menu">
            <li><a href="{{ route('apartment-register') }}">Offri una casa</a></li>
            @guest
              <li><a href="{{ route('register') }}">Registrati</a></li>
              <li><a href="{{ route('login') }}">Accedi</a></li>
            @else
              <li><a href="{{ route('user-apartments', Auth::id()) }}">I miei appartamenti</a></li>
              <li><a href="{{ route('user-messages', Auth::id()) }}">Messaggi</a></li>
              <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout
              </a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            @endguest
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
