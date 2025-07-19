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

        public function createUnit(Unit $unit) : void
        {
            $sql = "INSERT INTO UNIT (id, name, cost, origin, url_img) VALUES (:id, :name, :cost, :origin, :url_img)";
            $params = [
                ':id' => $unit->id(),
                ':name' => $unit->name(),
                ':cost' => $unit->cost(),
                ':origin' => $unit->origin(),
                ':url_img' => $unit->url_img()
            ];
            $this->execRequest($sql, $params);
        }

        public function deleteUnit(int $idUnit = -1) : void
        {
            if ($idUnit > 0)
            {
                $sql = "DELETE FROM UNIT WHERE id = :id";
                $params = [
                    ':id' => $idUnit,
                ];
                $this->execRequest($sql, $params);
            }
        }
    }
?>