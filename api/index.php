<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once 'controller/CartController.php';
include_once 'controller/OrderController.php';
include_once 'controller/PizzaController.php';
require 'vendor/autoload.php';

$app = new \Slim\App;

$app->group('/pizza', function(){
    $this->get('/get_available','PizzaController:get_available_pizzas');
});
$app->group('/cart', function(){
    $this->post('/add_pizza_cart','CartController:add_pizza_cart');
    $this->get('/get_cart','CartController:get_cart');
    $this->get('/count','CartController:count_cart');
    $this->delete('/delete_pizza_cart/{index:[0-99]+}','CartController:delete_pizza_cart');
    $this->delete('/clean_cart','CartController:clean_cart');
});
$app->group('/order', function(){
    $this->get('','OrderController:get_order');
    $this->post('','OrderController:submit_order');
});

try
{
    $app->run();
}
catch (Exception $error)
{
    echo ("\o/ ".$error);
}
?>