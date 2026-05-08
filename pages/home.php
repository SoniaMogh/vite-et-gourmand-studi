<?php
  $reviewInfos = [
    [
      "name" => "Jade Jatsky", 
      "date" => "Il y a 2 mois", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "J'ai fais confiance à Vite & Gourmand pour mon mariage. J'ai demandé s'il était possibl..."
    ],
    [
      "name" => "James Jungle", 
      "date" => "Il y a 4 mois", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
    ],
    [
      "name" => "Jun Joussop", 
      "date" => "Il y a 1 an", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "Très bon."
    ],
          [
      "name" => "Jun Joussop", 
      "date" => "Il y a 1 an", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "Très bon."
    ],
    [
      "name" => "James Jungle", 
      "date" => "Il y a 4 mois", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
    ],
    [
      "name" => "James Jungle", 
      "date" => "Il y a 4 mois", 
      "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
      "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
    ]
  ];
?>

<div>
  <div class="bigtitle text-center text-white">
    <div class="bigtitle-content">
      <img src="<?= BASE_URL ?>/assets/pictures/logo-white.png" alt="logo-v-et-g" class="logo-size">
      <h1 class="bigtitle-title">
          Des plats qui rassemblent,</br>
          des moments qui comptent
      </h1>
    </div>
  </div>

  <article id="welcome-info-part">
    <div class="container py-5">
      <div class="row align-items-center">

        <div class="col-12 d-md-none text-center">
          <h1 class="text-primary">Vite et Gourmand</h1>
        </div>

        <div class="col-12 col-md-6 order-2 order-md-2">
          <img class="img-same rounded" src="<?= BASE_URL ?>/assets/pictures/restaurant-v-et-g.jpg" />
        </div>

        <div class="col-12 col-md-6 order-3 order-md-1 button-layout-sm">
          <h1 class="d-none d-md-block text-primary">Vite et Gourmand</h1>

          <p>
            Fondé il y a 25 ans par Julie et José, Vite & Gourmand a une seule mission : 
            accompagner chaque événement, du repas convivial aux événements spéciaux, 
            grâce à des menus variés et en constante évolution.
          </p>
          
          <a href="<?= BASE_URL ?>/" class="btn btn-primary button">Réserver</a>
        </div>
      </div>
    </div>
  </article>

  <article class="key-point-part-bg" id="key-point-part">
    <div class="container py-5">
      <div class="row align-items-center">

        <div class="col-12 text-center article-type-event m-0">
          <h1 class="key-point-title-color mb-5">Nos points forts</h1>
        </div>

        <div class="row mid-pic align-items-center justify-content-evenly">

          <div class="col-12 col-md-3">
            <div class="img-card">
              <img class="rounded" src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg" />
              <div class="img-card-content">
                <div class="img-card-title">
                  <h2 >Produits frais</h2>
                </div>
                <div class="img-card-text-hover">
                  <h3>Produits locaux achetés le jour même</h3>
                </div>               
              </div>
            </div>
          </div>

          <div class="col-12 col-md-3">
            <div class="img-card">
              <img class="rounded" src="<?= BASE_URL ?>/assets/pictures/haccp-key-point.jpg" />
              <div class="img-card-content">
                <div class="img-card-title">
                  <h2 >Respect strict de l'HACCP</h2>
                </div>
                <div class="img-card-text-hover">
                  <h3>Hygiène stricte pour un respect des normes</h3>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-3">
            <div class="img-card">
              <img class="rounded" src="<?= BASE_URL ?>/assets/pictures/chef-cooking-key-point.jpg" />
              <div class="img-card-content">
                <div class="img-card-title">
                  <h2 >Chefs exigeants</h2>
                </div>
                <div class="img-card-text-hover">
                  <h3>Savoir-faire rigoureux, qualité sans compromis</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 button-type-event-layout mt-6 mt-md-2">          
          <a href="<?= BASE_URL ?>/" class="btn btn-primary button">Réserver</a>
        </div>

      </div>
    </div>
  </article>

  <article class="bg-dark" id="type-event-part">
    <div class="container py-5">
      <div class="row align-items-center">

        <div class="col-12 text-center article-type-event m-0">
          <h1 class="text-light m-0">Traiteurs particuliers & professionnels</h1>
          <h5 class="text-light mb-5">De l'évenement au quotidien</h5>
        </div>

        <div class="row mid-pic ">
          <div class="col-12 col-md-6 ps-md-0">
            <img class="img-same rounded" src="<?= BASE_URL ?>/assets/pictures/private-meal.jpg" />
            <p class="text-center text-light">Préstation privées</p>
          </div>

          <div class="col-12 col-md-6 pe-md-0">
            <img class="img-same rounded" src="<?= BASE_URL ?>/assets/pictures/event-meal.jpg" />
            <p class="text-center text-light">Préstations événementielles</p>
          </div>
        </div>

        <div class="col-12 button-type-event-layout">          
          <a href="<?= BASE_URL ?>/contact" class="btn btn-primary button">Contact</a>
        </div>
      </div>
    </div>
  </article>

  <article class="review-part-bg" id="review-part">
    <div class="container py-5">
      <div class="row align-items-center justify-content-evenly">
        <div class="col-12 text-center article-type-event m-0">
          <h1 class="text-light m-0">Nos avis clients</h1>
          <h5 class="text-light mb-5">Ils nous ont testé, pourquoi pas vous ?</h5>
        </div>

        <div id="review-carousel" class="carousel align-items-center">
          <div class="carousel-inner">
            <?php foreach ($reviewInfos as $index => $review): ?>
              <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                  <div class="card rounded">
                      <div class="card-body">

                        <div class="row align-items-center">
                          <img src="<?= $review['img'] ?>"
                              class="rounded-circle mb-3 w-25 h-25 col-6"
                              alt="Client Avatar">
                          <div class="col-6">
                            <h5 class="card-title m-0"><?= $review['name'] ?></h5>
                            <p class="card-text text-muted m-0"><?= $review['date'] ?></p>
                          </div>
                        </div>

                        <div class="text-warning mb-2">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </div>

                        <p class="card-text clamp-text" id="review-<?= $index ?>">
                          <?= htmlspecialchars($review['review']) ?>
                        </p>

                        <button class="card-text text-muted btn p-0 m-0 toggle-review-card-btn" onclick="toggleText(<?= $index ?>)">
                          Voir plus
                        </button>

                      </div>
                  </div>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#review-carousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#review-carousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </article>

</div>