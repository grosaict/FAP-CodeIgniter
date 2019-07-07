<?php
    class Order {
        public $id_order;
        public $client;
        public $cart;

        function __construct($client, $cart){
            $this->client   = $client;
            $this->cart     = $cart;
        }
    }
?>