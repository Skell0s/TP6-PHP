<?php
    namespace Controllers
    {
        use League\Plates\Engine;
        use Models\UnitDAO;
        use Helpers\Message;
        class MainController
        {
            private Engine $_templates;

            public function __construct(Engine $engine)
            {
                $this->_templates = $engine;
            }

            public function index(?Message $message = null) : void 
            {
                $dao = new UnitDAO();

                $getAll = $dao->getAll();
                echo $this->_templates->render('home', [
                    'tftSetName' => 'Test',
                    'listUnit' => $getAll,
                    'message' => $message
                    ]);
            } 
        }
    }
?>