<?php
    namespace Controllers
    {
        use League\Plates\Engine;
        class MainController
        {
            private Engine $_templates;

            public function __construct(Engine $engine)
            {
                $this->_templates = $engine;
            }

            public function index() : void 
            {
                echo $this->_templates->render('home', ['tftSetName' => 'Test']);
            } 
        }
    }
?>