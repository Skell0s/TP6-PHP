<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Models\Unit;
    use Models\UnitDAO;
    use Exception;

    class UnitController
    {
        private Engine $_templates;
        private MainController $mainController;
        private UnitDAO $unitDAO;

        public function __construct(Engine $engine, MainController $mainController)
        {
            $this->_templates = $engine;
            $this->mainController = $mainController;
            $this->unitDAO = new UnitDAO();
        }

        public function displayAddUnit(?string $message = null) : void 
        {
            echo $this->_templates->render('add-unit', [
                'title' => 'Add Unit',
                'message' => $message
                ]);
        }

        public function displayAddOrigin() : void 
        {
            echo $this->_templates->render('add-origin', [
                'title' => 'Add Origin',
                ]);
        } 

        public function addUnit(array $unit) : void
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
                $message = "L'unité a été ajoutée avec succès !";
                $this->mainController->index($message);
            }
            catch (Exception $e)
            {
                $this->displayAddUnit("Erreur : " . $e->getMessage());
            }
        }
    }
?>