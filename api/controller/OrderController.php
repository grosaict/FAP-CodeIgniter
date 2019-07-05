<?php
    include_once 'model/Pizza.php';
    include_once 'DAO/PizzaDAO.php';

    class OrderController{
        public function submit_order($request, $response, $args)
        {
            $cart = (object) $request->getParsedBody();
            if (!isset($_SESSION['pizzas_cart'])) {
                session_start();
            }
            $_SESSION['pizzas_cart'][] = $pizza;

            $response = $response->withJson($_SESSION['pizzas_cart']);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            return $response;
        }
    }
?>