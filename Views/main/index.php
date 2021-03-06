<section>

  <h1 class="main-title">Edouard Plantevin, le développeur qu'il vous faut!</h1>

  <div class="container-info">
    <img src="/Blog/public/assets/images/edouard-round.png" class="avatar" alt="edouard plantevin">
    <p class="info">
      Bonjour et bienvenue sur mon site, ici vous allez pouvoir voir les projets que j'ai réalisés
      lors de mes formations ainsi que des projets personnels. Tous ont un point commun : les sites web.<br>
      J'ai hâte d'avoir vos retours, vous pouvez me contacter via téléphone ou mon adresse email que vous trouverez après avoir lu mon CV ci-joint <a href="/Blog/public/assets/pdf/cv.pdf" target="_blank">ici</a>
    </p>
  </div>

</section>
<hr>

<section id="blog">
  
    <h3 class="main-title">Derniers articles</h3>
    <div class="grid-articles">
        <?php foreach ($articles as $article): ?>
          <a href="/Blog/public/articles/detail/<?php echo htmlspecialchars($article->id) ?>" class="link-article">
              <div class="card">
                  <img src="/Blog/public/assets/images/<?php echo htmlspecialchars($article->image) ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article->title) ?>">
                  <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($article->title) ?></h5>
                      <p class="card-text"><?php echo htmlspecialchars($article->short_description) ?></p>
                      <span class="date-card"><?php echo date_format(new DateTime(htmlspecialchars($article->updated_at)), 'd/m/Y') ?></span>
                  </div>
              </div>
          </a>
        <?php endforeach; ?>
    </div>

</section>