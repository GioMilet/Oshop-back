<a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>
<h2>Se connecter</h2>

<form method="POST" class="mt-5" novalidate="novalidate">
    <div class="form-group">
        <label for="email">E-mail</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="email">
        <?php if (!empty($errorsList['email'])): ?>
            <div class="text-danger font-weight-bold"><?= $errorsList['email'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="subtitleHelpBlock">
        <?php if (!empty($errorsList['password'])): ?>
            <div class="text-danger font-weight-bold"><?= $errorsList['password'] ?></div>
        <?php endif; ?>
    </div>

    <?php if (!empty($errorsList)): ?>
        <div class="text-danger font-weight-bold">Attention ! Ya des erreurs !!!</div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary btn-block mt-5">Se connecter</button>
</form>