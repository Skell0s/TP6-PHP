<?php
  $this->layout('template', ['title' => $this->e($title)]); 
?>
<form method="post" action="index.php">
    Nom : <input type="text" name="name" required><br>
    URL de l'image : <input type="text" name="url_img" required><br>
    <input type="submit" value="Ajouter">
</form>
