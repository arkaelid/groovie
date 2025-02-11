@extends('layouts.app')

@section('title', 'Groovie - Mon Espace')

@section('css')
    <link href="{{ asset('css/groovie.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="cards-container">
    <div id="profil-card" class="card" data-index="1">
        <div class="card-header">
            <div class="card-title">
                <div class="avatar-container">
                    <label for="avatar-upload" class="avatar-label">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('img/avatar/' . Auth::user()->avatar) }}" alt="Avatar" class="user-avatar">
                        @else
                            <div class="avatar-placeholder">
                                <span>{{ substr(Auth::user()->firstname, 0, 1) }}</span>
                            </div>
                        @endif
                    </label>
                    
                    <input type="file" id="avatar-upload" class="avatar-input" accept="image/*" hidden>
                    
                </div>
                <div class="picto-upload">
                    <img src="{{asset('img/icons/picture.svg')}}" alt="logo changement photo">
                </div>
                <div class="user-info">
                    <h2>{{ Auth::user()->firstname }} {{ substr(Auth::user()->lastname, 0, 1) }}.</h2>
                    <div class="user-level">
                        <span class="level">Groover Niv.{{ $level }}</span>
                        <span class="id">#{{ Auth::user()->id_groover }}</span>
                    </div>
                </div>
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier" class="card-arrow">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content" id="flexProfil">
            
                    <div class="settings-form">
                        <div class="form-group">
                            
                                <label>Nom & Prénom :</label>
                                <div class="input-group inputName">
                                    <input type="text" name="firstname" value="{{ Auth::user()->firstname }}" data-field="firstname">
                                    <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" data-field="lastname">
                                    <button class="modify" data-fields="firstname,lastname">Modifier</button>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Adresse mail :</label>
                                <div class="input-group">
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" data-field="email">
                                    <button class="modify" data-field="email">Modifier</button>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Ville :</label>
                                <div class="input-group">
                                    <input type="text" name="ville" value="{{ Auth::user()->ville }}" data-field="ville">
                                    <button class="modify" data-field="ville">Modifier</button>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Mot de passe :</label>
                                <div class="input-group">
                                    <input type="password" name="password" value="••••••••" data-field="password">
                                    <button class="modify" data-field="password">Modifier</button>
                                </div>
                        </div>

                        
                    </div>
                    <div class="settings-form2">
                    <div class="form-group">
                    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                                <label>Nombres de Groovies :</label>
                                <div class="form-group-content groovies-point">
                                    <span class="form-value id">{{ Auth::user()->groovies }} points</span>
                                </div>
                                
                        </div>

                        <div class="form-group">
                                <label>ID Groovie</label>
                                <div class="form-group-content">
                                    <span class="form-value id">#{{ Auth::user()->id_groover }}</span>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>Historique des dépenses</label>
                                <a href="#" class="details-link">Voir les détails</a>
                        </div>
                        <div class="form-group ">
                                <button class="cloture" id="closeAccountBtn">Clôturer mon compte</button>
                        </div>
                    
                    </div>
        </div>
