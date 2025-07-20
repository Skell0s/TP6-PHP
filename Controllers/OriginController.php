<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Models\Origin;
    use Models\OriginDAO;
    use Exception;
    use Helpers\Message;

    class OriginController
    {
        private Engine $_templates;
        private MainController $mainController;
        private ErrorController $errorController;
        private OriginDAO $originDAO;



        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
            $this->mainController = new MainController($engine);
            $this->errorController = new ErrorController($engine);
            $this->originDAO = new OriginDAO();
        }



        public function displayOrigin(?Message $message = null, ?array $origin = null) : void 
        {
            if ($origin == null)
            {
                $title = 'Add Origin';
                $action = 'add-origin';
                $boutonText = 'Ajouter';
            }
            else
            {
                $title = 'Edit Origin';
                $action = 'edit-origin';
                $boutonText = 'Modifier';
            }

            $dao = new OriginDAO();
            $getAll = $dao->getAll();

            echo $this->_templates->render('add-origin', [
                'title' => $title,
                'action' => $action,
                'message' => $message,
                'origin' => $origin,
                'boutonText' => $boutonText,
                'listOrigin' => $getAll,
                ]);
        } 

        public function addOrigin(array $origin, ?Message $message = new Message("Origine ajoutée avec succès !", Message::MESSAGE_COLOR_SUCCESS, "Succès")) : void
        {
            try
            {
                $data = [
                    "id" => random_int(-1000000000, 1000000000),
                    "name" => $origin['name'],
                    "url_img" => $origin['url_img']
                ];

                $origin = new Origin();
                $origin = $origin->hydrate($data);
                $this->originDAO->create($origin);
                $this->displayOrigin($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur lors de l'ajout de l'origine : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displayOrigin($message);
            }
        }

        public function deleteOriginAndIndex(string $idOrigin)
        {
            try
            {
                $this->originDAO->delete($idOrigin);
                $message = new Message("L'origine a été supprimée avec succès !", Message::MESSAGE_COLOR_SUCCESS, "Succès");
                $this->displayOrigin($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displayOrigin($message);
            }
        }

        public function editOriginAndIndex(array $dataOrigin)
        {
            try
            {
                $origin = new Origin();
                $origin->hydrate($dataOrigin);
                $this->originDAO->edit($dataOrigin);
                $message = new Message("L'origine a été modifiée avec succès !", Message::MESSAGE_COLOR_SUCCESS, "Succès");
                $this->displayOrigin($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur lors de la modification : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displayOrigin($message);
            }
        }

        public function displayEditOrigin(int $idOrigin)
        {
            $origin = $this->originDAO->getByID($idOrigin);
            $this->DisplayOrigin(null, [
                'id' => $origin->id(),
                'name' => $origin->name(),
                'url_img' => $origin->url_img()
            ]);
        }
    }
?>