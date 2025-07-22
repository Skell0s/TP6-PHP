<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Models\Unit;
    use Models\UnitDAO;
    use Models\OriginDAO;
    use Models\UnitFactory;
    use Exception;
    use Helpers\Message;

    class UnitController
    {
        private Engine $_templates;
        private MainController $mainController;
        private ErrorController $errorController;
        private UnitDAO $unitDAO;
        private OriginDAO $originDAO;
        private UnitFactory $unitFactory;



        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
            $this->mainController = new MainController($engine);
            $this->errorController = new ErrorController($engine);
            $this->unitDAO = new UnitDAO();
            $this->originDAO = new OriginDAO();
            $this->unitFactory = new UnitFactory($this->originDAO);
        }



        public function displayAddUnit(?Message $message = null, ?array $unit = null) : void 
        {
            if ($unit == null)
            {
                $title = 'Add Unit';
                $action = 'add-unit';
                $boutonText = 'Ajouter';
            }
            else
            {
                $title = 'Edit Unit';
                $action = 'edit-unit';
                $boutonText = 'Modifier';
            }
            $files = scandir('public/img/');
            $files = array_diff($files, ['.', '..']);
            echo $this->_templates->render('add-unit', [
                'title' => $title,
                'action' => $action,
                'message' => $message,
                'unit' => $unit,
                'origins' => $this->originDAO->getAll(),
                'boutonText' => $boutonText,
                'files' => $files
                ]);
        }

        public function addUnit(array $unit, ?Message $message = null) : void
        {
            try
            {
                $this->isDifferent($unit['origin']);
                $data = [
                    "id" => uniqid(),
                    "name" => $unit['name'],
                    "cost" => $unit['cost'],
                    "origin" => $unit['origin'],
                    "url_img" => $unit['url_img']
                ];

                $unit = new Unit();
                $unit = $unit->hydrate($data);
                $this->unitDAO->createUnit($unit);
                $this->mainController->index($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur lors de l'ajout de l'unité : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displayAddUnit($message);
            }
        }

        public function deleteUnitAndIndex(string $idUnit)
        {
            try
            {
                $this->unitDAO->deleteUnit($idUnit);
                $message = new Message("L'unité a été supprimée avec succès !", Message::MESSAGE_COLOR_SUCCESS, "Succès");
                $this->mainController->index($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->mainController->index($message);
            }
        }

        public function displayEditUnit(string $idUnit, ?Message $message = null)
        {
            $unit = $this->unitDAO->getByID($idUnit);
            $this->DisplayAddUnit($message, [
                'id' => $unit->id(),
                'name' => $unit->name(),
                'cost' => $unit->cost(),
                'origin' => $unit->origin(),
                'url_img' => $unit->url_img()
            ]);
        }

        public function editUnitAndIndex(array $dataUnit)
        {
            try
            {
                $this->isDifferent($dataUnit['origin']);
                $unit = new Unit();
                $unit->hydrate($dataUnit);
                $this->unitDAO->editUnitAndIndex($dataUnit);
                $message = new Message("L'unité a été modifiée avec succès !", Message::MESSAGE_COLOR_SUCCESS, "Succès");
                $this->mainController->index($message);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur lors de la modification : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displayEditUnit($dataUnit['id'], $message);
            }
        }

        private function isDifferent(array $origins) : void
        {
            $diff = [];
            foreach ($origins as $origin)
            {
                if ($origin['id'] != null)
                {
                    $diff[] = $origin['id'];
                }
            }
            if (count($diff) != count(array_unique($diff)))
            {
                throw new Exception("Les origines doivent être uniques.");
            }
        }
    }
?>