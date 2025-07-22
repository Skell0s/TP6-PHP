<?php
    namespace Controllers\Router\Route;
    use Controllers\Router\Route;
    use Controllers\UnitController;
    use Helpers\Message;

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
                $message = new Message("L'identifiant de l'unité n'est pas spécifié.", Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->_controller->displayAddUnit($message);
            }
            else
            {
                $this->_controller->displayEditUnit($params['idUnit']);
            }
        }

        public function post($params = [])
        {
            $data['origin'] = [];
            foreach ($params as $key => $param)
            {
                if ($key == "id" || $key == "name" || $key == "cost")
                {
                    $data[$key] = $this->getParam($params, $key, false);
                }
                else if ($key == "origin1" || $key == "origin2" || $key == "origin3")
                {
                    if ($param == "")
                    {
                        $data['origin'][] = ['id'=>null];
                    }
                    else
                    {
                        $data['origin'][] = ['id'=>intval($this->getParam($params, $key, true))];
                    }
                }
                else if ($key != 'id')
                {
                    $data[$key] = $this->getParam($params, $key, true);
                }
            }

            $this->_controller->editUnitAndIndex($data);
        }

        public function file($params = [])
        {
            parent::fileController()->upload($params);
        }
    }
?>