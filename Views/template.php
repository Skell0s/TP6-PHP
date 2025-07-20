<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
    </head>
    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <header>
            <!-- Menu -->
            <nav>
                <div class="nav-wrapper blue">
                    <a href="index.php" class="left brand-logo" style="padding-left: 15px;">Mon projet</a>
                    <ul class="right">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php?action=add-unit">Ajouter un unit</a></li>
                        <li><a href="index.php?action=add-origin">Ajouter un origin</a></li>
                        <li><a href="index.php?action=search">Rechercher</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- #message -->
        <?= $this->insert('message', ['message' => $message]) ?>

        <!-- #contenu -->
        <main id="contenu">
            <?=$this->section('content')?>
        </main>

        <footer>

        </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() 
        {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
    </body>

</html>