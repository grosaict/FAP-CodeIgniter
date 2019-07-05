<?php
    include_once 'model/Pizza.php';
    include_once 'DAO/PizzaDAO.php';

    class PizzaController{
        public function get_available_pizzas($request, $response)
        {
            $dao = new PizzaDAO;    
            $pizzas = $dao->get_available_pizzas();

            $response = $response->withJson($pizzas);
            $response = $response->withHeader('Content-type', 'application/json');
            $response = $response->withStatus(200);
            return $response;
        }
    }
?>
