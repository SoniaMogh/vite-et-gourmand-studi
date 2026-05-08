// Recherche de l'id review-carousel (notre div contenant le carousel dans home.php)
var multipleCardCarousel = document.querySelector('#review-carousel');

if (window.matchMedia('(min-width: 768px)').matches) {
  // Selon la taille de l'écran, un carousel est crée dans défilement auto
  var carousel = new bootstrap.Carousel(multipleCardCarousel, {
    interval: false,
  });

  // Récupère la div carousel-inner
  var carouselInner = document.querySelector(
    '#review-carousel .carousel-inner',
  );
  var carouselWidth = carouselInner.scrollWidth; // Trouve la taille du contenu défilable
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

// On trouve le texte à toggle et on cache
function toggleText(index) {
  const el = document.getElementById('review-' + index);

  el.classList.toggle('clamp-text');
}

// On récupère le bouton voir plus, qui est l'element suivant le texte qu'on cache
document.querySelectorAll('.clamp-text').forEach((el) => {
  const btn = el.nextElementSibling;

  // Si le texte à + de 2 lignes (selon -webkit-line-clamp),
  if (el.scrollHeight > el.clientHeight) {
    btn.style.display = 'inline-block'; // On affiche le bouton
  } else {
    btn.style.display = 'none'; // Sinon on le cache
  }
});
