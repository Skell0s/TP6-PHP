<?php
    namespace Controllers\Router;
    use Controllers\MainController;
    use Controllers\UnitController;
    use Controllers\SearchController;
    use Controllers\ErrorController;
    use Controllers\OriginController;
    use League\Plates\Engine;
    use Controllers\Router\Route\RouteIndex;
    use Controllers\Router\Route\RouteAddUnit;
    use Controllers\Router\Route\RouteEditUnit;
    use Controllers\Router\Route\RouteDelUnit;
    use Controllers\Router\Route\RouteAddOrigin;
    use Controllers\Router\Route\RouteSearch;
    use Controllers\Router\Route\RouteError;
    use Controllers\Router\Route\RouteDelOrigin;
    use Controllers\Router\Route\RouteEditOrigin;
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
                "error" => new ErrorController(new Engine('Views')),
                "origin" => new OriginController(new Engine('Views'))
            ];
        }

        private function createRouteList() : void
        {
            $this->routeList = [
                "index" => new RouteIndex($this->ctrlList['main']),
                "add-unit" => new RouteAddUnit($this->ctrlList['unit']),
                "add-origin" => new RouteAddOrigin($this->ctrlList['origin']),
                "search" => new RouteSearch($this->ctrlList['search']),
                "del-unit" => new RouteDelUnit($this->ctrlList['unit']),
                "edit-unit" => new RouteEditUnit($this->ctrlList['unit']),
                "error" => new RouteError($this->ctrlList['error']),
                "del-origin" => new RouteDelOrigin($this->ctrlList['origin']),
                "edit-origin" => new RouteEditOrigin($this->ctrlList['origin'])
            ];
        }

        public function routing(array $get, array $post, array $file = []) : void
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
                $method = '';
                $requests = ['get' => $get, 'post' => $post, 'file' => $file];
                switch($requests)
                {
                    case(isset($requests['file']['image']['size']) && $requests['file']['image']['size'] > 0) :
                        $params = $post;
                        $params['url_img'] = $file['image']['name'];
                        $method = 'FILE';
                        break;
                    case(!empty($requests['post'])) :
                        $params = $post;
                        $method = 'POST';
                        break;
                    case(!empty($requests['get'])) :
                        $params = $get;
                        $method = 'GET';
                        break;
                    default;
                }
                $route->action($params, $method, $file);
            }
            catch (Exception $e)
            {
                $this->routeList['error']->action(['message' => $e->getMessage()]);
            }
        }
    }
?>