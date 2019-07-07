<?php
    include_once 'model/Order.php';

    class OrderController{
        public function get_order($request, $response)
        {
            session_start();
            if (isset($_SESSION['order']))
            {
                $order = $_SESSION['order'];
            } else {
                $order = null;
            }
            $response = $response->withJson($order);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(200);
            return $response;
        }

        public function submit_order($request, $response, $args)
        {
            session_start();
            if (isset($_SESSION['pizzas_cart'])) {
                $client = $request->getParsedBody();
                $order = new Order($client, $_SESSION['pizzas_cart']);
                $_SESSION['order'] = $order;
            }

            // $dao = new OrderDAO;
            // $order = $dao->create($order);

            $response = $response->withJson($order);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            // session_unset();
            // session_destroy();
            return $response;
        }
    }
?>