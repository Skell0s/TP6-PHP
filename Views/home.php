<?php
  $this->layout('template', ['title' => $this->e($tftSetName)]); 
?>

<h2 class="center-align">Unité TFT</h2>
<p><?= $message ?></p>

<div class="row">
  <?php foreach ($listUnit as $unit): ?>
    <div class="col s12 m4">
      <div class="card">
        <div class="card-image">
          <img src="http://15.188.244.129//R3.01/TP6/public/img/<?= $unit->url_img() ?>" alt="<?= $unit->name() ?>" class="responsive-img">
        </div>
        <div class="card-content">
          <span class="card-title"><?= $unit->name() ?></span>
          <p>Origine : <?= $unit->origin() ?></p>
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