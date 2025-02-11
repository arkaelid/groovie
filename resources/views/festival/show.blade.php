@extends('layouts.app')

@section('title', 'Groovie - ' . $festival['nom'])

@section('css')
    <link href="{{ asset('css/festival.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/festival.js') }}"></script>
@endsection

@section('content')
<div class="page-container">
    <main class="main-content">
        <div class="festival-header">
            @if (session('successbillet'))
                {{ session('successbillet')}}
            @endif
            @if (session('errorBillet'))
                {{ session('errorBillet')}}
            @endif
            <h1>{{ $festival['nom_festival'] }}</h1>
            <a href="{{ route('home') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Retour
            </a>
        </div>

        <div class="festival-grid">
            <div class="festival-main">
                <div class="festival-info">
                    <h2>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Du {{ $festival->date_heure_debut->translatedFormat('d') }} au {{ $festival->date_heure_fin->translatedFormat('d F Y') }}
                    </h2>
                    <div class="flyer-container">
                        <img src="{{ asset('img/' . $festival->image_festival) }}" alt="Flyer {{ $festival['nom'] }}">
                        <button class="view-program-btn">Voir la programmation</button>
                    </div>
                </div>
            </div>

            <aside class="festival-sidebar">
                <div class="dernieres-actualites">
                    <div class="news-header">
                        <h2>Dernières actualités</h2>
                        <div class="news-nav">
                            <button class="nav-arrow" data-direction="prev">←</button>
                            <button class="nav-arrow" data-direction="next">→</button>
                        </div>
                    </div>
                    <p class="news-subtitle">Toutes les dernières actualités du festival <strong>{{ $festival['nom_festival'] }}</strong></p>
                    <div class="actualites-list">
                    @isset($eventData)
                        <div class="actualite-item">
                            <h4>{{ $eventData['name']['text'] }}</h4>
                            <p>{{ $eventData['description']['text'] }}</p>
                        </div>
                    @endisset
                    </div>
                </div>

                <div class="info-section">
                    <div class="info-card">
                        <h3>Infos</h3>
                        <div class="info-details">
                            <p>Du {{ $festival->date_heure_debut->translatedFormat('d') }} au {{ $festival->date_heure_fin->translatedFormat('d F Y') }}</p>
                            <p>{{ $festival['lieu_festival'] }}</p>
                            <p>{{ $festival['prix'] }} €</p>
                        </div>
                    </div>

                    <div class="ticket-card">
                        <h3>Ouverture de la billetterie</h3>
                        <div class="ticket-actions">

                            <button class="buy-button" onclick="window.location.href='{{ $festival['lien'] }}'">
                                Acheter
                            </button>
                            <a href="#" value ="{{ $festival}} " class="nav-link ticket-link" onclick="document.querySelector('.ticket-modal').classList.add('active'); return false;">
                                Valider
                            </a> 
                        </div>
                        
                    </div>
                </div>
            </aside>
        </div>
    </main>
</div>
 <!-- Ticket Modal -->
 <div class="ticket-modal" id="ticketModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="modal-header">
                <h3>INFORMATIONS BILLET :</h3>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    <a>{{ session('error') }}</a>
                </div>
            @endif
            <form class="modal-form" method="POST" action="{{ route('festival.billet.add', $festival) }}">
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
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>
                <div class="form-group">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a10 10 0 0 0-7.743 16.33l-1.964 1.963A1 1 0 0 0 3 22h3.1a10 10 0 1 0 5.9-20zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </span>
                    <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" placeholder="Date" required>
                            @error('date')
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
            </form>
            <a href="#" class="modal-signup-link">Pas encore de compte ? Inscrivez vous</a>
        </div>
    </div>
@endsection 