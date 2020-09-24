
<a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>
<h2>Gestion de la page d'accueil</h2>

<?php
if (!empty($errorsList)) :
?>
  <div class="alert alert-danger text-center font-weight-bold">
    Il y a des erreurs dans le formulaire
  </div>
<?php
endif;
?>
<form action="" method="POST" class="mt-5">

<div class="row">
    <?php for($i = 1; $i <= 5; $i ++) : ?>
        <div class="col">
            <div class="form-group">
                <label  for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[<?= $i ?>]">
                    <option value="">choisissez :</option>
                    <?php foreach($homeCategories as $category) : ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
       <?php endfor ; ?>
      
    <button type="submit" name = "validate_change" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
<!-- 

<?php  for($a = 1 ; $a <=(count($homeCategories)); $a ++) : ?>  
                    <option value="<?= $a ?>"><?= $homeCategories[$a]->getName() ?></option>
                    <?php endfor;?> -->