</div>
<div id="wallet-card" class="card" data-index="2">
        <div class="card-header">
            <div class="card-title">
                <img src="{{ asset('img/icons/groovie-wallet.svg') }}" alt="Offres" class="card-icon">
                <span>Mon wallet</span>
                <img src="{{ asset('img/icons/arrow.svg') }}" alt="Déplier" class="card-arrow">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content">
            <div class="cards-container">
                <div class="card-section" data-card="wallet">
                    
                    <div class="wallet-menu">
                        <a href="#" class="wallet-item utiliser" data-target="utiliser-card">
                            <img src="{{ asset('img/groovielogobleu.png') }}" alt="Utiliser mes Groovies" width="32" height="32">
                            <span>Utiliser mes Groovies</span>
                        </a>
                        <a href="#" class="wallet-item qr" data-target="qr-card">
                            <img src="{{ asset('img/wallet-qr.png') }}" alt="Mon QR Code" width="32" height="32">
                            <span>Mon QR Code</span>
                        </a>
                        <a href="#" class="wallet-item festivals" data-target="festivals-card">
                            <img src="{{ asset('img/wallet-festival.png') }}" alt="Mes festivals" width="32" height="32">
                            <span>Mes festivals</span>
                        </a>
                        <a href="#" class="wallet-item parametres" data-target="parametres-card">
                            <img src="{{ asset('img/wallet-para.png') }}" alt="Paramètres" width="32" height="32">
                            <span>Paramètres</span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div id="festivals-card" class="card" data-index="7">
        <div class="card-header">
            <div class="card-title">
                <img src="{{ asset('img/wallet-festival.png') }}" alt="Festivals" width="32" height="32">
                <span>Mes Festivals</span>
                <img src="{{ asset('img/icons/icon-close.svg') }}" alt="close" class="card-close">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content">
            <div class="cards-container">
            <div class="card-section" data-card="festivals">
                    <div class="card-content">
                        <div class="festival-list">
                        @forelse($festivals as $festival)
                            <a href="{{Route('festival.show', $festival)}}">
                                <div class="festival-item">
                                    <div class="festival-info">
                                        <h4>J - {{$festival->joursRestants}}</h4>
                                        <div class="festival-name">{{ $festival->nom_festival }}</div>
                                        <div class="festival-date">{{ $festival->date_heure_debut->translatedFormat('d F') }} - {{ $festival->date_heure_fin->translatedFormat('d F Y') }}</div>
                                    </div>
                                    <button class="festival-action">
                                        <img src="{{ asset('img/icons/ticket-wallet.svg') }}" alt="Ticket" width="32" height="32">
                                    </button>
                                </div>
                            </a>
                        @empty
                            <p>Aucun festival disponible pour le moment.</p>
                        @endforelse
                            <!-- <div class="festival-item">
                                <div class="festival-info">
                                    <h4>J - 100</h4>
                                    <div class="festival-name">Garorock</div>
                                    <div class="festival-date">13 Août - 15 Août 2024</div>
                                </div>
                                <button class="festival-action">
                                    <img src="{{ asset('img/icons/ticket-wallet.svg') }}" alt="Ticket" width="32" height="32">
                                </button>
                            </div> -->
                            <button class="add-festival">
                                <a href="">Ajouter un festival</a>
                                <span class="plus-icon">+</span>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>  
    <div id="qr-card" class="card" data-index="5">
        <div class="card-header">
            <div class="card-title">
            <img src="{{ asset('img/wallet-qr.png') }}" alt="QR Code" width="32" height="32">
                <span>Mon QR Code</span>
                <img src="{{ asset('img/icons/icon-close.svg') }}" alt="close" class="card-close">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content">
            <div class="cards-container">
                <div class="card-section" data-card="qr">
                    <div class="card-content">
                        <div class="qr-code-container">
                            <div class="qr-code-wrapper">
                                <img src="{{ asset('img/wallet-qr.png') }}" alt="QR Code" class="qr-code-image">
                            </div>
                            <p class="qr-code-text">Présentez ce QR code pour utiliser vos Groovies.</p>
                            <button class="download-button" onclick="downloadQRCode()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="7 10 12 15 17 10"/>
                                    <line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>
                                <span>Télécharger en PDF</span>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>   

    
    <div id="utiliser-card" class="card" data-index="4">
        <div class="card-header">
            <div class="card-title">
            <img src="{{ asset('img/icons/icon-groovies.png') }}" alt="Utiliser mes Groovies" class="groovies-icon">
                <span>Utiliser mes Groovies</span>
                <img src="{{ asset('img/icons/icon-close.svg') }}" alt="close" class="card-close">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content">
            <div class="cards-container"  id="widthFestival">
                <div class="card-section" data-card="festivals">
                        <div class="filter-buttons">
                            <button class="filter-btn active">Voir tout</button>
                            <button class="filter-btn">Sur le festival</button>
                            <button class="filter-btn">Loisirs</button>
                        </div>

                        <div class="offers-section">
                            <div class="section-header">
                                <h3>Les Offres du jour</h3>
                                <a href="#" class="see-all">Tout voir</a>
                            </div>
                            <div class="offers-grid">
                                @foreach($offres->random(3) as $offre)
                                    <div class="offer-card">
                                        <a href="{{ route('offres.detail', $offre->id) }}" class="offer-link"> <!-- Lien vers les détails de l'offre -->
                                            <div class="offer-image">
                                                <img src="{{ asset('img/trajet.jpg') }}" alt="Trajet train">
                                                <div class="groovies-tag">{{ $offre->points_groovie }} Groovies</div>
                                                <div class="offer-icon transport">
                                                    <img src="{{ asset('img/icons/train.svg') }}" alt="Train">
                                                </div>
                                            </div>
                                            <div class="offer-content">
                                                <h4>-{{ $offre->reduction }}% {{ $offre->nom_offre }}</h4>
                                                <p>Sur un trajet {{ $offre->partenaire }}</p>
                                                <p>{{ $offre->informations }}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- <div class="offers-section">
                            <div class="section-header">
                                <h3>Sur le festival</h3>
                                <a href="#" class="see-all">Tout voir</a>
                            </div>
                            <div class="offers-grid">
                                <div class="offer-card">
                                    <div class="offer-image">
                                        <img src="{{ asset('img/solidays.jpg') }}" alt="Rencontre artiste">
                                        <div class="groovies-tag">100 Groovies</div>
                                        <div class="offer-icon backstage">
                                            <img src="{{ asset('img/icons/artist.svg') }}" alt="Artiste">
                                        </div>
                                    </div>
                                    <div class="offer-content">
                                        <h4>Rencontre avec l'artiste</h4>
                                        <p>Back stage</p>
                                    </div>
                                </div>
                                <div class="offer-card">
                                    <div class="offer-image">
                                        <img src="{{ asset('img/camping.jpg') }}" alt="Camping">
                                        <div class="groovies-tag">50 Groovies</div>
                                        <div class="offer-icon camping">
                                            <img src="{{ asset('img/icons/tent.svg') }}" alt="Tente">
                                        </div>
                                    </div>
                                    <div class="offer-content">
                                        <h4>1 nuit au camping</h4>
                                        <p>Tente 2 personnes</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
    </div> 
            
    <div id="parametres-card" class="card" data-index="6">
        <div class="card-header">
            <div class="card-title">
            <img src="{{ asset('img/wallet-para.png') }}" alt="Paramètres" width="32" height="32">
                <span>Paramètres</span>
                <img src="{{ asset('img/icons/icon-close.svg') }}" alt="close" class="card-close">
            </div>
            
        </div>
        <div class="header-separator"></div>
        <div class="card-content">
            <div class="cards-container">
            <div id="paramReset" class="card-section" data-card="parametres">
                    
                    <div class="card-content">
                        <div class="form-group">
                            <div class="lang">
                                <h4>Préférence de Langue :</h4>
                                <label for="lang"></label>
                                <select name="lang" id="lang-select">
                                <option value="fr">Français</option>
                                <option value="en">English</option>
                                <option value="es">Español</option>
                                <option value="de">Deutsch</option>
                                <option value="zh">中国人</option>
                                <option value="ja">日本語</option>
                                <option value="ko">한국인</option>
                                </select>
                                <button class="modify" data-field="ville">Valider</button>
                            </div>
                        </div>
                        <div class="paramRight">
                            <div id="musiqueCheck">
                                <div>
                                    <input type="checkbox" id="festival-type" name="festival_type" value="1">
                                    <label for="festival-type">Autoriser la géolocalisation ?</label>
                                
                                </div>
                            </div>
                            
                                <div class="paramLink">
                                    <a href="#">Aide</a>
                                    <a href="#">Conditions générales</a>
                
                                </div>
                            
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="form-group">
                            <div class="voyagePref">
                            <h4>Préférence de voyage :</h4>
                                <label for="lang"></label>
                                    <select name="city" id="city-select">
                                        <option value="1">Blois</option>
                                        <option value="2">Paris</option>
                                        <option value="3">Marseille</option>
                                        <option value="4">Toulouse</option>
                                        <option value="5">Dunkerque</option>
                                        <option value="6">Mulhouse</option>
                                        <option value="7">Bordeaux</option>
                                    </select>
                                    <button class="modify" data-field="ville">Valider</button>
                                </div>
                                <div id="musiqueCheck">
                                    <div>
                                        <input type="checkbox" id="festival-type" name="festival_type" value="1">
                                        <label for="festival-type">Solo</label>
                                    
                                    
                                        <input type="checkbox" id="festival-type" name="festival_type" value="2">
                                        <label for="festival-type"><span>à</span> plusieurs</label>
                                    </div>
                                </div>    
                                
                            </div>    
                    </div>
                    <div class="card-content">
                        <div class="form-group">
                            <div class="typeMusique">
                                <h4>Préférence de Musique :</h4>
                                    <label for="festival-type"></label>
                                    <select id="festival-type" name="festival_type" class="form-control">
                                        @foreach($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                            </select>
                            <button class="modify" data-field="type">Valider</button>
                        </div>
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

    const filterButton = document.querySelector('.filter-button[data-action="filter"]');
    const filtersContainer = document.querySelector('.offres-filters');
    const filterGroup = document.querySelector('.filter-group');
    
    filterGroup.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    filterButton.addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('active');
        filtersContainer.classList.toggle('show');
    });

    filtersContainer.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    
});
const filterButtons = document.querySelectorAll('.filter-btn');

