<?php
    class Pizza {
        public $id_pizza;
        public $pizza;
        public $available;
        public $ingredients;

        function __construct($id_pizza, $pizza, $available, $ingredients){
            $this->id_pizza     = $id_pizza;
            $this->pizza        = $pizza;
            $this->available    = $available;
            $this->ingredients  = $ingredients;
        }
    }
?>