document.addEventListener("DOMContentLoaded", function () {
    const festivalSelect = document.getElementById("festival-select");
    const festivalsGrid = document.querySelector("#trajets-list");
    const festivalTabs = document.querySelectorAll('.trajet-tab');
    const trajetsCountReserve = document.querySelector('.trajet-tab[data-type="reserve"] span');
    const trajetsCountEnregistre = document.querySelector('.trajet-tab[data-type="enregistre"] span');
    const trajetsFestival = document.querySelector('#offers-grid');
    festivalSelect.addEventListener("change", function () {
        const festivalSlug = festivalSelect.value;
        if (festivalSlug) {
            fetchTrajets(festivalSlug, 'reserve');
        }
    });

    festivalTabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const type = this.dataset.type;
            const festivalSlug = festivalSelect.value;
            if (festivalSlug) {
                fetchTrajets(festivalSlug, type);
            }
        });
    });

    function fetchTrajets(festivalSlug, type) {
        fetch(`/groovie/public/trajet/search?search=${festivalSlug}&type=${type}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            festivalsGrid.innerHTML = data.html;
            trajetsCountReserve.innerHTML = data.trajetsReservesCount;
            trajetsCountEnregistre.innerHTML = data.trajetsEnregistresCount;
            trajetsFestival.innerHTML = data.htmlTwo;
        })
        .catch(error => console.error('Erreur lors de la récupération des trajets:', error));
    }


    
});
