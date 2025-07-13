<?php
    namespace Controllers\Router;
    use Exception;

    abstract class Route
    {
        public function __construct()
        {
            
        }



        public function action($params = [], $method = 'GET') : void
        {
            if ($method === 'GET') 
            {
                $this->get($params);
            } 
            else if ($method === 'POST') 
            {
                $this->post($params);
            } 
            else 
            {
                throw new Exception("Méthode HTTP non supportée");
            }
        }

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
    }
?>