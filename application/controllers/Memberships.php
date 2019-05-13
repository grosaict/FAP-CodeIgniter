<?php
class Memberships extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model('memberships_model');
            if ($this->memberships_model->access_level() == 0){
                header("Location: ".$this->config->item('base_url')."/logoff");
            }
            $this->load->helper('url_helper');
    }

    public function list_all_memberships(){
        $access_level = $this->memberships_model->access_level();
        if ($access_level == 2 || $access_level == 9) {
            $data['memberships']    = $this->memberships_model->return_all_memberships();
            $data['access_level']   = $this->memberships_model->access_level();
            $this->load->view('memberships/table', $data);
        } else {
            header("Location: ".$this->config->item('base_url'));
        }
    }

    public function new_membership(){
        $data['membership'] = null;
        $this->load->helper('form');
        $this->load->view('memberships/form', $data);
    }

    public function save_membership(){
        //Pega os dados e salva no banco
        $membership = (object) array(
            'id_membership' => $this->input->post('id_membership'),
            'username'      => $this->input->post('username'),
            'password'      => substr(md5(openssl_random_pseudo_bytes(32)), 0, 32),
            'status'        => $this->input->post('status')
        );
        if ($this->validate_new_membership ($membership)) {
            if ($membership->id_membership == null) {
                $this->memberships_model->insert_membership($membership);
            } else {
                $this->memberships_model->update_membership($membership);
            }
            //Volta para a tabela mostrando msg de sucesso!
            $this->load->view('pages/success'); 
        } else {
            //Volta para a tabela mostrando msg de falha!
            $this->load->view('pages/failed');
        }
        $this->list_all_memberships();
    }

    public function update_membership($id_membership){
        $data['membership'] = $this->memberships_model->return_membership($id_membership);
        $this->load->helper('form');
        $this->load->view('memberships/form', $data);
    }

    public function reset_pwd_membership($id_membership){
        $membership             = $this->memberships_model->return_membership($id_membership);
        $membership->password   = substr(md5(openssl_random_pseudo_bytes(32)), 0, 32);
        $this->memberships_model->update_membership($membership);
        $this->load->view('pages/success');
        $this->list_all_memberships();
    }

    private function validate_new_membership ($new_membership) {
        //Verifica se não está vazio
        if ($new_membership->username == '') : return false; endif;

        $memberships = $this->memberships_model->return_all_memberships();

        foreach ($memberships as $memberships_item) :
            if (    ($memberships_item['username'] == $new_membership->username)
                &&  ($memberships_item['id_membership'] != $new_membership->id_membership))
            : return false; endif;
        endforeach;
        return true;
    }
}