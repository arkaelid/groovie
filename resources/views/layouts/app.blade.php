<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Groovie')</title>
    <link rel="icon" href="{{ asset('img/logobleujaune.png') }}">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        @include('layouts.partials.header')
    </header>

    <!-- Modification de la navbar -->
    <nav class="side-nav">
        <a href="{{ route('trajet') }}" class="nav-item {{ request()->routeIs('trajet') ? 'active' : '' }}">
            <img src="{{ asset('img/icons/train.svg') }}" alt="Train">
            <span>Trajet</span>
        </a>
        <a href="{{ route('experience') }}" class="nav-item {{ request()->routeIs('experience') ? 'active' : '' }}">
            <img src="{{ asset('img/icons/ticket.svg') }}" alt="Experience">
            <span>Experience</span>
        </a>
        <a href="{{ route('groovie') }}" class="nav-item {{ request()->routeIs('groovie') ? 'active' : '' }}">
            <img src="{{ asset('img/icons/seedling.svg') }}" alt="Groovie">
            <span>Groovie</span>
        </a>
    </nav>

    <main>
        @yield('content')
            <!-- Modale pour le code billet -->
    <div class="ticket-modal" id="ticketModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="modal-header">
                <h3>INFORMATIONS BILLET :</h3>
                @if (session('successbillet'))
                    {{ session('successbillet')}}
                @endif
                @if (session('errorBillet'))
                    {{ session('errorBillet')}}
                @endif
            </div>
            <form class="modal-form" method ="POST" action ="{{Route('festival.billet.add.two')}}">
            @method('POST')
                @csrf
                <div class="form-group">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <path d="M22 6l-10 7L2 6"/>
                        </svg>
                    </span>
                    <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Code Billet" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                    <span class="input-icon">
                    <svg width="18" height="18" viewBox="0 0 30 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.0018 22.5V20.0998C20.0018 18.8266 19.4961 17.6056 18.5958 16.7053C17.6955 15.8051 16.4745 15.2993 15.2013 15.2993H6.80048C5.52732 15.2993 4.30629 15.8051 3.40603 16.7053C2.50576 17.6056 2 18.8266 2 20.0998V22.5" stroke="#010F5C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.0009 11.601C13.6522 11.601 15.8014 9.45172 15.8014 6.80048C15.8014 4.14925 13.6522 2 11.0009 2C8.34969 2 6.20044 4.14925 6.20044 6.80048C6.20044 9.45172 8.34969 11.601 11.0009 11.601Z" stroke="#010F5C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.8023 6.89841V14.0991" stroke="#010F5C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M28.4027 10.4987H21.202" stroke="#010F5C" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>


                    </span>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Adresse email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                
                </div>
                <button type="submit" class="modal-submit">Valider le billet</button>
                <a href="#" class="modal-signup-link">Pas encore de compte ? Inscrivez vous</a>
            </form>
        </div>
    </div>
    </main>

    <footer>
        @include('layouts.partials.footer')
    </footer>

   

    <!-- Scripts -->
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
    <script src="{{ asset('js/festival-card.js') }}"></script>
    @yield('scripts')

</body>
</html> 