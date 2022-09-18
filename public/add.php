<?php
require './src/bootstrap.php';
render('header', ['title' => 'Ajouter un évènement']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {

    }
}   
?>

<div class="container">

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Merci de corriger vos erreurs
    </div>
<?php endif; ?>

    <h1>Ajouter un évènement</h1>
    <form action="" method="post" class="form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" required class="form-control" name="name" value="Demo">
                    <?php if (isset($errors['name'])): ?>
                        <p class="help-block"><?= $errors['name']; ?></p>
                        <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" required class="form-control" name="date" value="2018-03-04">
                </div>
            </div>
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Démarrage</label>
                    <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MM" value="19:00">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MM" value="20:00">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>
</div>

<?php render('footer'); ?>