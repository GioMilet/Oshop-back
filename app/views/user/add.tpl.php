<a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter un utilisateur</h2>

<form action="" method="POST" class="mt-5">
    <!-- pour se protéger des attaques csrf --> 
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">


    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" value="<?= filter_input(INPUT_POST, 'email') ?>" type="text" class="form-control" id="email" placeholder="yo@gmail.com">

        <?php if (!empty($errorsList['email'])): ?>
        <div class="text-danger"><?= $errorsList['email'] ?></div>
        <?php endif; ?>
    
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="" aria-describedby="subtitleHelpBlock">
        <small id="subtitleHelpBlock" class="form-text text-muted">
            doit contenir au moins 8 caractères, et une majuscule et un chiffre
        </small>
        <?php if (!empty($errorsList['password'])): ?>
        <div class="text-danger"><?= $errorsList['password'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Marie">
    </div>
    <div class="form-group">
        <label for="lastname">Nom de famille</label>
        <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Dupont">
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" id="role" class="form-control">
            <option value="">Veuillez choisir...</option>
            <option value="admin">Admin</option>
            <option value="catalog-manager">Catalog-manager</option>
        </select>
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <select name="status" id="status" class="form-control">
            <option value="">Veuillez choisir...</option>
            <option value="1">Actif</option>
            <option value="2">Désactiver/Bloqué</option>
        </select>
    </div>
     
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>