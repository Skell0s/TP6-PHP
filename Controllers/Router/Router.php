<?php
    namespace Controllers\Router;
    use Controllers\MainController;
    use Controllers\UnitController;
    use Controllers\SearchController;
    use Controllers\ErrorController;
    use League\Plates\Engine;
    use Controllers\Router\Route\RouteIndex;
    use Controllers\Router\Route\RouteAddUnit;
    use Controllers\Router\Route\RouteAddOrigin;
    use Controllers\Router\Route\RouteSearch;
    use Controllers\Router\Route\RouteError;
    use Exception;
    class Router
    {
        private array $routeList;
        private array $ctrlList;
        private string $action_key;



        public function __construct($name_of_action_key = "action")
        {
            $this->routeList = [];
            $this->ctrlList = [];
            $this->action_key = $name_of_action_key;
            $this->createControllerList();
            $this->createRouteList();
        }



        private function createControllerList() : void
        {
            $this->ctrlList = [
                "main" => new MainController(new Engine('Views')),
                "unit" => new UnitController(new Engine('Views')),
                "search" => new SearchController(new Engine('Views')),
                "error" => new ErrorController(new Engine('Views'))
            ];
        }

        private function createRouteList() : void
        {
            $this->routeList = [
                "index" => new RouteIndex($this->ctrlList['main']),
                "add-unit" => new RouteAddUnit($this->ctrlList['unit']),
                "add-origin" => new RouteAddOrigin($this->ctrlList['unit']),
                "search" => new RouteSearch($this->ctrlList['search']),
                "del-unit" => new RouteIndex($this->ctrlList['main']),
                "edit-unit" => new RouteAddUnit($this->ctrlList['unit']),
                "error" => new RouteError($this->ctrlList['error'])
            ];
        }

        public function routing(array $get, array $post) : void
        {
            try
            {
                if (isset($post[$this->action_key])) 
                {
                    $action = $post[$this->action_key];
                } 
                else if (isset($get[$this->action_key])) 
                {
                    $action = $get[$this->action_key];
                }
                else 
                {
                    $action = 'index';
                }

                $route = $this->routeList[$action];
                $params = [];
                if (!empty($post)) 
                {
                    $params = $post;
                    $method = 'POST';
                }
                else if (isset($get)) 
                {
                    $params = $get;
                    $method = 'GET';
                }
                $route->action($params, $method);
            }
            catch (Exception $e)
            {
                $this->routeList['error']->action(['message' => $e->getMessage()]);
            }
        }
    }
?>