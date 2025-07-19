<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;
    use Exception;

    class RouteAddUnit extends Route
    {
        private UnitController $_controller;

        public function __construct(UnitController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->displayAddUnit();
        }

        public function post($params = [])
        {
            try {
                $data = [
                    "name" => $this->getParam($params, "name", false),
                    "cost" => $this->getParam($params, "cost", false),
                    "origin" => $this->getParam($params, "origin", false),
                    "url_img" => $this->getParam($params, "url_img", false)
                ];

                $this->_controller->addUnit($data);
            } catch (Exception $e) {
                $this->_controller->displayAddUnit("Erreur : " . $e->getMessage());
            }
        }
    }
?>