<?php
    class Ingredient {
        public $id_ingredient;
        public $ingredient;
        public $available;

        function __construct($id_ingredient, $ingredient, $available){
            $this->id_ingredient    = $id_ingredient;
            $this->ingredient       = $ingredient;
            $this->available        = $available;
        }
    }
?>