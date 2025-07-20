<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\OriginController;

    class RouteAddOrigin extends Route
    {
        private OriginController $_controller;

        public function __construct(OriginController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->displayOrigin();
        }

        public function post($params = [])
        {
            $this->_controller->addOrigin($params);
        }
    }
?>