filterButtons.forEach(button => {
    button.addEventListener('click', function () {
        
        filterButtons.forEach(btn => btn.classList.remove('active'));

        this.classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const walletCard = document.querySelector('#wallet-card');
    const profileCard = document.querySelector('#profil-card'); 
    const walletMenu = document.querySelector('.wallet-menu');
    const allCards = document.querySelectorAll('.card');
   
    // Cacher toutes les sections sauf wallet et profil au départ
    allCards.forEach(card => {
        if (card.id !== 'wallet-card' && card.id !== 'profil-card') {
            card.style.display = 'none';
        }
    });

    // Gérer les clics sur les liens du menu wallet
    walletMenu.addEventListener('click', function(e) {
        const link = e.target.closest('.wallet-item');
        if (!link) return;

        e.preventDefault();
        const targetCardId = link.dataset.target; //  data-target = id de la carte

        // Cacher la carte wallet
        walletCard.style.display = 'none';

        // Afficher la carte cible
        const targetCard = document.querySelector(`#${targetCardId}`);
        if (targetCard) {
            targetCard.setAttribute('data-index', '1');
            targetCard.style.display = 'block';
            targetCard.style.opacity = '1'; 
            targetCard.style.height = '820px';
            targetCard.style.zIndex = '100';
            targetCard.style.overflow = 'auto';
        }
    });
    
    // Gérer le clic sur le bouton fermer
    document.addEventListener('click', function(e) {
        const closeButton = e.target.closest('.card-close'); 
        if (!closeButton) return;

        e.preventDefault();

        // Réinitialiser wallet pour qu'il reprenne data-index="1"
        walletCard.setAttribute('data-index', '1');
        walletCard.style.display = 'block'; 
        walletCard.style.opacity = '1'; 
        
        // Cacher les autres cartes
        allCards.forEach(card => {
            if (card.id !== 'wallet-card' && card.id !== 'profil-card') {
                card.style.display = 'none'; 
            }
        });
    });
    
   
});

//
document.querySelectorAll('.modify').forEach(button => {
    button.addEventListener('click', async function(e) {
        e.preventDefault();
        
        const fields = this.dataset.fields ? this.dataset.fields.split(',') : [this.dataset.field];
        
        if (fields.length > 1) {
            // Cas spécial pour nom et prénom
            const firstname = this.parentElement.querySelector('input[data-field="firstname"]').value;
            const lastname = this.parentElement.querySelector('input[data-field="lastname"]').value;
            
            try {
                const response = await fetch('{{ route("groovie.profil.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        firstname: firstname,
                        lastname: lastname
                    })
                });

                if (response.ok) {
                    // Mise à jour du nom dans l'en-tête du profil
                    const userNameElement = document.querySelector('.user-info h2');
                    if (userNameElement) {
                        userNameElement.textContent = `${firstname} ${lastname.charAt(0)}.`;
                    }
                    
                    alert('Profil mis à jour avec succès');
                } else {
                    alert('Erreur lors de la mise à jour du profil');
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            }
        } else {
            // Cas normal pour les autres champs
            const field = this.dataset.field;
            const input = this.parentElement.querySelector(`input[data-field="${field}"]`);
            const value = input.value;

            try {
                const response = await fetch('{{ route("groovie.profil.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        [field]: value
                    })
                });

                if (response.ok) {
                    alert('Profil mis à jour avec succès');
                } else {
                    alert('Erreur lors de la mise à jour du profil');
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            }
        }
    });
});

