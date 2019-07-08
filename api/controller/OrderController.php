<?php
    include_once 'dao/OrderDAO.php';
    include_once 'model/Order.php';

    class OrderController{
        public function get_last_orders($request, $response)
        {
            $dao = new OrderDAO;
            $orders = $dao->get_last_orders();

            $response = $response->withJson($orders);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(200);
            return $response;
        }

        public function submit_order($request, $response, $args)
        {
            session_start();
            if (isset($_SESSION['pizzas_cart'])) {
                $client = $request->getParsedBody();
                $order = new Order(null, $client, $_SESSION['pizzas_cart'], date("Y-m-d H:i:s"));
                $dao = new OrderDAO;
                $order = $dao->create_order($order);
                foreach($order->items as $item){
                    $item = new Item($order->id_order, $item->id_pizza, $item->pizza, $item->price);
                    $dao->create_item($item);
                }
                $response = $response->withJson($order);
                $response = $response->withHeader('Content-type', 'application/json');    
                $response = $response->withStatus(201);
                session_unset();
                session_destroy();
                return $response;
            }
            return false;
        }
    }
?>