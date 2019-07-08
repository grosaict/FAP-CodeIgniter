<?php
class Pizzas extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model('memberships_model');
            if ($this->memberships_model->access_level() == 0){
                header("Location: ".$this->config->item('base_url')."/logoff");
            }
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

    public function save_pizza(){
        //Salva o nome da pizza em uma row de um array
        $pizza = (object) array(
            'id_pizza'  => $this->input->post('id_pizza'),
            'pizza'     => strtoupper($this->input->post('pizza')),
            'price'     => $this->input->post('price')
        );
        //Valida o nome da pizza informado pelo usuário
        if ($this->validate_new_pizza ($pizza)) {
            //Retorna a lista de ingredientes selecionada no formulário
            $pizza_ingredients = $this->input->post('ing_checked');

            if ($pizza->id_pizza == null) {
                //Insere pizza no BD e retorna seu id
                $this->pizzas_model->insert_pizza($pizza);
                $pizza->id_pizza  = $this->db->insert_id();
           } else {
                //Atualiza nome e preço da pizza no BD
                $this->pizzas_model->update_pizza($pizza);
                //Excluir os ingredientes da pizza para atualização
                $this->pizza_ingredients_model->delete_pizza_ingredients($pizza->id_pizza);
            }
            //Atualiza os ingredientes da pizza
            isset($pizza_ingredients) ? $this->update_pizza_ingredients($pizza->id_pizza, $pizza_ingredients) : "";
             //Volta para a tabela mostrando msg de sucesso!
            $this->load->view('pages/success'); 
        } else {
            //Volta para a tabela mostrando msg de falha!
            $this->load->view('pages/failed');
        }
        $this->list_all_pizzas();
    }

    public function new_pizza(){
        $data['pizza'] = null;
        $data['ingredients'] = $this->ingredients_model->return_all_ingredients();
        $data['pizza_ingredients']  = null;
        $this->load->helper('form');
        $this->load->view('pizzas/form', $data);
    }

    public function update_pizza($id_pizza){
        $data['pizza']              = $this->pizzas_model->return_pizza_byId($id_pizza);
        $data['ingredients']        = $this->ingredients_model->return_all_ingredients();
        $data['pizza_ingredients']  = $this->pizza_ingredients_model->return_all_pizza_ingredients($id_pizza);
        $this->load->helper('form');
        $this->load->view('pizzas/form', $data);
    }

    private function update_pizza_ingredients($new_id_pizza, $pizza_ingredients) {
        foreach ($pizza_ingredients as $pizza_ingredients_item) :
            $pizza_ingredient = array(
                'id_pizza'      => $new_id_pizza,
                'id_ingredient' => $pizza_ingredients_item
            );
            $this->pizza_ingredients_model->insert_pizza_ingredient($pizza_ingredient);
        endforeach;
    }

    public function delete_pizza($id_pizza){
        $pizza  = $this->pizzas_model->return_pizza_byId($id_pizza);
        if (isset($pizza)) {
            $this->pizza_ingredients_model->delete_pizza_ingredients($id_pizza);
            $this->pizzas_model->delete_pizza($id_pizza);
            $this->load->view('pages/success');
        }else{
            $this->load->view('pages/delete_failed');
        };
        $this->list_all_pizzas();
    }

    private function validate_new_pizza ($new_pizza) {
        $pizzas = $this->pizzas_model->return_all_pizzas();

        //Define caracteres a serem desconsiderados
        $eliminate  = array(" ", ".", "-", "_");
        $new_value  = str_replace($eliminate, '', $new_pizza->pizza);

        //Retira caracteres antes de executar o teste
        foreach ($pizzas as $pizzas_item) :
            $pizzas_item['pizza'] = str_replace($eliminate, '', $pizzas_item['pizza']);
            if (    $pizzas_item['pizza'] == $new_value
                &&  $pizzas_item['id_pizza'] != $new_pizza->id_pizza) :
                return false;
            endif;
        endforeach;
        return true;
    }
}