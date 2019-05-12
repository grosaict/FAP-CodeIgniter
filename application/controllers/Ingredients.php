<?php
class Ingredients extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $logged = $this->session->userdata('logged');
            if (!isset($logged) || $logged != true) {
                header("Location: ".$this->config->item('base_url'));
            }  
            $this->load->model('ingredients_model');
            $this->load->helper('url_helper');
    }

    public function list_all_ingredients(){
        $data['ingredients'] = $this->ingredients_model->return_all_ingredients();
        $this->load->view('ingredients/table', $data);
    }

    public function new_ingredient(){
        $data['ingredient'] = null;
        $this->load->helper('form');
        $this->load->view('ingredients/form', $data);
    }

    public function save_ingredient(){
        //Pega os dados e salva no banco
        $ingredient = (object) array(
            'id_ingredient' => $this->input->post('id_ingredient'),
            'ingredient'    => strtoupper($this->input->post('ingredient')),
            'ind_available' => $this->input->post('ind_available')
        );
        if ($this->validate_new_ingredient ($ingredient)) {
            if ($ingredient->id_ingredient == null) {
                $this->ingredients_model->insert_ingredient($ingredient);
            } else {
                $this->ingredients_model->update_ingredient($ingredient);
            }
            //Volta para a tabela mostrando msg de sucesso!
            $this->load->view('pages/success'); 
        } else {
            //Volta para a tabela mostrando msg de falha!
            $this->load->view('pages/failed');
        }
        $this->list_all_ingredients();
    }

    private function validate_new_ingredient ($new_ingredient) {
        //Define caracteres a serem desconsiderados
        $eliminate = array(" ", ".", "-", "_");
        //Retira caracteres antes de executar o teste
        $new_value = str_replace($eliminate, '', $new_ingredient->ingredient);
        //Verifica se não está vazio
        if ($new_ingredient->ingredient == '') : return false; endif;

        $ingredients = $this->ingredients_model->return_all_ingredients();

        foreach ($ingredients as $ingredients_item) :
            //Retira caracteres antes de executar o teste
            $ingredients_item['ingredient'] = str_replace($eliminate, '', $ingredients_item['ingredient']);
            if (    ($ingredients_item['ingredient'] == $new_value)
                &&  ($ingredients_item['id_ingredient'] != $new_ingredient->id_ingredient))
            : return false; endif;
        endforeach;
        return true;
    }

    public function update_ind_available($args){
        $id_ingredient = (int) $args;
        // Retorna o objeto ingrediente pelo id enviado por parâmetro
        $ingredient = $this->ingredients_model->return_ingredient($id_ingredient);

        // Altera o indicador de disponibilidade
        if ($ingredient->ind_available == false) {  $ingredient->ind_available = true;
        } else {                                    $ingredient->ind_available = false; }
        $this->ingredients_model->update_ingredient($ingredient);
        $this->list_all_ingredients();
    }

    public function update_ingredient($id_ingredient){
        $data['ingredient'] = $this->ingredients_model->return_ingredient($id_ingredient);
        $this->load->helper('form');
        $this->load->view('ingredients/form', $data);
    }
}