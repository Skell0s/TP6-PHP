<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;
    use Helpers\Message;

    class RouteEditUnit extends Route
    {
        private UnitController $_controller;

        public function __construct(UnitController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;

        }

        public function get($params = [])
        {
            if (!isset($params['idUnit']))
            {
                $message = new Message("L'identifiant de l'unité n'est pas spécifié.", Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->_controller->displayAddUnit($message);
            }
            else
            {
                $this->_controller->displayEditUnit($params['idUnit']);
            }
        }

        public function post($params = [])
        {
            $data = [
                "id" => $this->getParam($params, "id", false),
                "name" => $this->getParam($params, "name", false),
                "cost" => $this->getParam($params, "cost", false),
                "origin" => [
                        ["id"=>intval($this->getParam($params, "origin1", false))],
                        ["id"=>intval($this->getParam($params, "origin2", false))],
                        ["id"=>intval($this->getParam($params, "origin3", false))]
                    ],
                "url_img" => $this->getParam($params, "url_img", false)
            ];
            $this->_controller->editUnitAndIndex($data);
        }
    }
?>