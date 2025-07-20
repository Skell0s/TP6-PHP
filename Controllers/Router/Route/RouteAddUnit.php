<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;

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
            $data = [
                "name" => $this->getParam($params, "name", false),
                "cost" => $this->getParam($params, "cost", false),
                "origin" => [
                        ["id"=>intval($this->getParam($params, "origin1", false))],
                        ["id"=>intval($this->getParam($params, "origin2", false))],
                        ["id"=>intval($this->getParam($params, "origin3", false))]
                    ],
                "url_img" => $this->getParam($params, "url_img", false)
            ];

            $this->_controller->addUnit($data);
        }
    }
?>