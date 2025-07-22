<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Helpers\Message;

    class ErrorController
    {
        private Engine $_templates;

        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
        }

        public function displayError(string $text = "Une erreur inconnu est survenu.") : void 
        {
            $message = new Message($text, Message::MESSAGE_COLOR_ERROR, "Erreur");
            ob_clean();
            http_response_code(500);

            echo $this->_templates->render('error', [
                'message' => $message
                ]);
            exit();
        } 
    }
?>