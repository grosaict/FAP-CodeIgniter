<?php
class Membership extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $logged = $this->session->userdata('logged');
            if (!isset($logged) || $logged != true) {
                header("Location: ".$this->config->item('base_url'));
            }  
            $this->load->model('memberships_model');
            $this->load->helper('url_helper');
    }

    public function list_all_memberships(){
        $data['memberships'] = $this->memberships_model->return_all_memberships();
        $this->load->view('memberships/table', $data);
    }

    public function is_admin(){
        $data['memberships'] = $this->memberships_model->return_all_memberships();
        $this->load->view('memberships/table', $data);
    }
}