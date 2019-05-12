<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('memberships_model');
    }

    function index() {
        // VALIDATION RULES
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/login_view');
        } else {
            $membership_validation = $this->memberships_model->validate_membership();
            $this->load->helper('url');
            if ($membership_validation) { // VERIFICA LOGIN E SENHA
                $userdata = array(
                    'username'  => $this->input->post('username'),
                    'logged'    => true
                );
                $this->session->set_userdata($userdata);
                header("Location: ".$this->config->item('base_url'));
            } else {
                $this->load->view('pages/invalid_login');
                $this->load->view('login/login_view');
            }
        }
    }

    function logoff() {
        $user   = $this->session->userdata('username');
        $this->session->unset_userdata($user);
        session_destroy();
        header("Location: ".$this->config->item('base_url'));
    }
}