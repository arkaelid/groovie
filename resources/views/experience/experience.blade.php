@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/experience.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="cards-container">
    <!-- Carte Mes Trajets -->
    <div class="card" data-index="1" data-type="trajets">
        <div class="card-header">
            <div class="card-title">
                <div class="section-icon">
                    <img src="{{ asset('img/icons/mestrajets.svg') }}" alt="Mon trajet augmenté">
                </div>
                <span>Mon trajet augmenté</span>
            </div>
            <div class="card-arrow">
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier">
            </div>
        </div>
        <div class="card-content">
            <!-- Stats -->
            <div class="trajet-stats">
                <div class="stat-box">
                    <span class="stat-label">Groupes à découvrir</span>
                    <span class="stat-value">24</span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Temps restant</span>
                    <span class="stat-value">1:33</span>
                </div>
            </div>
            
            
            <!-- Suggestions -->
            <div class="trajet-suggestions">
                <h3>À découvrir sur ton trajet</h3>
                <ul class="suggestion-list">
                    <li class="suggestion-item">
                        <span class="suggestion-emoji">🎵</span>
                        <div class="suggestion-text">
                            <strong>Concert surprise</strong>
                            <span>Dans 15 minutes • Scène B</span>
                        </div>
                    </li>
                    <li class="suggestion-item">
                        <span class="suggestion-emoji">🍜</span>
                        <div class="suggestion-text">
                            <strong>Food truck asiatique</strong>
                            <span>Sur ton chemin • -20% avant 14h</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Carte Actualités -->
    <div class="card" data-index="2" data-type="actualites">
        <div class="card-header">
            <div class="card-title">
                <div class="section-icon">
                    <img src="{{ asset('img/icons/actualites.svg') }}" alt="Actualités">
                </div>
                <span>Actualités du festival</span>
            </div>
            <div class="card-arrow">
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier">
            </div>
        </div>
        <div class="card-content">
            <div class="news-grid">
                <div class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('img/biga.png') }}" alt="Biga*Ranx">
                        <div class="news-tag">Artiste</div>
                    </div>
                    <div class="news-content">
                        <h3>Le concert de Biga*Ranx</h3>
                        <p>Retrouvez Biga*Ranx sur la scène principale...</p>
                        <div class="news-date">Il y a 2 heures</div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('img/festival.jpg') }}" alt="Festival">
                        <div class="news-tag">Programme</div>
                    </div>
                    <div class="news-content">
                        <h3>Le programme est disponible</h3>
                        <p>Découvrez tous les artistes présents cette année...</p>
                        <div class="news-date">Il y a 1 jour</div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('img/foodtruck.jpg') }}" alt="Food trucks">
                        <div class="news-tag">Food</div>
                    </div>
                    <div class="news-content">
                        <h3>Les food trucks présents</h3>
                        <p>Une sélection de food trucks pour tous les goûts...</p>
                        <div class="news-date">Il y a 3 jours</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte Jeux -->
    <div class="card" data-index="3" data-type="jeux">
        <div class="card-header">
            <div class="card-title">
                <div class="section-icon">
                    <img src="{{ asset('img/icons/jeux.svg') }}" alt="Jeux">
                </div>
                <span>Des jeux à partager</span>
            </div>
            <div class="card-arrow">
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier">
            </div>
        </div>
        <div class="card-content">
            <!-- Filtres -->
            <div class="game-filters">
                <button class="filter-tag active">Les + populaires</button>
                <button class="filter-tag">Solo</button>
                <button class="filter-tag">1vs1</button>
            </div>

            <!-- Grille de jeux -->
            <div class="games-grid">
                <div class="game-card">
                    <div class="game-image">
                        <img src="{{ asset('img/games/123.svg') }}" alt="1,2,3...">
                    </div>
                    <div class="game-info">
                        <h3>1,2,3...</h3>
                        <p>Jeu de rapidité</p>
                    </div>
                </div>

                <div class="game-card">
                    <div class="game-image">
                        <img src="{{ asset('img/games/memory.svg') }}" alt="Memory">
                    </div>
                    <div class="game-info">
                        <h3>Memory</h3>
                        <p>Jeu de mémoire</p>
                    </div>
                </div>

                <div class="game-card">
                    <div class="game-image">
                        <img src="{{ asset('img/games/quiz.svg') }}" alt="Quiz Musical">
                    </div>
                    <div class="game-info">
                        <h3>Quiz Musical</h3>
                        <p>Test tes connaissances</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte Playlists -->
    <div class="card" data-index="4" data-type="playlists">
        <div class="card-header">
            <div class="card-title">
                <div class="section-icon">
                    <img src="{{ asset('img/icons/playlists.svg') }}" alt="Playlists">
                </div>
                <span>Les Playlists</span>
            </div>
            <div class="card-arrow">
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier">
            </div>
        </div>
        <div class="card-content">
            <!-- Supermix Banner -->
            <div class="supermix-banner">
                <div class="supermix-info">
                    <h3>Mon Supermix</h3>
                    <p>Playlist du festival 2024</p>
                </div>
                <div class="play-button">
                    <img src="{{ asset('img/icons/play.svg') }}" alt="Play">
                </div>
            </div>

            <!-- Par thème -->
            <div class="playlist-section">
                <h4>Par thème</h4>
                <div class="playlists-grid">
                    <div class="playlist-card">
                        <img src="{{ asset('img/scenep.svg') }}" alt="Scène Principale" class="playlist-image">
                    </div>

                    <div class="playlist-card">
                        <img src="{{ asset('img/newart.svg') }}" alt="Nouveaux Artistes" class="playlist-image">
                    </div>

                    <div class="playlist-card">
                        <img src="{{ asset('img/playcom.svg') }}" alt="Playlist de la com" class="playlist-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
});
</script>
@endsection 