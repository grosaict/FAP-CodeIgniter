<?php
    class Order {
        public $id_order;
        public $client;
        public $items;
        public $date;

        function __construct($id_order, $client, $items, $date){
            $this->id_order = $id_order;
            $this->client   = $client;
            $this->items    = $items;
            $this->date     = $date;
        }
    }
?>