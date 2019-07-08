<?php
    class Pizza {
        public $id_pizza;
        public $pizza;
        public $price;
        public $ingredients;

        function __construct($id_pizza, $pizza, $price, $ingredients){
            $this->id_pizza     = $id_pizza;
            $this->pizza        = $pizza;
            $this->price        = $price;
            $this->ingredients  = $ingredients;
        }
    }
?>