<?php
    namespace Models;
    use Models\BasePDODAO;
    use Models\Unit;
    use PDO;

    class UnitDAO extends BasePDODAO
    {
        private UnitFactory $unitFactory;



        public function __construct()
        {
            $this->unitFactory = new UnitFactory(new OriginDAO());
        }



        public function getAll() : array
        {
            $sql = "SELECT * FROM UNIT";
            $stmt = $this->execRequest($sql);
            $result = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $unit = $this->unitFactory->build($row);
                $result[] = $unit;
            }

            return $result;
        }

        public function getByID(string $idUnit) : ?Unit
        {
            $unit = null;
            $sql = 'SELECT * FROM UNIT WHERE id = :id';
            $result = $this->execRequest($sql, [':id' => $idUnit]);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($row)
            {
                $unit = $this->unitFactory->build($row);
            }
            return $unit;
        }

        public function createUnit(Unit $unit) : void
        {
            $sql = "INSERT INTO UNIT (id, name, cost, url_img) VALUES (:id, :name, :cost, :url_img)";
            $params = [
                ':id' => $unit->id(),
                ':name' => $unit->name(),
                ':cost' => $unit->cost(),
                ':url_img' => $unit->url_img()
            ];
            $this->execRequest($sql, $params);
            foreach ($unit->origin() as $origin)
            {
                $sql = "INSERT INTO UNITORIGIN (id, id_unit, id_origin) VALUES (:id, :id_unit, :id_origin)";
                $params = [
                    ':id' => random_int(-1000000000, 1000000000),
                    ':id_unit' => $unit->id(),
                    ':id_origin' => $origin['id']
                ];
                $this->execRequest($sql, $params);
            }
        }

        public function deleteUnit(string $idUnit = "-1") : void
        {
            if ($idUnit != "-1")
            {
                $sql = "DELETE FROM UNIT WHERE id = :id";
                $params = [
                    ':id' => $idUnit,
                ];
                $this->execRequest($sql, $params);
            }
        }

        public function editUnitAndIndex(array $dataUnit) : void
        {
            $sql = "UPDATE UNIT SET name = :name, cost = :cost, url_img = :url_img WHERE id = :id";
            $params = [
                ':id' => $dataUnit['id'],
                ':name' => $dataUnit['name'],
                ':cost' => $dataUnit['cost'],
                ':url_img' => $dataUnit['url_img']
            ];
            $this->execRequest($sql, $params);

            // Suppression des anciennes origines
            $sql = "DELETE FROM UNITORIGIN WHERE id_unit = :id_unit";
            $params = [
                ':id_unit' => $dataUnit['id'],
            ];
            $this->execRequest($sql, $params);

            // Insertion des nouvelles origines
            foreach ($dataUnit['origin'] as $origin)
            {
                $sql = "INSERT INTO UNITORIGIN (id, id_unit, id_origin) VALUES (:id, :id_unit, :id_origin)";
                $params = [
                    ':id' => random_int(-1000000000, 1000000000),
                    ':id_unit' => $dataUnit['id'],
                    ':id_origin' => $origin['id']
                ];
                $this->execRequest($sql, $params);
            }
        }
    }
?>