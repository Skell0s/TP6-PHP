<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\SearchController;

    class RouteSearch extends Route
    {
        private SearchController $_controller;

        public function __construct(SearchController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;
        }

        public function get($params = [])
        {
            $this->_controller->displaySearch();
        }

        public function post($params = [])
        {
            $this->_controller->search($params);
        }
    }
?>