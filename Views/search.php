<?php
    use Models\Unit;
    $this->layout('template', ['title' => $this->e($title)]);
    $search = new Unit();
    $reflect = new ReflectionClass($search);
    $unitTypes = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);
?>
<form method="post" action="index.php">
    <input type="text" name="id" required><br>
    <b>Choix</b>
    <select name="type" required>
        <?php foreach ($unitTypes as $type): ?>
            <option value="<?= $type->getName() ?>"><?= $type->getName() ?></option>
        <?php endforeach; ?>
    </select>
</form>
