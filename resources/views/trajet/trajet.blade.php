@extends('layouts.app')

@section('title', 'Groovie - Voyages')

@section('css')
    <link href="{{ asset('css/trajet.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="cards-container">
    <div id="trajets-card" class="card" data-index="1">
        <div class="card-header">
            <div class="card-title">
                <img src="{{ asset('img/icons/mestrajets.svg') }}" alt="Mes Trajets" class="card-icon">
                <span>Mes Trajets</span>
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier" class="card-arrow">
            </div>
            @if(session('error'))
            {{ session('error') }}                
            @endif
            @if(session('success'))
            {{ session('success') }}                
            @endif
            @if ($festivalDefaut)
            <div class="festival-select-container">
                <label for="festival-select">Sélectionner un festival :</label>
                <select id="festival-select">
                    @foreach ($festivals as $festival)
                        <option value="{{ $festival->slug }}" 
                                id="festival-{{ $festival->id }}"
                                data-festival="{{ json_encode($festival) }}"
                                @if($festival->slug == $festivalDefaut->slug) selected @endif>
                            {{ $festival->nom_festival }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="header-separator"></div>
        </div>
        <div class="card-content">
            <div class="trajets-tabs">
                <button class="trajet-tab" data-type="reserve">
                    <!-- <i class="fas fa-check-circle"></i> -->
                    <span class>{{$trajetsReservesCount}}</span>
                    Réservés
                </button>
                <button class="trajet-tab" data-type="enregistre">
                        <span>{{$trajetsEnregistresCount}}</span>
                    Enregistrés
                </button>
            </div>
            @endif
            @if (!$festivalDefaut)            
                <div class="empty-state">
                    <h2>Oups...</h2>
                    <p>Tu n'as pas de festival validé</p>
                    <a href="{{ Route('home') }}">
                        <button class="empty-state-button">
                            Réserver un festival
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </a>
                </div>
            @endif

            <!-- Div pour afficher la liste des trajets -->
            <div class="trajets-list" id="trajets-list">
                @include('layouts.partials.trajet_card')
            </div>
            
            
        </div>
    </div>

    <div id="offres-card" class="card" data-index="2">
        <div class="card-header">
            <div class="card-title">
                <img src="{{ asset('img/icons/offresdispos.svg') }}" alt="Offres" class="card-icon">
                <span>Les Offres Disponibles</span>
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier" class="card-arrow">
            </div>
            <div class="header-separator"></div>
        </div>
        <div class="card-content">
            <div class="filter-group">
                <button class="filter-button" data-action="filter">Filtrer</button>
            </div>

            <div class="offres-filters">
                <div class="toggle-filters">
                    <div class="toggle-filter">
                        <span>Départ imminent</span>
                        <label class="toggle-slider">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="toggle-filter">
                        <span>Places disponibles</span>
                        <label class="toggle-slider">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="toggle-filter">
                        <span>Mes trajets favoris</span>
                        <label class="toggle-slider">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="offers-section">
                <div class="section-header">
                    <h3>Les Offres de trajets</h3>
                </div>
            <div class="offers-grid" id="offers-grid">
                @include('layouts.partials.trajet_card_two')
            </div>
            </div>
        </div>
    </div>

    <div id="preferences-card" class="card" data-index="3">
        <div class="card-header">
            <div class="card-title">
                <img src="{{ asset('img/icons/preferences.svg') }}" alt="Préférences" class="card-icon">
                <span>Préférences</span>
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier" class="card-arrow">
            </div>
            <div class="header-separator"></div>
        </div>
        <div class="card-content">
            <form class="preferences-form">
                <div class="preference-group">
                    <label>Ville de départ</label>
                    <input type="text" placeholder="Blois" value="Blois">
                    <div class="separator"></div>
                </div>
                <div class="preference-group">
                    <div class="date-group">
                        <div class="date-input">
                            <label>Y aller le ...</label>
                            <select>
                                <option>Mardi 13 Juillet</option>
                            </select>
                        </div>
                        <div class="date-input">
                            <label>Rentrer le ...</label>
                            <select>
                                <option>Mardi 15 Juillet</option>
                            </select>
                        </div>
                    </div>
                    <div class="separator"></div>
                </div>
                <div class="preference-group">
                    <label>Je préfère...</label>
                    <div class="transport-options">
                        <div class="transport-option">
                            <i class="fas fa-car"></i>
                            <span>Covoit.</span>
                        </div>
                        <div class="transport-option">
                            <i class="fas fa-bicycle"></i>
                            <span>Vélo</span>
                        </div>
                        <div class="transport-option">
                            <i class="fas fa-van-shuttle"></i>
                            <span>Van</span>
                        </div>
                        <div class="transport-option">
                            <i class="fas fa-bus"></i>
                            <span>Bus</span>
                        </div>
                        <div class="transport-option">
                            <i class="fas fa-train"></i>
                            <span>Train</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/voyages.js') }}"></script>
<script>
    
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const currentTop = document.querySelector('.card[data-index="1"]');
            const clickedIndex = card.getAttribute('data-index');
            
            if (clickedIndex !== "1") {
                currentTop.setAttribute('data-index', clickedIndex);
                card.setAttribute('data-index', "1");
            }
        });
    });

    const filterButton = document.querySelector('.filter-button[data-action="filter"]');
    const filtersContainer = document.querySelector('.offres-filters');

    filterButton.addEventListener('click', function(e) {
        e.stopPropagation();
        filtersContainer.classList.toggle('show');
    });

    document.addEventListener('click', function() {
        filtersContainer.classList.remove('show');
    });

    filtersContainer.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endsection 