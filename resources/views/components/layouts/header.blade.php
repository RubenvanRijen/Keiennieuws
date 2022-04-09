<nav class="navbar navbar-expand-md navbar-light bg-light border-bottom border-secondary border-2">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="navbar-brand border p-2 border-dark" href="{{ url('/') }}">
                <img src="{{ url('/svg-icons/homeIcon.JPEG') }}" class="mb-2" alt="homeIcon" />
                Keiennieuws
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-auto">
                <ul class="navbar-nav justify-items-center text-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('subscription*') ? 'active' : '' }}" aria-current="page"
                            href="/subscription">Abonnement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}"
                            href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('information*') ? 'active' : '' }}"
                            href="/information">Informatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('publication*') ? 'active' : '' }}"
                            href="/publication">Aanleveren</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
