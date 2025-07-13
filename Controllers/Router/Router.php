<?php
    namespace Controllers\Router;
    use Controllers\MainController;
    use League\Plates\Engine;
    use Controllers\Router\Route\RouteIndex;

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
                "main" => new MainController(new Engine('Views', 'Views/template.php'))
            ];
        }

        private function createRouteList() : void
        {
            $this->routeList = [
                "index" => new RouteIndex($this->ctrlList['main'])
            ];
        }

        public function routing(array $get, array $post) : void
        {
            if (isset($get[$this->action_key])) 
            {
                $action = $get[$this->action_key];
            } 
            else if (isset($post[$this->action_key])) 
            {
                $action = $post[$this->action_key];
            } 
            else 
            {
                $action = 'index';
            }

            $route = $this->routeList[$action];
            $params = [];
            if (isset($get)) 
            {
                $params = $get;
                $method = 'GET';
            } 
            else if (isset($post)) 
            {
                $params = $post;
                $method = 'POST';
            }
            $route->action($params, $method);
        }
    }
?>