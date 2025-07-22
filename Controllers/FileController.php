<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Exception;

    class FileController
    {
        public function __construct()
        {

        }



        public function upload(array $files = [])
        {
            foreach ($files as $file)
            {
                $result = move_uploaded_file($file['tmp_name'], 'public/img/' . basename($file['name']));
                if (!$result)
                {
                    throw new Exception("Le fichier n'a pas été télécharger correctement.");
                }
            }
        }
    }
?>