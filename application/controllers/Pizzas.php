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
            // Retorna a array de pizza_ingredients
            $pizza_ingredients = $this->pizza_ingredients_model->return_all_pizza_ingredients($pizzas_item['id_pizza']);

            // Percorre array para buscar descrição por id e já concatena em uma string
            foreach ($pizza_ingredients as $pizza_ingredients_item):
                $ingredient = $this->ingredients_model->return_ingredient($pizza_ingredients_item['id_ingredient']);
                //echo '<pre>'; print_r($ingredient);
                if ($ingredient->ind_available == true) {
                    $pizzas_item['pizza_ingredients'] = $pizzas_item['pizza_ingredients'].$ingredient->ingredient.', ';
                } else {
                    $pizzas_item['pizza_ingredients'] = $pizzas_item['pizza_ingredients'].'<strike>'.$ingredient->ingredient.'</strike>, ';
                }
            endforeach;
            // Retira a última vírgula
            $size = strlen($pizzas_item['pizza_ingredients']);
            $pizzas_item['pizza_ingredients'] = substr($pizzas_item['pizza_ingredients'],0, $size-2);

            // Monta novo array de pizzas já com os ingredientes
            $new_pizzas[] = $pizzas_item;
        endforeach;

        // Inclui o array no parâmetro 'pizzas' para ser usado pela view
        $data['pizzas'] = $new_pizzas;
        $this->load->view('pizzas/table', $data);
    }

    public function new_pizza(){
        $data['pizza'] = null;
        $data['ingredients'] = $this->ingredients_model->return_all_ingredients();
        $this->load->helper('form');
        $this->load->view('pizzas/form', $data);
    }

    public function save_pizza(){
        //Pega os dados e salva no banco
        echo print_r($this->input->post('check'));
        $pizza_ingredients[] = '';
        (isset($var)) ? $pizza_ingredients[] = '' : '';
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