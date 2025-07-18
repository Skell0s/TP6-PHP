<?php
  $this->layout('template', ['title' => $this->e($title)]); 
?>
<form action="index.php?action=add-unit" method="post">
    Id : <input type="text" name="id" required><br>
    Nom : <input type="text" name="name" required><br>
    Coût : <input type="number" name="cost" required><br>
    Origine : <input type="text" name="origin" required><br>
    URL de l'image : <input type="text" name="url_img" required><br>
    <input type="submit" value="Ajouter">
</form>
