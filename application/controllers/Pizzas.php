<?php
class Pizzas extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model('pizzas_model');
            $this->load->model('ingredients_model');
            $this->load->model('pizza_ingredients_model');
            $this->load->helper('url_helper');
    }

    public function list_all_pizzas(){
        // Retorna todas as pizzas
        $pizzas = $this->pizzas_model->return_all_pizzas();

        // Percorre a lista de pizzas para montar string de ingredientes concatenada
        foreach ($pizzas as $pizzas_item):
            $pizzas_item['pizza_ingredients'] = "";
            // retorna a array de pizza_ingredients
            $pizza_ingredients = $this->pizza_ingredients_model->return_all_pizza_ingredients($pizzas_item['id_pizza']);
            echo print_r($pizza_ingredients);

            // percorre array para buscar descrição por id e já concatena a string
            //foreach ($pizza_ingredients as $pizza_ingredients_item):
                //$ingredient = $this->ingredients_model->return_ingredient($pizza_ingredients_item['id_ingredient']);
                //echo print_r($ingredient);
                //$pizzas_item['pizza_ingredients'] = $pizzas_item['pizza_ingredients'].', '.$ingredient['id_ingredient'];
            //endforeach;
            //echo $pizzas_item['id_pizza'] ."-". $pizzas_item['pizza_ingredients'];
        endforeach;


        //SELECT * FROM `tb_pizza`, `tb_ingredient_pizza`, `tb_ingredient` WHERE `tb_pizza`.`id_pizza` = `tb_ingredient_pizza`.`id_pizza`
        //<h4 style="color:red">Operação não realizada. Item já cadastrado!</h4>


        // Cria o parâmetro 'pizzas' para ser usado pela view
        $data['pizzas'] = $pizzas;
        $this->load->view('pizzas/table', $data);
    }

    public function new_pizza(){
        $this->load->helper('form');
        $this->load->view('pizzas/form');
        
    }

    public function save_pizza(){
        //Pega os dados e salva no banco
        $pizza = array(
            'pizza' => strtoupper($this->input->post('pizza'))
        );
        if ($this->validate_new_pizza ($pizza['pizza'])) {
            $this->pizzas_model->insert_pizza($pizza);
            //Volta para a tabela mostrando msg de sucesso!
            $this->load->view('pages/success'); 
        } else {
            //Volta para a tabela mostrando msg de falha!
            $this->load->view('pages/failed');
        }
        $this->list_all_pizzas();
    }

    private function validate_new_pizza ($new_pizza) {
        $pizzas = $this->pizzas_model->return_all_pizzas();

        //Define caracteres a serem desconsiderados
        $eliminate = array(" ", ".", "-", "_");
        $new_pizza = str_replace($eliminate, '', $new_pizza);

        //Retira caracteres antes de executar o teste
        foreach ($pizzas as $pizzas_item) :
            $pizzas_item['pizza'] = str_replace($eliminate, '', $pizzas_item['pizza']);
            if ($pizzas_item['pizza'] == $new_pizza) :
                return false;
            endif;
        endforeach;
        return true;
    }
}