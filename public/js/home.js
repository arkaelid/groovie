document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des variables globales
    let currentSlide = 0;
    let autoplayInterval;

    // Gestion des slides du concept
    const dots = document.querySelectorAll('.dot');
    const slides = document.querySelectorAll('.concept-slide');
    let slideInterval;

    function showSlide(index, direction = 'next') {
        // Ajouter la classe previous au slide actuel
        slides[currentSlide].classList.add('previous');
        
        // Retirer toutes les classes actives
        slides.forEach(slide => {
            slide.classList.remove('active');
            setTimeout(() => slide.classList.remove('previous'), 800);
        });
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Activer le nouveau slide
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        
        currentSlide = index;
    }

    function startSlideShow() {
        slideInterval = setInterval(() => {
            const nextSlide = (currentSlide + 1) % slides.length;
            showSlide(nextSlide, 'next');
        }, 8000); // Changement toutes les 8 secondes
    }

    function resetSlideShow() {
        clearInterval(slideInterval);
        startSlideShow();
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const direction = index > currentSlide ? 'next' : 'previous';
            showSlide(index, direction);
            resetSlideShow(); // Réinitialiser le timer après un clic
        });
    });

    // Démarrer le diaporama
    showSlide(0);
    startSlideShow();

    // Gestion des dropdowns
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger, .dropdown-trigger-login');
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            // Ferme tous les autres dropdowns
            dropdowns.forEach(d => {
                if (d !== this.closest('.dropdown')) {
                    d.classList.remove('active');
                }
            });
            // Toggle le dropdown actuel
            this.closest('.dropdown').classList.toggle('active');
        });
    });

    // Fermer les dropdowns quand on clique en dehors
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });

    // Lien entre les formulaires
    const signupLink = document.querySelector('.signup-link');
    if (signupLink) {
        signupLink.addEventListener('click', function(e) {
            e.preventDefault();
            // Ferme le dropdown de connexion
            document.querySelector('.dropdown-trigger-login')
                .closest('.dropdown').classList.remove('active');
            // Ouvre le dropdown d'inscription
            document.querySelector('.dropdown-trigger')
                .closest('.dropdown').classList.add('active');
        });
    }

    // Gestion de la modale
    const ticketButton = document.querySelector('.ticket-button');
    const modalOverlay = document.querySelector('.modal-overlay');
    const closeButton = document.querySelector('.icon-circle');

    if (ticketButton && modalOverlay) {
        ticketButton.addEventListener('click', () => {
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // Fermer avec le bouton X
        closeButton.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Fermer en cliquant sur l'overlay
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Fermer avec la touche Echap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
                modalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Gestion du carrousel concept
    function initConceptCarousel() {
        const conceptDots = document.querySelectorAll('.concept-card .dot');
        const conceptSlides = document.querySelectorAll('.concept-slide');
        let currentConceptSlide = 0;
        let conceptInterval;

        function goToConceptSlide(index) {
            conceptSlides.forEach(slide => {
                slide.classList.remove('active');
                slide.classList.remove('previous');
            });

            if (currentConceptSlide < index) {
                conceptSlides[currentConceptSlide].classList.add('previous');
            }

            conceptDots.forEach(dot => dot.classList.remove('active'));
            conceptSlides[index].classList.add('active');
            conceptDots[index].classList.add('active');
            currentConceptSlide = index;
        }

        conceptDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(conceptInterval);
                goToConceptSlide(index);
                startConceptAutoplay();
            });
        });

        function nextConceptSlide() {
            const nextIndex = (currentConceptSlide + 1) % conceptSlides.length;
            goToConceptSlide(nextIndex);
        }

        function startConceptAutoplay() {
            conceptInterval = setInterval(nextConceptSlide, 6000);
        }

        // Démarrer le carrousel
        goToConceptSlide(0);
        startConceptAutoplay();
    }

    // Gestion du carrousel actualités
    function initActualitesCarousel() {
        const actualitesCarousel = document.querySelector('.actualites-carousel');
        if (!actualitesCarousel) return;

        const actualitesSlides = actualitesCarousel.querySelectorAll('.actualites-slide');
        const actualitesDots = document.querySelectorAll('.actualites-card .dot');
        let currentActualiteSlide = 0;
        let actualitesInterval;

        function goToActualiteSlide(index) {
            actualitesSlides.forEach(slide => {
                slide.classList.remove('active');
                slide.style.transform = 'translateX(30px)';
            });
            actualitesDots.forEach(dot => dot.classList.remove('active'));

            actualitesSlides[index].classList.add('active');
            actualitesDots[index].classList.add('active');
            actualitesSlides[index].style.transform = 'translateX(0)';

            currentActualiteSlide = index;
        }

        actualitesDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(actualitesInterval);
                goToActualiteSlide(index);
                startActualitesAutoplay();
            });
        });

        function nextActualiteSlide() {
            const nextIndex = (currentActualiteSlide + 1) % actualitesSlides.length;
            goToActualiteSlide(nextIndex);
        }

        function startActualitesAutoplay() {
            actualitesInterval = setInterval(nextActualiteSlide, 5000);
        }

        actualitesCarousel.addEventListener('mouseenter', () => {
            clearInterval(actualitesInterval);
        });

        actualitesCarousel.addEventListener('mouseleave', startActualitesAutoplay);

        startActualitesAutoplay();
    }

    // Initialisation des carrousels
    initConceptCarousel();
    initActualitesCarousel();
}); 