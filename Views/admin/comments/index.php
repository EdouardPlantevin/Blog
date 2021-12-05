<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des commentaires</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Auteur</th>
                <th>Contenu</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($comments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment->id) ?></td>
                        <td><?= htmlspecialchars($comment->author) ?></td>
                        <td><?= htmlspecialchars($comment->content) ?></td>
                        <td>
                            <a href="/Blog/public/admin/activeComment/<?= htmlspecialchars($comment->id) ?>" class="btn btn-primary w-100 mb-1">Approuvé</a>
                            <a href="/Blog/public/admin/deleteComment/<?= htmlspecialchars($comment->id) ?>" class="btn btn-danger w-100">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>