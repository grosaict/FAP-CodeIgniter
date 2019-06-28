<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once 'controller/PizzaController.php';
require 'vendor/autoload.php';

$app = new \Slim\App;

$app->group('/pizza', function(){
    $this->get('','PizzaController:get_pizzas');
});

try
{
    $app->run();
}
catch (Exception $e)
{
    echo ("\o/ ".$e);
}
?>