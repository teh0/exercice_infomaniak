<header class="app-header">
    <div class="app-header-container app-wrapper">
        <a href="{{ route('home') }}"><img src="{{ asset('img/logo_borrowell.svg') }}" alt="logo Borrowell"></a>

        <!-- User is guest -->
        @guest
        <div data-auth="guest" class="link-container">
            <a class="link-login" href="{{ route('login') }}">Login</a>
            <a class="link-register" href="{{ route('register') }}">Register</a>
        </div>
        @endguest

        <!-- User is auth with role user -->
        @auth
        @if((Auth::user()->role)=="user")
        <div data-auth="user" class="link-container">
            <a class="link-logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
        <a class="link-profile" href="{{ route('profile') }}">Mon profil</a>
            <div class="img-profile-container"><img src="{{ asset('upload/'.Auth::user()->avatar) }}" alt=""></div>
        </div>
        @endif
        @endauth

        <!-- User is auth with role admin -->
        @auth
        @if((Auth::user()->role)=="admin")
        <div data-auth="admin" class="link-container">
            <a class="link-logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
            <a class="link-profile" href="">Mon profil</a>
            <a class="link-backoffice" href="">Backoffice</a>
            <div class="img-profile-container"><img src="{{ asset('upload/'.Auth::user()->avatar) }}" alt=""></div>
        </div>
        @endif
        @endauth
    </div>

    <!-- Form to disconnect Auth users -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</header>