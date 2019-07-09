<?php
    class Item {
        public $internal_id;
        public $id_order;
        public $id_item;
        public $desc_item;
        public $price_item;

        function __construct($internal_id, $id_order, $id_item, $desc_item, $price_item){
            $this->internal_id  = $internal_id;
            $this->id_order     = $id_order;
            $this->id_item      = $id_item;
            $this->desc_item    = $desc_item;
            $this->price_item   = $price_item;
        }
    }
?>