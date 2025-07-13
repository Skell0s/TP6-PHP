<?php
    namespace Models;

    class Unit
    {
        private ?string $_id;
        private string $name;
        private int $cost;
        private string $origin;
        private string $url_img;



        public function id() : ?string
        {
            return $this->_id;
        }
        public function setId(string $id) : void
        {
            $this->_id = $id;
        }

        public function name() : string
        {
            return $this->name;
        }
        public function setName(string $name) : void
        {
            $this->name = $name;
        }

        public function cost() : int
        {
            return $this->cost;
        }
        public function setCost(int $cost) : void
        {
            $this->cost = $cost;
        }

        public function origin() : string
        {
            return $this->origin;
        }
        public function setOrigin(string $origin) : void
        {
            $this->origin = $origin;
        }

        public function url_img() : string
        {
            return $this->url_img;
        }
        public function setUrlImg(string $url_img) : void
        {
            $this->url_img = $url_img;
        }



        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                $method = 'set' . str_replace('_', '', ucwords($key, '_'));
                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
            return $this;
        }
    }
?>