<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-secondary border-2">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="navbar-brand border p-2 border-dark" href="{{ url('/') }}">
                <img src="{{ url('/svg-icons/homeIcon.JPEG') }}" class="mb-2" alt="homeIcon" />
                Keiennieuws
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-auto">
                <ul class="navbar-nav justify-items-center text-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('subscription*') ? 'active' : '' }}" aria-current="page" href="/subscription">Abonnement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="/home#contact-section-seven">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('information*') ? 'active' : '' }}" href="/information">Informatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('placepublication*') ? 'active' : '' }}" href="/placepublication">Aanleveren</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('placebooking*') ? 'active' : '' }}" href="/placebooking">Reserveren</a>
                    </li>
                    @guest
                    <li class="nav-item d-flex special-login ">
                        <a class="nav-link {{ request()->is('login*') ? 'active' : '' }}" href=" {{ route('login') }}">
                            {{ __('Inloggen/') }}
                        </a>
                        <a class="nav-link special-navlink  {{request()->is('register*') ? 'active' : '' }}" href=" {{ route('register') }}">
                            {{ __('Registreren') }}
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('login*') || request()->is('register*') ? 'active' : '' }}" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu text-center" aria-labelledby="navbarDarkDropdownMenuLink" style=" left: -3.8rem;">

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>