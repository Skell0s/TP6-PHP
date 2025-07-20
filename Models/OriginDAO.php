<?php
    namespace Models;
    use Models\BasePDODAO;
    use Models\Origin;
    use PDO;

    class OriginDAO extends BasePDODAO
    {
        public function getAll() : array
        {
            $sql = "SELECT * FROM ORIGIN";
            $stmt = $this->execRequest($sql);
            $result = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $origin = new Origin();
                $origin = $origin->hydrate($row);
                $result[] = $origin;
            }

            return $result;
        }

        public function getByID(int $idOrigin) : ?Origin
        {
            $origin = null;
            $sql = 'SELECT * FROM ORIGIN WHERE id = :id';
            $result = $this->execRequest($sql, [':id' => $idOrigin]);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($row)
            {
                $origin = new Origin();
                $origin = $origin->hydrate($row);
            }
            return $origin;
        }

        public function create(Origin $origin) : Origin
        {
            $sql = "INSERT INTO ORIGIN (id, name, url_img) VALUES (:id, :name, :url_img)";
            $params = [
                ':id' => $origin->id(),
                ':name' => $origin->name(),
                ':url_img' => $origin->url_img()
            ];
            $result = $this->execRequest($sql, $params);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($row)
            {
                $origin = new Origin();
                $origin = $origin->hydrate($row);
            }
            return $origin;
        }

        public function delete(int $idOrigin = -1) : int
        {
            if ($idOrigin != -1)
            {
                $sql = "DELETE FROM ORIGIN WHERE id = :id";
                $params = [
                    ':id' => $idOrigin,
                ];
                $this->execRequest($sql, $params);
            }
            return 0;
        }

        public function edit(array $dataOrigin) : void
        {
            $sql = "UPDATE ORIGIN SET name = :name, url_img = :url_img WHERE id = :id";
            $params = [
                ':id' => $dataOrigin['id'],
                ':name' => $dataOrigin['name'],
                ':url_img' => $dataOrigin['url_img']
            ];
            $this->execRequest($sql, $params);
        }

        public function getOriginsForUnit(string $unitId) : array
        {
            $sql = "SELECT * FROM ORIGIN WHERE id IN (SELECT id_origin FROM UNITORIGIN WHERE id_unit = :id_unit)";
            $params = [':id_unit' => $unitId];
            $stmt = $this->execRequest($sql, $params);
            $result = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $origin = new Origin();
                $origin = $origin->hydrate($row);
                $result[] = $origin;
            }
            return $result;
        }
    }
?>