<?php
    namespace Models;

    class Origin
    {
        private ?int $id;
        private string $name;
        private string $url_img;



        public function id() : ?int
        {
            return $this->id;
        }
        public function setId(int $id) : void
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

        public function url_img() : string
        {
            return $this->url_img;
        }
        public function setUrlImg(string $url_img) : void
        {
            $this->url_img = $url_img;
        }



        public function _construct(Array $data)
        {
            $this->hydrate($data);
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