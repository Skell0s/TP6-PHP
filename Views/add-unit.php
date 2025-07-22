<?php
    $this->layout('template', ['title' => $title, 'message' => $message]); 
?>
<form action="index.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $unit['id'] ?? null ?>"><br>
    Nom : <input type="text" name="name" value="<?= $unit['name'] ?? null ?>" required><br>
    Coût : <input type="number" name="cost" value="<?= $unit['cost'] ?? null ?>" required><br>
    Origines : 
    <div class="align-wrapper">
        <select name="origin1">
            <option value="">Origine 1</option>
            <?php foreach ($origins as $origin): ?>
                <option value="<?= $origin->id() ?>" <?= isset($unit['origin'][0]) && $unit['origin'][0]->id() == $origin->id() ? 'selected' : '' ?>>
                    <?= $origin->name() ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="origin2">
            <option value="">Origine 2</option>
            <?php foreach ($origins as $origin): ?>
                <option value="<?= $origin->id() ?>" <?= isset($unit['origin'][1]) && $unit['origin'][1]->id() == $origin->id() ? 'selected' : '' ?>>
                    <?= $origin->name() ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="origin3">
            <option value="">Origine 3</option>
            <?php foreach ($origins as $origin): ?>
                <option value="<?= $origin->id() ?>" <?= isset($unit['origin'][2]) && $unit['origin'][2]->id() == $origin->id() ? 'selected' : '' ?>>
                    <?= $origin->name() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div><br>
    <select name="url_img">
        <option value="">Choisir une image déjà existante</option>
        <?php foreach ($files as $file): ?>
            <option value="<?= $file ?>" <?= isset($unit['url_img']) && $unit['url_img'] == $file ? 'selected' : '' ?>>
                <?= $file ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <div class="file-field input-field">
            <input type="file" name="image" accept="image/png, image/jpeg">
            <input class="file-path validate" type="text" placeholder="Choisir une nouvelle image">
    </div>
    <div class="align-wrapper">
        <input class="btn blue" type="submit" value="<?= $boutonText ?>">
        <a class="btn blue" href="index.php?action=index">Annuler</a>
    </div>
</form>
