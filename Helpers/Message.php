<?php
    namespace Helpers;

    class Message
    {
        public const MESSAGE_COLOR_SUCCESS = 'green';
        public const MESSAGE_COLOR_ERROR = 'red';
        public const MESSAGE_COLOR_INFO = 'blue';
        public const MESSAGE_COLOR_WARNING = 'orange';

        private string $text;
        private string $type;
        private string $title;

        public function __construct(string $text, string $type = self::MESSAGE_COLOR_INFO, string $title = '')
        {
            $this->text = $text;
            $this->type = $type;
            $this->title = $title;
        }

        public function getText(): string
        {
            return $this->text;
        }

        public function getType(): string
        {
            return $this->type;
        }

        public function getTitle(): string
        {
            return $this->title;
        }
    }
?>