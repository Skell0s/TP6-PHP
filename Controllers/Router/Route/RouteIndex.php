<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\MainController;

    class RouteIndex extends Route
    {
        private MainController $_controller;

        public function __construct(MainController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->index($params['message'] ?? null);
        }

        public function post($params = [])
        {
            $this->_controller->index($params['message'] ?? null);
        }

        public function file($params = [])
        {
            
        }
    }
?>