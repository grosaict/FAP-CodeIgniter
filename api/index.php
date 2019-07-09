<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once 'controller/CartController.php';
include_once 'controller/OrderController.php';
include_once 'controller/PizzaController.php';
include_once 'controller/WeatherController.php';
require 'vendor/autoload.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$app = new \Slim\App;

$app->group('/weather', function(){
    $this->get('','WeatherController:get_weather');
});

$app->group('/pizza', function(){
    $this->get('/get_available','PizzaController:get_available_pizzas');
});
$app->group('/cart', function(){
    $this->get('/get_cart','CartController:get_cart');
    $this->get('/total_cart','CartController:total_cart');
    $this->post('/add_pizza_cart','CartController:add_pizza_cart');
    $this->delete('/delete_pizza_cart/{index:[0-99]+}','CartController:delete_pizza_cart');
    $this->delete('/clean_cart','CartController:clean_cart');
});
$app->group('/order', function(){
    $this->get('','OrderController:get_last_orders');
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