// Fonction utilitaire pour mettre à jour les éléments de l'interface
function updateUIElements(field, value) {
    // Mettre à jour l'avatar placeholder si le prénom change
    if (field === 'firstname') {
        const avatarPlaceholder = document.querySelector('.avatar-placeholder span');
        if (avatarPlaceholder) {
            avatarPlaceholder.textContent = value.charAt(0);
        }
    }
}

function downloadQRCode() {
   
   const { jsPDF } = window.jspdf;
   const doc = new jsPDF();
   
   
   const qrCode = document.querySelector('.qr-code-image');
   
   
   doc.addImage(qrCode, 'PNG', 20, 20, 170, 170);
   
   
   doc.setFontSize(16);
   doc.text('Mon QR Code Groovie', 20, 200);
   
   
   doc.save('mon-qr-code-groovie.pdf');

}
// Ajoutez ce code pour gérer la clôture du compte
document.getElementById('closeAccountBtn').addEventListener('click', async function(e) {
    e.preventDefault();
    
    if (confirm('Êtes-vous sûr de vouloir clôturer votre compte ? Cette action est irréversible.')) {
        try {
            const response = await fetch('{{ route("groovie.profil.close") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (response.ok) {
                alert(data.message);
                window.location.href = data.redirect;
            } else {
                alert('Erreur lors de la clôture du compte');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        }
    }
});

document.getElementById('avatar-upload').addEventListener('change', async function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('avatar', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try {
        const response = await fetch('{{ route("update.avatar") }}', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            // Mettre à jour l'avatar dans l'interface
            const avatarContainer = document.querySelector('.avatar-container');
            const oldImg = avatarContainer.querySelector('img');
            const oldPlaceholder = avatarContainer.querySelector('.avatar-placeholder');

            if (oldImg) {
                oldImg.src = `{{ asset('img/avatar/') }}/${data.avatar}`;
            } else if (oldPlaceholder) {
                oldPlaceholder.remove();
                const newImg = document.createElement('img');
                newImg.src = `{{ asset('img/avatar/') }}/${data.avatar}`;
                newImg.alt = 'Avatar';
                newImg.className = 'user-avatar';
                avatarContainer.querySelector('.avatar-label').appendChild(newImg);
            }

           
        } else {
            
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    }
});
</script>
@endsection
@section('css')

<style>
.card-section[data-card="profil"] {
    position: fixed;
    bottom: -100vh;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    width: calc(100% - 30px);
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    z-index: 100;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    border-radius: 24px;
    box-shadow: 0 -8px 40px rgba(0, 0, 0, 0.12);
    background: var(--highway);
}
@endsection 
