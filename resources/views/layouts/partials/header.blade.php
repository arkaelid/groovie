<nav class="top-nav">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('img/groovielogobleu.png') }}" alt="Groovie Logo" class="brand-logo">
            <span class="brand-name">Groovie</span>
        </a>
    </div>
    <div class="nav-right">
        <div class="nav-links">
            @if (session('billet'))
            <a href="#" class="nav-link ticket-link" onclick="event.preventDefault(); return false;">
            <svg class="ticket-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 14H15M9 10H15M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Billet enregistré
            </a>
            @else
            <a href="#" class="nav-link ticket-link" onclick="document.querySelector('.ticket-modal').classList.add('active'); return false;">
                <svg class="ticket-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 14H15M9 10H15M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Déjà un billet ?
            </a>
            @endif
            
            @guest
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-trigger">Créer un compte</a>
                    <div class="dropdown-content">
                        <div class="form-header">
                            <img src="{{ asset('img/logobleujaune.png') }}" alt="Groovie Logo">
                        </div>
                        <form class="signup-form" method="POST" action="{{ route('register') }}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 15.5V14C15 12.3431 13.6569 11 12 11H6C4.34315 11 3 12.3431 3 14V15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <circle cx="9" cy="5" r="3" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <input type="text" id="fullname" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" placeholder="Nom Prénom" required>
                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="4" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M2 7L9 10L16 7" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Adresse email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 7.5C15 11.5 9 15 9 15C9 15 3 11.5 3 7.5C3 4.46243 5.68629 2 9 2C12.3137 2 15 4.46243 15 7.5Z" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="9" cy="7.5" r="2" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <input type="text" id="ville" name="ville" class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}" placeholder="Ville" required>
                                @error('ville')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7V5C13 3.34315 11.6569 2 10 2V2C8.34315 2 7 3.34315 7 5V7M13 7H7M13 7H14C14.5523 7 15 7.44772 15 8V14C15 14.5523 14.5523 15 14 15H6C5.44772 15 5 14.5523 5 14V8C5 7.44772 5.44772 7 6 7H7" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M10 10V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="signup-button">
                                Confirmer l'inscription
                            </button>
                            <p class="form-footer">
                                En validant votre inscription vous acceptez les <a href="#">Conditions générales d'utilisation de Groovie</a>
                            </p>
                        </form>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link dropdown-trigger">Connexion</a>
                    <div class="dropdown-content">
                        <div class="form-header">
                            <img src="{{ asset('img/logobleujaune.png') }}" alt="Groovie Logo">
                        </div>
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="4" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M2 7L9 10L16 7" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        <a>{{ session('error') }}</a>
                                    </div>
                                @endif
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Identifiant">
                                @error('email')
                                        <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7V5C13 3.34315 11.6569 2 10 2V2C8.34315 2 7 3.34315 7 5V7M13 7H7M13 7H14C14.5523 7 15 7.44772 15 8V14C15 14.5523 14.5523 15 14 15H6C5.44772 15 5 14.5523 5 14V8C5 7.44772 5.44772 7 6 7H7" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M10 10V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a href="#" class="forgot-password">Mot De Passe Oublié ?</a>
                            <button type="submit" class="login-button">
                                Connexion
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
            
            @auth
                <div class="nav-right-auth">
                    <a href="#" class="nav-link notifications-link" id="notifications-link">
                        <svg width="48" height="64" viewBox="0 0 48 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="notifications-icon">
                            <circle cx="24" cy="24" r="24" fill="#F866A4"/>
                            <path d="M22.146 15.248C22.2954 14.8787 22.5517 14.5625 22.882 14.3398C23.2123 14.1171 23.6016 13.9981 24 13.9981C24.3984 13.9981 24.7877 14.1171 25.118 14.3398C25.4483 14.5625 25.7046 14.8787 25.854 15.248C27.333 15.6542 28.6377 16.535 29.5674 17.7549C30.4971 18.9747 31.0004 20.4662 31 22V26.697L32.832 29.445C32.9325 29.5956 32.9902 29.7707 32.999 29.9515C33.0078 30.1323 32.9673 30.3121 32.8819 30.4718C32.7965 30.6314 32.6693 30.7648 32.514 30.8579C32.3587 30.9509 32.181 31 32 31H27.465C27.3446 31.8331 26.9281 32.5949 26.2917 33.1459C25.6553 33.6969 24.8418 34.0002 24 34.0002C23.1582 34.0002 22.3447 33.6969 21.7083 33.1459C21.0719 32.5949 20.6554 31.8331 20.535 31H16C15.819 31 15.6413 30.9509 15.486 30.8579C15.3307 30.7648 15.2035 30.6314 15.1181 30.4718C15.0327 30.3121 14.9922 30.1323 15.001 29.9515C15.0098 29.7707 15.0675 29.5956 15.168 29.445L17 26.697V22C17 18.776 19.18 16.06 22.146 15.248ZM22.586 31C22.6893 31.2926 22.8808 31.5461 23.1341 31.7253C23.3875 31.9046 23.6902 32.0008 24.0005 32.0008C24.3108 32.0008 24.6135 31.9046 24.8669 31.7253C25.1202 31.5461 25.3117 31.2926 25.415 31H22.586ZM24 17C22.6739 17 21.4021 17.5268 20.4645 18.4645C19.5268 19.4021 19 20.6739 19 22V27C19 27.1975 18.9416 27.3907 18.832 27.555L17.869 29H30.13L29.167 27.555C29.0578 27.3905 28.9997 27.1974 29 27V22C29 20.6739 28.4732 19.4021 27.5355 18.4645C26.5978 17.5268 25.3261 17 24 17Z" fill="white"/>
                            <rect x="12" y="40" width="24" height="18" rx="9" fill="#021997"/>
                            <text id="notif-count" x="24" y="53" text-anchor="middle" fill="white" font-size="12" font-weight="bold">{{ $notificationsCount ?? 0 }}</text>
                        </svg>
                    </a>
                    <div class="notifications-dropdown">
                        <div class="notifications-header">
                            <h3>Notifications</h3>
                            <button class="mark-all-read">Tout marquer comme lu</button>
                        </div>
                        <div class="notifications-list">
                            @if(isset($notifications) && count($notifications) > 0)
                                @foreach ($notifications as $notification)
                                    <div class="notification-item unread">
                                        <div class="notification-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <circle cx="12" cy="12" r="12" fill="#F866A4"/>
                                            </svg>
                                        </div>
                                        <div class="notification-content">
                                            <p class="notification-text">{{$notification->description}}</p>
                                            <span class="notification-time">Il y a 5 minutes</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="notification-empty">
                                    <p>Pas de notifications pour le moment</p>
                                </div>
                            @endif
                        </div>
                        <div class="notifications-footer">
                            <a href="#" class="view-all">Voir toutes les notifications</a>
                        </div>
                    </div>
                    <div class="header-nav-user">
                        <a href="{{ route('groovie') }}" class="header-user-avatar-link">
                            <div class="header-avatar-container">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('img/avatar/' . Auth::user()->avatar) }}" alt="Avatar" class="header-avatar">
                                @else
                                    <div class="header-avatar-placeholder">
                                        <span>{{ substr(Auth::user()->firstname, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="header-user-info">
                                <span class="header-user-name">{{ Auth::user()->firstname }}</span>
                                <span class="header-user-level">Niv.{{ Auth::user()->getLevel() }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button">Déconnexion</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!-- Ticket Modal -->
<!-- <div class="ticket-modal" id="ticketModal">
    <div class="modal-content">
        <button class="modal-close" id="closeTicketModal">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M13 1L1 13M1 1L13 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <div class="modal-header">
            <h3>Entrez votre numéro de billet</h3>
            <p>Vous avez déjà un billet ? Entrez son numéro ci-dessous</p>
        </div>
        <form class="modal-form">
            <div class="form-group">
                <svg class="input-icon" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M15 15.5V14C15 12.3431 13.6569 11 12 11H6C4.34315 11 3 12.3431 3 14V15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="9" cy="5" r="3" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <input type="text" placeholder="Numéro de billet">
            </div>
            <button type="submit" class="modal-submit">Valider mon billet</button>
        </form>
        <a href="#" class="modal-signup-link">Je n'ai pas encore de billet</a>
    </div>
</div> -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script pour les notifications
    function updateNotificationsCount() {
        fetch('{{ route("notifications.count") }}')
            .then(response => response.json())
            .then(data => {
                const textElement = document.querySelector('.notifications-icon #notif-count');
                if (textElement) {
                    textElement.textContent = data.count || '0';
                }
            });
    }

    // Mettre à jour le compteur toutes les 30 secondes
    setInterval(updateNotificationsCount, 30000);

    // Mettre à jour le compteur au chargement de la page
    document.addEventListener('DOMContentLoaded', updateNotificationsCount);

    // Gestion des notifications
    const notifLink = document.getElementById('notifications-link');
    if (notifLink) {
        notifLink.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
        });
    }

    // Fermer le dropdown des notifications
    document.addEventListener('click', function(e) {
        const notifLink = document.getElementById('notifications-link');
        if (notifLink && !notifLink.contains(e.target)) {
            notifLink.classList.remove('active');
        }
    });

    // Gestion de la modale de billet
    const ticketModal = document.getElementById('ticketModal');
    const ticketModalTrigger = document.getElementById('ticketModalTrigger');
    const closeTicketModal = document.getElementById('closeTicketModal');

    ticketModalTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        ticketModal.classList.add('active');
    });

    closeTicketModal.addEventListener('click', function() {
        ticketModal.classList.remove('active');
    });

    // Fermer la modale en cliquant en dehors
    ticketModal.addEventListener('click', function(e) {
        if (e.target === ticketModal) {
            ticketModal.classList.remove('active');
        }
    });
});
</script> 