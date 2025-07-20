<?php
    $this->layout('template', ['title' => $title, 'message' => $message]); 
?>
<form action="index.php?action=<?= $action ?>" method="post">
    <input type="hidden" name="id" value="<?= $unit['id'] ?? null ?>"><br>
    Nom : <input type="text" name="name" value="<?= $unit['name'] ?? null ?>" required><br>
    Coût : <input type="number" name="cost" value="<?= $unit['cost'] ?? null ?>" required><br>
    Origines : <div class="align-wrapper"><select name="origin1" required>
        <?php foreach ($origins as $origin): ?>
            <option value="<?= $origin->id() ?>" <?= isset($unit['origin']) && $unit['origin'][0]->id() == $origin->id() ? 'selected' : '' ?>>
                <?= $origin->name() ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="origin2" required>
        <?php foreach ($origins as $origin): ?>
            <option value="<?= $origin->id() ?>" <?= isset($unit['origin']) && $unit['origin'][1]->id() == $origin->id() ? 'selected' : '' ?>>
                <?= $origin->name() ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="origin3" required>
        <?php foreach ($origins as $origin): ?>
            <option value="<?= $origin->id() ?>" <?= isset($unit['origin']) && $unit['origin'][2]->id() == $origin->id() ? 'selected' : '' ?>>
                <?= $origin->name() ?>
            </option>
        <?php endforeach; ?>
    </select></div><br>
    URL de l'image : <input type="text" name="url_img" value="<?= $unit['url_img'] ?? null ?>" required><br>
    <div class="align-wrapper">
        <input class="btn blue" type="submit" value="<?= $boutonText ?>">
        <a class="btn blue" href="index.php?action=index">Annuler</a>
    </div>
</form>
