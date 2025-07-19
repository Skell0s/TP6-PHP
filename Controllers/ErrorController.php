<?php
    namespace Controllers;
    use League\Plates\Engine;

    class ErrorController
    {
        private Engine $_templates;

        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
        }

        public function displayError(string $message = "Une erreur inconnu est survenu.") : void 
        {
            ob_clean();
            http_response_code(500);

            echo $this->_templates->render('error', [
                'message' => $message
                ]);
            exit();
        } 
    }
?>