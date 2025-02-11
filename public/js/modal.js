document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les boutons qui doivent ouvrir la modale
    const ticketButtons = document.querySelectorAll('[data-ticket-modal]');
    const modal = document.querySelector('.ticket-modal');
    const modalClose = document.querySelector('.modal-close');
    const modalContent = document.querySelector('.modal-content');

    if (!modal || !modalClose) return;

    // Ouvre la modale pour tous les boutons avec data-ticket-modal
    ticketButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Empêche le défilement
        });
    });

    // Ferme la modale
    modalClose.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Réactive le défilement
    });

    // Ferme la modale si on clique en dehors
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Empêche la propagation du clic depuis le contenu de la modale
    if (modalContent) {
        modalContent.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    // Ferme la modale avec la touche Echap
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}); 