<?php
    namespace Models;
    use Models\BasePDODAO;
    use Models\Unit;
    use PDO;

    class UnitDAO extends BasePDODAO
    {
        public function getAll() : array
        {
            $sql = "SELECT * FROM UNIT";
            $stmt = $this->execRequest($sql);
            $result = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $unit = new Unit();
                $unit = $unit->hydrate($row);
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
                $unit = new Unit();
                $unit = $unit->hydrate($row);
            }
            return $unit;
        }
    }
?>