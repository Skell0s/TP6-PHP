<?php
    use Models\Unit;
    $this->layout('template', ['title' => $title, 'message' => $message]);
    $search = new Unit();
    $reflect = new ReflectionClass($search);
    $unitTypes = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);
?>
<h1>Recherche</h1>
<form class="search-form" method="post" action="index.php?action=search">
    <input type="text" name="search" required><br>
    <b>Choix</b>
    <select name="type" required>
        <?php foreach ($unitTypes as $type): ?>
            <option value="<?= $type->getName() ?>"><?= $type->getName() ?></option>
        <?php endforeach; ?>
    </select>
    <input class="btn blue" type="submit" value="Rechercher">
</form>


<?php if (isset($listUnit)) : ?>
    <h2 class="center-align">Unités</h2>
    <div class="row">
        <?php foreach ($listUnit as $unit): ?>
            <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                <img src="http://15.188.244.129//R3.01/TP6/public/img/<?= $unit->url_img() ?>" alt="<?= $unit->name() ?>" class="responsive-img">
                </div>
                <div class="card-content">
                <span class="card-title"><?= $unit->name() ?></span>
                <p>Origines : <?php foreach ($unit->origin() as $origin): ?>
                    <br><?= "- " . $origin->name()?><?php endforeach; ?></p>
                <p>Coût : <?= $unit->cost() ?></p>
                </div>
                <div class="card-action">
                <col><a href="index.php?action=edit-unit&idUnit=<?= $unit->id() ?>" class="btn">Modifier</a></col>
                <col><a href="index.php?action=del-unit&idUnit=<?= $unit->id() ?>" class="btn red">Supprimer</a></col>
                </div>
            </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (isset($listOrigin)) : ?>
    <h2 class="center-align">Origines</h2>
    <div class="row">
        <?php foreach ($listOrigin as $origin): ?>
            <div class="col">
            <div class="card">
                <div class="card-image">
                <img src="http://15.188.244.129//R3.01/TP6/public/img/<?= $origin->url_img() ?>" alt="<?= $origin->name() ?>" class="responsive-img">
                </div>
                <div class="card-content">
                <span class="card-title"><?= $origin->name() ?></span>
                </div>
                <div class="card-action">
                <col><a href="index.php?action=edit-origin&idOrigin=<?= $origin->id() ?>" class="btn">Modifier</a></col>
                <col><a href="index.php?action=del-origin&idOrigin=<?= $origin->id() ?>" class="btn red">Supprimer</a></col>
                </div>
            </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>