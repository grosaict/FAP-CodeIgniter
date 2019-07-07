<?php
    class CartController{
        public function get_cart($request, $response)
        {
            session_start();
            if (isset($_SESSION['pizzas_cart']))
            {
                $cart = $_SESSION['pizzas_cart'];
            } else {
                $cart = null;
            }
            $response = $response->withJson($cart);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(200);
            return $response;
        }

        public function add_pizza_cart($request, $response, $args)
        {
            $pizza = (object) $request->getParsedBody();
            session_start();
            $_SESSION['pizzas_cart'][] = $pizza;

            $response = $response->withJson($_SESSION['pizzas_cart']);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            return $response;
        }

        public function delete_pizza_cart($request, $response, $args)
        {
            session_start();
            $index_cart = (int) $args['index'];
            $item_cart_deleted = $_SESSION['pizzas_cart'][$index_cart];
            if (count($_SESSION['pizzas_cart']) == 1)
            {
                session_unset();
                session_destroy();
                $new_cart = null;
            } else {
                $new_cart = [];
                foreach ($_SESSION['pizzas_cart'] as $key => $item_cart)
                {
                    if ($index_cart != $key) { $new_cart[] = $item_cart; }
                }
                $_SESSION['pizzas_cart'] = $new_cart;
            }
            $response = $response->withJson($_SESSION['pizzas_cart']);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(202);
            return $response;
        }

        public function clean_cart($request, $response)
        {
            session_start();
            session_unset();
            session_destroy();
            $response = $response->withJson(null);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(202);
            return $response;
        }

        public function count_cart($request, $response)
        {
            session_start();
            if (!isset($_SESSION['pizzas_cart'])) {
                $count = 0;
            } else {
                $count = count($_SESSION['pizzas_cart']);
            }
            echo $count;
            $response = $response->withJson($count);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            return $response;
        }
    }
?>