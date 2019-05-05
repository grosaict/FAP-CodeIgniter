<?php
class PizzaIngredients extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model('pizza_ingredients_model');
            $this->load->helper('url_helper');
    }

    private function return_pizza_ingredients ($id_pizza) {
        
        return $str_ingredients;
    }
}