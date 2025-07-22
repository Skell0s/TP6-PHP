<?php
    namespace Models;

    class Unit
    {
        private ?string $id;
        private string $name;
        private int $cost;
        private ?array $origin;
        private string $url_img;



        public function id() : ?string
        {
            return $this->id;
        }
        public function setId(string $id) : void
        {
            $this->id = $id;
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

        public function origin() : ?array
        {
            return $this->origin;
        }
        public function setOrigin(?array $origin) : void
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



        public function __construct(array $data = ['id' => '', 'name' => '', 'cost' => 0, 'origin' => [], 'url_img' => ''])
        {
            $this->hydrate($data);
        }



        public function addOrigin(Origin $origin) : void
        {
            if (!in_array($origin, $this->origin))
            {
                $this->origin[] = $origin;
            }
        }

        public function hydrate(array $data)
        {
            foreach ($data as $key => $value)
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