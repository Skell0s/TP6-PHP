<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\OriginController;
    use Helpers\Message;

    class RouteEditOrigin extends Route
    {
        private OriginController $_controller;

        public function __construct(OriginController $controller)
        {
            parent::__construct();
            $this->_controller = $controller;

        }

        public function get($params = [])
        {
            if (!isset($params['idOrigin']))
            {
                $message = new Message("L'identifiant de l'origine n'est pas spécifié.", Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->_controller->displayOrigin($message);
            }
            else
            {
                $this->_controller->displayEditOrigin($params['idOrigin']);
            }
        }

        public function post($params = [])
        {
            $this->_controller->editOriginAndIndex($params);
        }
    }
?>