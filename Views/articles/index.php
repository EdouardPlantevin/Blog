
<h1>Liste des articles</h1>
<div class="articles-container">
<?php foreach($articles as $article): ?>
    <a href="/Blog/public/articles/detail/<?php echo htmlspecialchars($article->id) ?>" class="link-article">
        <div class="card h-100">
        <img src="/Blog/public/assets/images/<?php echo htmlspecialchars($article->image) ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article->title) ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($article->title) ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($article->short_description) ?></p>
                <span class="date-card"><?php echo date_format(new DateTime(htmlspecialchars($article->updated_at)), 'd/m/Y') ?></span>
            </div>
        </div>
    </a>
<?php endforeach ?>
</div>
