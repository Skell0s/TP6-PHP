<?php
    namespace Controllers
    {
        use League\Plates\Engine;
        use Models\UnitDAO;
        class MainController
        {
            private Engine $_templates;

            public function __construct(Engine $engine)
            {
                $this->_templates = $engine;
            }

            public function index() : void 
            {
                $dao = new UnitDAO();

                $getAll = $dao->getAll();
                $getByID = $dao->getByID('1');
                $getByID2 = $dao->getByID('b');
                echo $this->_templates->render('home', [
                    'tftSetName' => 'Test',
                    'listUnit' => $getAll,
                    'first' => $getByID,
                    'other' => $getByID2
                    ]);
            } 
        }
    }
?>