document.addEventListener('DOMContentLoaded', function() {
    const newsList = document.querySelector('.actualites-list');
    const newsItems = document.querySelectorAll('.actualite-item');
    const prevButton = document.querySelector('.nav-arrow[data-direction="prev"]');
    const nextButton = document.querySelector('.nav-arrow[data-direction="next"]');
    
    let currentIndex = 0;
    
    // Initialize first item as active
    if (newsItems.length > 0) {
        newsItems[0].classList.add('active');
    }
    
    // Update navigation buttons state
    function updateNavButtons() {
        prevButton.disabled = currentIndex === 0;
        nextButton.disabled = currentIndex === newsItems.length - 1;
    }
    
    // Show specific news item
    function showNews(index) {
        newsItems.forEach((item, i) => {
            item.classList.remove('active', 'prev');
            if (i === index) {
                item.classList.add('active');
            } else if (i === index - 1) {
                item.classList.add('prev');
            }
        });
        currentIndex = index;
        updateNavButtons();
    }
    
    // Event listeners for navigation
    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                showNews(currentIndex - 1);
            }
        });
    }
    
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (currentIndex < newsItems.length - 1) {
                showNews(currentIndex + 1);
            }
        });
    }
    
    // Initialize buttons state
    updateNavButtons();
}); 