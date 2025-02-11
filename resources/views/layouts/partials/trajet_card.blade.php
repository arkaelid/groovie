@if ($festivalDefaut && $trajetsUtilisateur->isEmpty())
    <div class="empty-state">
        <h2>Oups...</h2>
        @if($type ==='reserve')
        <p>Tu n'as pas encore de trajet réservé pour ce festival</p>
        @else
        <p>Tu n'as pas encore de trajet enregistré pour ce festival</p>
        @endif
        <button class="empty-state-button">
            Découvrir les trajets disponibles
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
@endif

@foreach ($trajetsUtilisateur as $trajet)
    <a href="{{ Route('trajet.details', $trajet) }}" class="trajet-card">
        <div class="trajet-content">
            <!-- En-tête avec J-X et date -->
            <div class="trajet-header">
                <div class="trajet-timing">
                    <span class="countdown">J-{{ \Carbon\Carbon::parse($trajet->date)->diffInDays(now()) }}</span>
                    <span class="date">{{ \Carbon\Carbon::parse($trajet->date)->format('d/m/y') }}</span>
                </div>
            </div>

            <!-- Titre et lieu -->
            <div class="trajet-main">
                <h2 class="title">
                    Départ - {{ \Carbon\Carbon::parse($trajet->date_heure)->format('H\hi') }}
                </h2>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $trajet->lieu_depart ?? 'Guerin' }}
                </div>
            </div>

            <!-- Infos supplémentaires -->
            <div class="trajet-info">
                <div class="transport-badge">
                <i class="fas fa-{{ 
                    $trajet->modeTransport->type === 'Vélo' ? 'bicycle' : 
                    ($trajet->modeTransport->type === 'Marche' ? 'walking' : 
                    ($trajet->modeTransport->type === 'Bus' ? 'bus' : 
                    ($trajet->modeTransport->type === 'Train' ? 'train' : 
                    ($trajet->modeTransport->type === 'Covoiturage' ? 'car' : 
                    ($trajet->modeTransport->type === 'Van' ? 'caravan' : 'question-circle'))))) 
                }}">
                </i>
                    <span>{{ $trajet->modeTransport->type }}</span>
                </div>
                <div class="groovies-badge">
                    <i class="fas fa-star"></i>
                    <span>+{{ $trajet->groovies }} Groovies</span>
                </div>
            </div>
        </div>
    </a>
@endforeach