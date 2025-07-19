<?php
    namespace Helpers;

    class Message
    {
        public const MESSAGE_COLOR_SUCCESS = 'success';
        public const MESSAGE_COLOR_ERROR = 'danger';
        public const MESSAGE_COLOR_INFO = 'info';
        public const MESSAGE_COLOR_WARNING = 'warning';

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