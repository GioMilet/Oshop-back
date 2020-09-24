<a href="<?php //$router->generate('user-add') ?>" class="btn btn-success float-right">Ajouter</a>
<h2>Liste des utilisateurs</h2>
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Rôle</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        
        <?php foreach($users as $user): ?>
            <tr>
                <th scope="row"><?= $user->getId() ?></th>
                <td><?= $user->getFirstname() ?></td>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getRole() ?></td>
                <td>
                    <?php //icones pour supprimer et modifier ?>
                </td>
            </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>