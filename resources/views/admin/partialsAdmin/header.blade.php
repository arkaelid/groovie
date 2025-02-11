<nav class="top-nav">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <img src="{{ asset('img/groovielogobleu.png') }}" alt="Groovie Logo" class="brand-logo">
            <span class="brand-name">Groovie</span>
        </a>
        <a href="{{Route('admin.actualites')}}">Les Actualités</a>
    </div>
    <div class="nav-right">
        <div class="nav-item">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-button">Déconnexion</button>
            </form>
        </div>
    </div>
</nav> 