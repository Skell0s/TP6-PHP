<?php
    namespace Models;
    use Models\OriginDAO;
    use Models\Unit;
    class UnitFactory 
    {
        private OriginDAO $originDAO;

        public function __construct(OriginDAO $originDAO) 
        {
            $this->originDAO = $originDAO;
        }

        public function build(array $data): Unit {
            $unit = new Unit($data);

            $origins = $this->originDAO->getOriginsForUnit($unit->id());
            $unit->setOrigin($origins);

            return $unit;
        }
    }
?>