<?php
    namespace Controllers;
    use League\Plates\Engine;

    class SearchController
    {
        private Engine $_templates;

        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
        }

        public function displaySearch() : void 
        {
            echo $this->_templates->render('search', [
                'title' => 'Search',
                ]);
        } 
    }
?>