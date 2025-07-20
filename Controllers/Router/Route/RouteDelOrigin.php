<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\OriginController;

    class RouteDelOrigin extends Route
    {
        private OriginController $_controller;

        public function __construct(OriginController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;

        }

        public function get($params = [])
        {
            $this->_controller->deleteOriginAndIndex($params['idOrigin'] ?? null);
        }

        public function post($params = [])
        {

        }
    }
?>