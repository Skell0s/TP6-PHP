<?php
    namespace Controllers;
    use League\Plates\Engine;
    use Models\UnitDAO;
    use Models\OriginDAO;
    use Exception;
    use Helpers\Message;

    class SearchController
    {
        private Engine $_templates;
        private UnitDAO $unitDAO;
        private OriginDAO $originDAO;

        public function __construct(Engine $engine)
        {
            $this->_templates = $engine;
            $this->unitDAO = new UnitDAO();
            $this->originDAO = new OriginDAO();
        }

        public function displaySearch(?Message $message = null, ?array $listUnit = null, ?array $listOrigin = null) : void 
        {
            echo $this->_templates->render('search', [
                'title' => 'Search',
                'listUnit' => $listUnit,
                'listOrigin' => $listOrigin,
                'message' => $message
                ]);
        }

        public function search(array $params) : void
        {
            try
            {
                $searchTerm = $params['search'];
                $type = $params['type'];
                if ($type == 'origin')
                {
                    $listUnit = null;
                    $type = 'name';
                }
                else
                {
                    $listUnit = $this->unitDAO->search($type, $searchTerm);
                }
                if ($type == 'cost')
                {
                    $listOrigin = null;
                    $type = 'cost';
                }
                else
                {
                    $listOrigin = $this->originDAO->search($type, $searchTerm);
                }
                $message = new Message("Recherche effectuée avec succès.", Message::MESSAGE_COLOR_SUCCESS, "Succès");
                $this->displaySearch($message, $listUnit, $listOrigin);
            }
            catch (Exception $e)
            {
                $message = new Message("Erreur lors de la recherche : " . $e->getMessage(), Message::MESSAGE_COLOR_ERROR, "Erreur");
                $this->displaySearch($message);
            }
        }
    }
?>