<?php
  $this->layout('template', ['title' => $title, 'message' => $message]); 
?>
<form method="post" action="index.php?action=<?= $action ?>">
    <input type="hidden" name="id" value="<?= $origin['id'] ?? null ?>">
    Nom : <input type="text" name="name" value="<?= $origin['name'] ?? null ?>" required><br>
    URL de l'image : <input type="text" name="url_img" value="<?= $origin['url_img'] ?? null ?>" required><br>
    <input class="btn blue" type="submit" value="<?= $boutonText ?>">
</form>

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