
<h1>Liste des articles</h1>
<div class="articles-container">
<?php foreach($articles as $article): ?>
    <a href="/Blog/public/articles/detail/<?= htmlentities($article->id) ?>" class="link-article">
        <div class="card h-100">
        <img src="/Blog/public/assets/images/<?= htmlentities($article->image) ?>" class="card-img-top" alt="<?= htmlentities($article->title) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlentities($article->title) ?></h5>
                <p class="card-text"><?= htmlentities($article->short_description) ?></p>
                <span class="date-card"><?= date_format(new DateTime(htmlentities($article->updated_at)), 'd/m/Y') ?></span>
            </div>
        </div>
    </a>
<?php endforeach ?>
</div>
