<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;

    class RouteDelUnit extends Route
    {
        private UnitController $_controller;

        public function __construct(UnitController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;

        }

        public function get($params = [])
        {
            $this->_controller->deleteUnitAndIndex($params['idUnit'] ?? null);
        }

        public function post($params = [])
        {

        }
    }
?>