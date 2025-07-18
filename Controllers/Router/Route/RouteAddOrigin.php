<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;

    class RouteAddOrigin extends Route
    {
        private UnitController $_controller;

        public function __construct(UnitController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->displayAddOrigin();
        }

        public function post($params = [])
        {
            
        }
    }
?>