<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\ErrorController;

    class RouteError extends Route
    {
        private ErrorController $_controller;

        public function __construct(ErrorController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->displayError($params['message'] ?? null);
        }

        public function post($params = [])
        {
            $this->_controller->displayError($params['message'] ?? null);
        }

        public function file($params = [])
        {
            
        }
    }
?>