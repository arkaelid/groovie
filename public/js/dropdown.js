document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdown');
    
    dropdowns.forEach(dropdown => {
        const trigger = dropdown.querySelector('.dropdown-trigger');
        
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const isActive = dropdown.classList.contains('active');
            
            // Ferme tous les dropdowns
            dropdowns.forEach(d => d.classList.remove('active'));
            
            // Si le dropdown cliqué n'était pas actif, l'active
            if (!isActive) {
                dropdown.classList.add('active');
            }
        });
    });
    
    // Ferme les dropdowns si on clique en dehors
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
}); 