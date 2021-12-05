<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titre</title>
    <script src="https://kit.fontawesome.com/27a02ce989.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/BDDPHP/public/assets/styles/back.css">

</head>
<body>

    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
          <span class="fs-4">Administration</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li>
            <a href="/Blog/public/admin" class="nav-link text-white">
              Dashboard
            </a>
          </li>
          <li>
            <a href="/Blog/public/admin/liste-des-articles" class="nav-link text-white">
              Articles
            </a>
          </li>
          <li>
            <a href="/Blog/public/admin/liste-des-commentaires" class="nav-link text-white">
              Commentaires
            </a>
          </li>
          <li>
            <a href="/Blog/public/admin/liste-des-contacts" class="nav-link text-white">
              Demandes de contacts
            </a>
          </li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Paramètre</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="/Blog/public/">Accueil du site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/Blog/public/users/logout">Déconnexion</a></li>
          </ul>
        </div>
      </div>
    
        <div class="container">
            <?php if($session->get('message') != null): ?>
                <div class="alert alert-success" role="alert"><?= $session->get('message'); $session->forget('message'); ?></div>
            <?php endif ?>
            <?php if($session->get('error') != null): ?>
                <div class="alert alert-danger" role="alert"><?= $session->get('error'); $session->forget('error'); ?></div>
            <?php endif ?>
    
            <?= $body ?>
        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="/Blog/public/assets/js/scripts.js"></script>
</body>
</html>