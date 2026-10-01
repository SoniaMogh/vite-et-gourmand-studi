fetch('/api/reviews')
  .then((response) => response.json())
  .then((reviews) => {
    const container = document.querySelector('#reviews-container');

    const loader = document.querySelector('#reviews-loader');
    loader.remove();

    reviews.forEach((review, index) => {
      const reviewCard = document.createElement('div');

      reviewCard.classList.add('carousel-item');

      if (index === 0) {
        reviewCard.classList.add('active');
      }

      reviewCard.innerHTML = `
        <div class="card rounded">
          <div class="card-body">

            <div class="row align-items-center">

              <img src="${review.img}"
                   class="rounded-circle mb-3 w-25 h-25 col-6"
                   alt="Client Avatar">

              <div class="col-6">
                <h5 class="card-title m-0">${review.name}</h5>
                <p class="card-text text-muted m-0">${review.date}</p>
              </div>

            </div>

            <div class="text-warning mb-2">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>

            <p class="card-text clamp-text" id="review-${index}">
              ${review.review}
            </p>

            <button class="card-text text-muted btn p-0 m-0 toggle-review-card-btn"
                    onclick="toggleText(${index})">
              Voir plus
            </button>

          </div>
        </div>
      `;

      container.appendChild(reviewCard);
    });

    // Une fois que les cartes existent, on vérifie
    // si le bouton "Voir plus" doit être affiché
    document.querySelectorAll('.clamp-text').forEach((el) => {
      const btn = el.nextElementSibling;

      // Si le texte à + de 2 lignes (selon -webkit-line-clamp),
      if (el.scrollHeight > el.clientHeight) {
        btn.style.display = 'inline-block'; // On affiche le bouton
      } else {
        btn.style.display = 'none'; // Sinon on le cache
      }
    });

    // On initialise le carousel une fois les cartes créées
    initReviewCarousel();
  });
console.log('La page continue son exécution...');

// Bouton voir plus
// On trouve le texte à toggle et on cache
function toggleText(index) {
  const el = document.getElementById('review-' + index);

  el.classList.toggle('clamp-text');
}

function initReviewCarousel() {
  // Recherche de l'id review-carousel (notre div contenant le carousel dans home.php)
  var multipleCardCarousel = document.querySelector('#review-carousel');

  if (window.matchMedia('(min-width: 768px)').matches) {
    // Récupère la div carousel-inner
    var carouselInner = document.querySelector(
      '#review-carousel .carousel-inner',
    );
    var cardWidth = document.querySelector('.carousel-item').offsetWidth; // Trouve la taille d'une carte
    var scrollPosition = 0; // Première carte

    // Trouve le bouton suivant et scroll à droite tant qu'il y a des cartes
    document
      .querySelector('#review-carousel .carousel-control-next')
      .addEventListener('click', function () {
        // S'il y a encore des cartes, passer à la prochaine
        if (
          scrollPosition <
          // clientWidth est la zone visiible et le scroll width est la zone visible et non visible
          carouselInner.scrollWidth - carouselInner.clientWidth
        ) {
          scrollPosition += cardWidth;

          // On déplace
          carouselInner.scrollTo({
            left: scrollPosition,
            behavior: 'smooth',
          });
        } else {
          // On revient à la première carte
          scrollPosition = 0;
          carouselInner.scrollTo({
            left: scrollPosition,
            behavior: 'smooth',
          });
        }
      });

    // Trouve le bouton précédent et scroll à gauche si on est pas au début
    document
      .querySelector('#review-carousel .carousel-control-prev')
      .addEventListener('click', function () {
        if (scrollPosition > 0) {
          scrollPosition -= cardWidth;
          carouselInner.scrollTo({
            left: scrollPosition,
            behavior: 'smooth',
          });
        }
      });
  } else {
    // Si on est en mobile
    multipleCardCarousel.classList.add('slide');
  }
}
