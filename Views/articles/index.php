
<h1>Liste des articles</h1>
<div class="articles-container">
<?php foreach($articles as $article): ?>
    <a href="/Blog/public/articles/detail/<?= $superGlobal->cleanString($article->id) ?>" class="link-article">
        <div class="card h-100">
        <img src="/Blog/public/assets/images/<?= htmlspecialchars($article->image) ?>" class="card-img-top" alt="<?= htmlspecialchars($article->title) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $superGlobal->cleanString($article->title) ?></h5>
                <p class="card-text"><?= htmlspecialchars($article->short_description) ?></p>
                <span class="date-card"><?= date_format(new DateTime(htmlspecialchars($article->updated_at)), 'd/m/Y') ?></span>
            </div>
        </div>
    </a>
<?php endforeach ?>
</div>
