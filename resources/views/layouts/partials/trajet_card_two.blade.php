@if ($trajetsFestival->isEmpty())
    <div class="empty-state">
        <h2>Oups...</h2>
        <p>Il n'y a pas d'offre de trajet pour ce festival</p>
    </div>
@endif

<div class="offers-container">
    <button class="scroll-arrow scroll-left" id="scrollLeft">
        <i class="fas fa-chevron-left"></i>
    </button>
    
    <div class="offers-grid">
        @foreach ($trajetsFestival as $trajet)
            <a href="{{Route ('trajet.details', $trajet )}}" class="offer-card">
                <div class="offer-header">
                    <div class="offer-timing">
                        <span class="offer-time">{{ \Carbon\Carbon::parse($trajet->date_heure)->format('H\hi') }}</span>
                        <span class="offer-date">{{ \Carbon\Carbon::parse($trajet->date)->format('d/m/y') }}</span>
                    </div>
                    <div class="groovies-badge">
                        <i class="fas fa-star"></i>
                        <span>+{{ $trajet->groovies }}</span>
                    </div>
                </div>

                <div class="offer-main">
                    <div class="transport-type">
                        <div class="transport-icon">
                        <i class="fas fa-{{ 
                            $trajet->modeTransport->type === 'Vélo' ? 'bicycle' : 
                            ($trajet->modeTransport->type === 'Marche' ? 'walking' : 
                            ($trajet->modeTransport->type === 'Bus' ? 'bus' : 
                            ($trajet->modeTransport->type === 'Train' ? 'train' : 
                            ($trajet->modeTransport->type === 'Covoiturage' ? 'car' : 
                            ($trajet->modeTransport->type === 'Van' ? 'caravan' : 'question-circle'))))) 
                        }}">
                        </i>
                        </div>
                        <h3>{{ ucfirst($trajet->modeTransport->type) }}</h3>
                    </div>
                    
                    <div class="offer-details">
                        <div class="offer-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $trajet->lieu_depart }}</span>
                        </div>
                        @if($trajet->reduction)
                            <div class="offer-promo">
                                <i class="fas fa-ticket-alt"></i>
                                <span>-{{ $trajet->reduction }}%</span>
                            </div>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <button class="scroll-arrow scroll-right" id="scrollRight">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.offers-grid');
    const leftBtn = document.getElementById('scrollLeft');
    const rightBtn = document.getElementById('scrollRight');
    const cardWidth = 320; // Largeur d'une carte + gap

    // Fonction pour vérifier si les boutons doivent être visibles
    function updateButtons() {
        // Vérifie si on est au début
        const isAtStart = container.scrollLeft <= 0;
        // Vérifie si on est à la fin
        const isAtEnd = container.scrollLeft >= (container.scrollWidth - container.clientWidth - 10);

        // Met à jour la visibilité des boutons
        leftBtn.style.display = isAtStart ? 'none' : 'flex';
        rightBtn.style.display = isAtEnd ? 'none' : 'flex';
    }

    // Fonction de défilement
    function scrollCards(direction) {
        const currentScroll = container.scrollLeft;
        const scrollAmount = direction === 'right' ? cardWidth : -cardWidth;
        
        container.scrollTo({
            left: currentScroll + scrollAmount,
            behavior: 'smooth'
        });

        // Met à jour les boutons après le défilement
        setTimeout(updateButtons, 300);
    }

    // Gestionnaires d'événements pour les boutons
    leftBtn.addEventListener('click', function(e) {
        e.preventDefault();
        scrollCards('left');
    });

    rightBtn.addEventListener('click', function(e) {
        e.preventDefault();
        scrollCards('right');
    });

    // Gestionnaire de défilement
    container.addEventListener('scroll', function() {
        requestAnimationFrame(updateButtons);
    });

    // Gestionnaire de redimensionnement
    window.addEventListener('resize', function() {
        requestAnimationFrame(updateButtons);
    });

    // État initial des boutons
    updateButtons();
});
</script>

