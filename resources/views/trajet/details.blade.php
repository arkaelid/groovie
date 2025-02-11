@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/trajet-details.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="details-container">

    <!-- Contenu principal -->
    <div class="main-content">

        <div class="cards-layout">
            <!-- Carte principale avec map -->
            <div class="main-card">
                <!-- Section date et heure -->
                <div class="date-time-section">
                    <div class="date-col">
                        <span class="day">{{ ucfirst($trajet->date_heure->translatedFormat('l')) }}</span>
                        <div class="date">
                        <span class="number">{{ $trajet->date_heure->translatedFormat('d') }}.{{ $trajet->date_heure->translatedFormat('m') }}</span>
                        <span class="month">{{ strtoupper($trajet->date_heure->translatedFormat('M')) }}</span>
                        </div>
                    </div>
                    <div class="time-locations">
                        <div class="time-slot">
                            <span class="time">{{ $trajet->date_heure->format('H') }}h{{ $trajet->date_heure->format('i')}}</span>
                            <span class="location">{{ $trajet->lieu_depart }}</span>
                        </div>
                        <div class="time-slot">
                            <span class="time">{{ $trajet_heure_fin->format('H') }}h{{ $trajet_heure_fin->format('i')}}</span>
                            <span class="location">{{ $ville }}</span>
                        </div>
                    </div>
                </div>

                <!-- Carte map -->
                <div class="map-placeholder">
                    map
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="right-column">
                <!-- Carte titre et prix -->
                <div class="title-card">
                    <div class="title-section">
                        @if ($modeTransport->type !== 'vélo' || $modeTransport->type !== 'marche')
                            <h1>Venir en {{ $modeTransport->type }}</h1>
                        @elseif ($modeTransport->type === 'vélo')
                            <h1>Venir à {{ $modeTransport->type }}</h1>
                        @else
                            <h1>Venir à Pieds</h1>
                        @endif
                        <div class="transport-icon">
                            <img src="{{ asset('img/icons/' . ($modeTransport->type ?? 'default') . '.svg') }}" alt="Transport Icon">
                        </div>
                    </div>
                    <div class="price-section">
                        <span class="price"> {{$trajet->prix}}€</span>
                        <div class="level">
                            <span>Niveau {{$modeTransport->niveau}}</span>
                        </div>
                        <span class="groovies">+ {{ $trajet->groovies }} Groovies</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="action-cards">
                    <div class="action-card">
                        <form class="modal-form" method ="POST" action ="{{Route('trajet.enregistrer', $trajet)}}">
                            @method('POST')
                            @csrf
                            <button class="action-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/>
                                </svg>
                                Enregistrer
                            </button>
                        </form>
                        <form class="modal-form" method ="POST" action ="{{Route('trajet.reservation', $trajet)}}">
                            @method('POST')
                            @csrf
                        <button class="action-button">
                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.18176 20.3636C1.63176 20.3636 1.1611 20.168 0.769763 19.7766C0.378429 19.3853 0.182429 18.9143 0.181763 18.3636V2.36365C0.181763 1.81365 0.377763 1.34298 0.769763 0.951648C1.16176 0.560314 1.63243 0.364314 2.18176 0.363647H14.1818C14.7318 0.363647 15.2028 0.559648 15.5948 0.951648C15.9868 1.34365 16.1824 1.81431 16.1818 2.36365V18.3636C16.1818 18.9136 15.9861 19.3846 15.5948 19.7766C15.2034 20.1686 14.7324 20.3643 14.1818 20.3636H2.18176ZM2.18176 18.3636H14.1818V2.36365H12.1818V9.36365L9.68176 7.86365L7.18176 9.36365V2.36365H2.18176V18.3636Z" fill="currentColor"/>
                            </svg>
                            Réserver
                        </button>
                        </form>
                    </div>
                </div>

                <!-- Actions supplémentaires -->
                <div class="additional-actions">
                    <button class="action-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4C16.4183 4 20 7.58172 20 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M15 9L11 16L9 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Voir mon billet
                    </button>
                    <button class="action-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Ajouter à mon Agenda
                    </button>
                </div>
            </div>

            <!-- Détails du trajet -->
            <div class="details-card">
                <h2>Détails du trajet</h2>
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="label">Distance</span>
                        <div class="value">
                            <span class="number">{{ $trajet->distance }}</span>
                            <span class="unit">km</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <span class="label">Impact</span>
                        <div class="value">
                            <span class="number">{{ $trajet->empreinte_carbone }}</span>
                            <span class="unit">kg mg CO2</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <span class="label">Durée</span>
                        <div class="value">
                        <span class="number">
                        {{ $dureeInterval->format('H') }}h{{ $dureeInterval->format('i')}}
</span>



                        <span class="unit">heures</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <span class="label">Pauses</span>
                        <div class="value">
                            <span class="number">XXXX</span>
                            <span class="unit">arrêts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 