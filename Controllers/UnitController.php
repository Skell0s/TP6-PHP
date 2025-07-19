<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Models\Unit;
    use Models\UnitDAO;
    use Exception;
    use Helpers\Message;

    class UnitController
    {
        private Engine $_templates;
        private MainController $mainController;
        private ErrorController $errorController;
        private UnitDAO $unitDAO;

        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
            $this->mainController = new MainController($engine);
            $this->errorController = new ErrorController($engine);
            $this->unitDAO = new UnitDAO();
        }

        public function displayAddUnit(?string $message = null, ?array $unit = null) : void 
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
            echo $this->_templates->render('add-unit', [
                'title' => $title,
                'action' => $action,
                'message' => $message,
                'unit' => $unit,
                'boutonText' => $boutonText
                ]);
        }

        public function displayAddOrigin() : void 
        {
            echo $this->_templates->render('add-origin', [
                'title' => 'Add Origin',
                ]);
        } 

        public function addUnit(array $unit, ?string $message = "") : void
        {
            try
            {
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
                $this->displayAddUnit("Erreur : " . $e->getMessage());
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
                $this->mainController->index("Erreur : " . $e->getMessage());
            }
        }

        public function displayEditUnit(string $idUnit)
        {
            $unit = $this->unitDAO->getByID($idUnit);
            $this->DisplayAddUnit(null, [
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
                $unit = new Unit();
                $unit->hydrate($dataUnit);
                $this->unitDAO->editUnitAndIndex($dataUnit);
                $message = "L'unité a été modifiée avec succès !";
                $this->mainController->index($message);
            }
            catch (Exception $e)
            {
                $this->displayEditUnit("Erreur lors de la modification : " . $e->getMessage());
            }
        }
    }
?>