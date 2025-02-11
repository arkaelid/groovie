document.addEventListener("DOMContentLoaded", function () {
    // Gestion des filtres
    const filterButtons = document.querySelectorAll(".filter-btn");
    const festivalsGrid = document.querySelector("#festival-list");
    const categoryTitle = document.querySelector("#category-title");
    const searchInput = document.getElementById("search-input");

    // Appliquer les filtres
    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");
            fetch('/groovie/public/filter?filter='+filter, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.json()) // Traiter la réponse JSON

                .then((data) => {
                    festivalsGrid.innerHTML = data.html;
                    categoryTitle.innerHTML = data.filterName; // Mettre à jour le nom du filtre
                    // console.log(data.filterName);
                })
                .catch((error) => console.error("Erreur :", error));
        });
    });

    // Gestion de la recherche
    searchInput.addEventListener("input", () => {
        const query = searchInput.value.trim();


        // Envoi de la requête AJAX pour la recherche
        fetch(`/groovie/public/search?query=${query}`, {
            method: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest", // Indiquer que c'est une requête AJAX
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                }
                return response.json(); // Récupérer les résultats au format JSON
            })
            .then((data) => {
                // Mettre à jour dynamiquement les festivals sur la page
                festivalsGrid.innerHTML = data.html;
                categoryTitle.innerText = "Résultats de recherche"; // Mettre à jour le titre
            })
            .catch((error) => {
                console.error("Erreur:", error);
            });
    });
});
