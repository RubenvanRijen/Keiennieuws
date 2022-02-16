<nav class="custom-navbar-normal navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/home') }}"> <img src="{{url('/svg-icons/homeIcon.png')}}" alt="homeIcon" />
    </a>
    <div class="normal-menu mr-auto">
        <div class="row">
            <button class="navbar-toggler-custom">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="custom-navbar-slider" class="slide-in from-left">
                <div class="navbar-links collapse navbar-collapse slide-in-content">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/subscription') }}">Abonnementen <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/home#volunteer-carousel') }}">Contact<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/information') }}">Informatie<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/home#count_down') }}">Aanleveren<span class="sr-only"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest

        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                @if(auth()->user()->hasRole('admin'))
                <a class="dropdown-item" href="{{ url('/cms') }}">CMS</a>
                @endif

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</nav>

<nav class="custom-navbar-mobile navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/home') }}"> <img src="{{url('/svg-icons/homeIcon.png')}}" alt="homeIcon" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-links collapse navbar-collapse text-center " id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/subscription') }}">Abonnementen <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home#volunteer-carousel') }}">Contact<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/information') }}">Informatie<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home#count_down') }}">Aanleveren<span class="sr-only"></span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest

            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    @if(auth()->user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ url('/cms') }}">CMS</a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>