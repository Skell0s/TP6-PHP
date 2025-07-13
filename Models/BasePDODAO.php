<?php
    namespace Models;
    use Config\Config;
    use PDO;
    use PDOStatement;

    class BasePDODAO
    {
        private PDO $_db;

        protected function execRequest(string $sql, array $params = null) : PDOStatement|false
        {
            $query = $this->getDB()->prepare($sql);
            if ($params != null) {
                foreach ($params as $key => $value) {
                    $query->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
            $query->execute();
            return $query;
        }

        private function getDB() : PDO
        {
            if (!isset($this->_db)) {
                $dsn = Config::get('dsn');
                $user = Config::get('user');
                $pass = Config::get('pass');
                $this->_db = new PDO($dsn, $user, $pass);
            }
            return $this->_db;
        }
    }
?>