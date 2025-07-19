<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;

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
                $this->_controller->displayAddUnit("L'identifiant de l'unité n'est pas spécifié.");
            }
            else
            {
                $this->_controller->displayEditUnit($params['idUnit']);
            }
        }

        public function post($params = [])
        {
            $this->_controller->editUnitAndIndex($params);
        }
    }
?>