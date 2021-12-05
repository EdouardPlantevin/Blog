<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des articles</h4>
        <a href="/Blog/public/admin/addArticle" class="btn btn-primary">Créer un article</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>Actif</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article->id) ?></td>
                        <td><?= htmlspecialchars($article->title) ?></td>
                        <td>
                            <img src="/Blog/public/assets/images/<?= htmlspecialchars($article->image) ?>" class="img-admin" alt="<?= htmlspecialchars($article->title) ?>" />
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" data-id="<?= htmlspecialchars($article->id) ?>" type="checkbox" id="<?= htmlspecialchars($article->id) ?>" <?= htmlspecialchars($article->active) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= htmlspecialchars($article->id) ?>"></label>
                            </div>
                        </td>
                        <td>
                            <a href="/Blog/public/admin/editArticle/<?= htmlspecialchars($article->id) ?>" class="btn btn-warning">Modifier</a>
                            <a href="/Blog/public/admin/deleteArticle/<?= htmlspecialchars($article->id) ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>