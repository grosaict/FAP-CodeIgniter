<?php
    class Client {
        public $id;
        public $name;
        public $mobile;
        public $message;

        function __construct($id, $name, $mobile, $message){
            $this->id       = $id;
            $this->name     = $name;
            $this->mobile   = $mobile;
            $this->message  = $message;
        }
    }
?>