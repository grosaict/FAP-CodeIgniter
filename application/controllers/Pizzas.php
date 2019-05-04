<?php
class Pizzas extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model('pizzas_model');
            $this->load->helper('url_helper');
    }

    public function list_all_pizzas(){
        $data['pizzas'] = $this->pizzas_model->return_all_pizzas();
        $this->load->view('pizzas/table', $data);
        //, $data
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