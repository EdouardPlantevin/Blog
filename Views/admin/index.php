<h1>Dashboard</h1>

<div class="row">
    <div class="col-3">
        <div class="card-stat">
            <div class="content-icon">
                <i class="fas fa-users"></i>
            </div>
            <span class="stats-number"><?= htmlspecialchars($users) ?> Utilisateurs</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card-stat">
            <div class="content-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <span class="stats-number"><?= htmlspecialchars($articles) ?> Articles</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card-stat">
            <div class="content-icon">
                <i class="fas fa-file-signature"></i>
            </div>
            <span class="stats-number"><?= htmlspecialchars($contacts) ?> Contacts</span>
        </div>
    </div>
    <div class="col-3">
        <div class="card-stat">
            <div class="content-icon">
                <i class="fas fa-users"></i>
            </div>
            <span class="stats-number">DOTO</span>
        </div>
    </div>
</div>

