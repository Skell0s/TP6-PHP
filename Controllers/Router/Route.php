<?php
    namespace Controllers\Router;
    use Exception;
    use Controllers\FileController;

    abstract class Route
    {
        protected static function fileController() : FileController
        {
            return new FileController();
        }



        public function __construct()
        {

        }



        public function action($params = [], $method = 'GET', array $files = []) : void
        {
            switch($method)
            {
                case($method == 'FILE') :
                    $this->file($files);
                    $this->post($params);
                    break;
                case($method == 'POST') :
                    $this->post($params);
                    break;
                case($method == 'GET') :
                    $this->get($params);
                    break;
                default :
                    throw new Exception("Méthode HTTP non supportée");
                    break;
            }
        }

        /**
         * Récupère un paramètre dans un tableau associatif.
         *
         * @param array $array Le tableau associatif à partir duquel récupérer le paramètre.
         * @param string $paramName Le nom du paramètre à récupérer.
         * @param bool $canBeEmpty Indique si le paramètre peut être vide (par défaut, true).
         * @return mixed La valeur du paramètre.
         * @throws Exception Si le paramètre est absent ou vide (si canBeEmpty est false).
         */
        protected function getParam(array $array, string $paramName, bool $canBeEmpty=true)
        {
            if (isset($array[$paramName])) 
            {
                if(!$canBeEmpty && empty($array[$paramName]))
                {
                    throw new Exception("Paramètre '$paramName' vide");
                }

                return $array[$paramName];
            } 
            else
            {
                throw new Exception("Paramètre '$paramName' absent");
            }
        }

        abstract public function get($params = []);
        abstract public function post($params = []);
        abstract public function file($files = []);
    }
?>