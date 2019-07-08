<?php
    class Item {
        public $id_order;
        public $id_item;
        public $desc_item;
        public $price_item;

        function __construct($id_order, $id_item, $desc_item, $price_item){
            $this->id_order     = $id_order;
            $this->id_item      = $id_item;
            $this->desc_item    = $desc_item;
            $this->price_item   = $price_item;
        }
    }
?>