document.addEventListener('DOMContentLoaded', function() {
    // Fonction générique pour gérer les sliders
    function initializeSlider(containerClass, itemClass, prevButton, nextButton) {
        const items = document.querySelectorAll(`.${itemClass}`);
        const prev = document.querySelector(prevButton);
        const next = document.querySelector(nextButton);
        let currentIndex = 0;

        function showSlide(index) {
            items.forEach(item => {
                item.classList.remove('active');
            });
            items[index].classList.add('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showSlide(currentIndex);
        }

        if (prev) prev.addEventListener('click', prevSlide);
        if (next) next.addEventListener('click', nextSlide);

        // Initialiser le premier slide
        showSlide(0);
    }

    // Initialiser le slider des actualités
    initializeSlider(
        'actualites',
        'actualite-item',
        '.header-navigation .nav-arrow.prev',
        '.header-navigation .nav-arrow.next'
    );

    // Initialiser le slider du concept
    initializeSlider(
        'concept-slides',
        'concept-slide',
        '.concept-navigation .concept-nav-arrow.prev',
        '.concept-navigation .concept-nav-arrow.next'
    );

    const sliders = document.querySelectorAll('.actualites-list');
    
    sliders.forEach(slider => {
        const prevBtn = slider.parentElement.querySelector('.nav-arrow.prev');
        const nextBtn = slider.parentElement.querySelector('.nav-arrow.next');
        
        if (!prevBtn || !nextBtn) return;

        // Scroll amount (width of one item + gap)
        const scrollAmount = 340; // 320px (item width) + 20px (gap)

        prevBtn.addEventListener('click', () => {
            slider.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            slider.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        // Update buttons state
        const updateButtons = () => {
            const { scrollLeft, scrollWidth, clientWidth } = slider;
            
            // Disable prev button if at start
            prevBtn.style.opacity = scrollLeft <= 0 ? '0.5' : '1';
            prevBtn.style.cursor = scrollLeft <= 0 ? 'default' : 'pointer';
            
            // Disable next button if at end
            const atEnd = Math.ceil(scrollLeft + clientWidth) >= scrollWidth;
            nextBtn.style.opacity = atEnd ? '0.5' : '1';
            nextBtn.style.cursor = atEnd ? 'default' : 'pointer';
        };

        // Listen for scroll events
        slider.addEventListener('scroll', updateButtons);
        
        // Initial button state
        updateButtons();

        // Update on resize
        window.addEventListener('resize', updateButtons);
    });
}); 