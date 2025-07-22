<?php
  $this->layout('template', ['title' => $tftSetName, 'message' => $message]); 
?>

<h2 class="center-align">Unité TFT</h2>

<div class="row">
  <?php foreach ($listUnit as $unit): ?>
    <div class="col">
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