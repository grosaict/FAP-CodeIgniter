<?php
class Memberships_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    # VALIDA USUÁRIO
    function validate_membership() {
        $user = array(
            'username'  => $this->input->post('username'),
            'password'  => $this->input->post('password')
        );
        $query_result = $this->db->get_where('tb_membership', $user);

        if ($query_result->num_rows() == 1) { return true; } // Validado se localizado apenas um registro
        return false;
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function logged() {
        $logged = $this->session->userdata('logged');

        if (!isset($logged) || $logged != true) {
            echo 'Voce nao tem permissao para entrar nessa pagina. <a href="login">Efetuar Login</a>';
            die();
        }
    }

    public function return_all_memberships(){
        $this->db->order_by('username', 'ASC');
        $query = $this->db->get("tb_membership");
        return $query->result_array();
    }
}