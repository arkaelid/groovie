@extends('layouts.app')

@section('title', 'Groovie - Accueil')

@section('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="app-container">
        <div class="content-grid">
            <!-- Colonne gauche -->
            <div class="card concept-card">
                <div class="concept-navigation">
                    <button class="concept-nav-arrow prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                    <button class="concept-nav-arrow next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                </div>
                <div class="concept-slides">
                    <div class="concept-slide active" data-slide="1">
                        <div class="concept-content">
                            <div class="concept-logo">
                                <img src="{{ asset('img/logobleujaune.png') }}" alt="Groovie Logo" class="logo">
                            </div>
                            <div class="concept-text">
                                <h2>Le concept Groovie</h2>
                                <p class="concept-intro">Vivez vos festivals autrement en devenant acteur du changement.</p>
                                <p class="concept-description">Groovie récompense chacune de vos actions éco-responsables pendant les festivals avec un système de points.</p>
                                <p class="highlight">Active l'expérience de la mobilité durable</p>
                            </div>
                        </div>
                    </div>
                    <div class="concept-slide" data-slide="2">
                        <div class="concept-content">
                            <h2>Comment ça marche ?</h2>
                            <div class="levels">
                                <div class="level">
                                    <span class="level-number">1</span>
                                    <div class="level-info">
                                        <h3>Niveau 1</h3>
                                        <p>Pour commencer doucement</p>
                                    </div>
                                </div>
                                <div class="level">
                                    <span class="level-number">2</span>
                                    <div class="level-info">
                                        <h3>Niveau 2</h3>
                                        <p>Pour intensifier les résultats, nous aussi faisons un geste</p>
                                    </div>
                                </div>
                                <div class="level">
                                    <span class="level-number">3</span>
                                    <div class="level-info">
                                        <h3>Niveau 3</h3>
                                        <p>Pour un maximum d'efforts et un faible impact, de grandes réductions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="right-section">
                <div class="actualites-wrapper">
                    <div class="actualites-header">
                        <h2>ACTUALITÉS GROOVIE</h2>
                        <div class="header-navigation">
                            <button class="nav-arrow prev">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </button>
                            <button class="nav-arrow next">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="actualites">
                    @foreach ($actualites as $actualite)
                        <div class="actualite-item active">
                            <div class="actualite-image">
                                <img src="{{ asset('storage/' . $actualite->image)  }}" alt="{{ $actualite->nom }}">
                            </div>
                            <div class="actualite-content">
                                <span class="actualite-tag">{{ $actualite->type }}</span>
                                <h3 class="actualite-title">{{ $actualite->nom }}</h3>
                                <p class="actualite-description">{{ $actualite->descriptif }}</p>
                            </div>
                        </div>
                    @endforeach
                        <!-- <div class="actualite-item active">
                            <div class="actualite-image">
                                <img src="{{ asset('img/solidays.jpg') }}" alt="Solidays Festival">
                            </div>
                            <div class="actualite-content">
                                <span class="actualite-tag">Événement</span>
                                <h3 class="actualite-title">Solidays 2024 : Les inscriptions sont ouvertes</h3>
                                <p class="actualite-description">Rejoignez l'aventure Groovie pour Solidays 2024</p>
                            </div>
                        </div>
                        <div class="actualite-item">
                            <div class="actualite-image">
                                <img src="{{ asset('img/festival.jpg') }}" alt="Nouveaux Festivals">
                            </div>
                            <div class="actualite-content">
                                <span class="actualite-tag">Nouveauté</span>
                                <h3 class="actualite-title">10 nouveaux festivals partenaires</h3>
                                <p class="actualite-description">Découvrez les nouveaux festivals qui rejoignent l'aventure en 2024</p>
                            </div>
                        </div>
                        <div class="actualite-item">
                            <div class="actualite-image">
                                <img src="{{ asset('img/grooApp.png') }}" alt="Application Groovie">
                            </div>
                            <div class="actualite-content">
                                <span class="actualite-tag">Application</span>
                                <h3 class="actualite-title">Nouvelle mise à jour de l'app</h3>
                                <p class="actualite-description">De nouvelles fonctionnalités pour améliorer votre expérience</p>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="small-cards">
                    <div class="card festivals-card">
                        <div class="festivals-counter">
                            <p>20 000 Groovers en 2024</p>
                        </div>
                    </div>
                    @if (session('billet'))
                    <div class="card billet-card">
                        <h2>Un billet est enregistré. Veuillez vous connecter pour le valider.</h2>
                        <button class="ticket-button" data-ticket-modal disabled>
                            Taper le code
                        </button>
                    </div>
                    @else
                    <div class="card billet-card">
                        <h2>DÉJÀ UN BILLET ?</h2>
                        <button class="ticket-button" data-ticket-modal>
                            Taper le code
                        </button>
                    </div>
                    @endif

                    <div class="card communaute-card">
                        <h2>Ouverture de la billetterie Festival Terre du Son</h2>
                        <button class="billetterie-btn">Billetterie</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Festivals -->
        <section class="festivals-section" id="festivals">
            <div class="card festival-list-card">
                <div class="festivals-header">
                    <h2>Tous les festivals</h2>
                    <div class="festivals-filters">
                        <div class="search-bar">
                            <input type="text" placeholder="Rechercher un festival" class="search-input" id="search-input">
                            <button class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="filter-buttons">
                            <button class="filter-btn" data-filter="nouveautes">Nouveautés</button>
                            <button class="filter-btn" data-filter="populaires">Populaires</button>
                            <button class="filter-btn" data-filter="Tout">Tout voir</button>

                        </div>
                    </div>
                </div>

                <div class="festivals-categories">
                    @foreach ($festivals as $filterName => $festivals)
                        <h3 class="category-title" id ="category-title"> {{ $filterName }}</h3>
                        <div class="category" id ="festival-list">
                             @include('layouts.partials.festival_card', ['festivals' => $festivals])
                        </div>
                        @endforeach
                </div>
                
                <div class="see-more">
                    <a href="#" class="see-more-link">Voir tous les festivals</a>
                </div>
            </div>
        </section>
    </div>



@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.concept-slide');
    const prevButton = document.querySelector('.concept-nav-arrow.prev');
    const nextButton = document.querySelector('.concept-nav-arrow.next');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        slides[index].classList.add('active');
        currentSlide = index;

        // Gérer l'état des boutons de navigation
        prevButton.style.opacity = currentSlide === 0 ? '0.5' : '1';
        nextButton.style.opacity = currentSlide === slides.length - 1 ? '0.5' : '1';
    }

    if (prevButton && nextButton) {
        prevButton.addEventListener('click', () => {
            if (currentSlide > 0) {
                showSlide(currentSlide - 1);
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentSlide < slides.length - 1) {
                showSlide(currentSlide + 1);
            }
        });
    }

    // Initialiser le premier slide
    showSlide(0);
});
</script>

<style>
.concept-slide {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.concept-slide.active {
    display: block;
    opacity: 1;
}

.concept-navigation {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    gap: 10px;
    z-index: 2;
}

.concept-nav-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.concept-nav-arrow:hover {
    background: rgba(255, 255, 255, 0.3);
}

.concept-nav-arrow svg {
    width: 20px;
    height: 20px;
}

.concept-slides {
    position: relative;
    width: 100%;
    height: 100%;
}
</style>
@endsection