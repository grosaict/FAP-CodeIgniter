<?php
    class Pizza {
        public $id_pizza;
        public $pizza;
        public $ingredients;

        function __construct($id_pizza, $pizza, $ingredients){
            $this->id_pizza     = $id_pizza;
            $this->pizza        = $pizza;
            $this->ingredients  = $ingredients;
        }
    }
?>