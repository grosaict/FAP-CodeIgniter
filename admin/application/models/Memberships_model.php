<?php
class Memberships_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    # VALIDA USUÁRIO
    public function validate_membership() {
        $user = array(
            'username'  => $this->input->post('username'),
            'password'  => $this->input->post('password')
        );
        $query_result = $this->db->get_where('tb_membership', $user);

        if ($query_result->num_rows() == 1) { return true; } // Validado se localizado apenas um registro
        return false;
    }

    // # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    // public function logged() {
    //     $logged = $this->session->userdata('logged');

    //     if (!isset($logged) || $logged != true) {
    //         echo 'Voce nao tem permissao para entrar nessa pagina. <a href="login">Efetuar Login</a>';
    //         die();
    //     }
    // }

    public function access_level() {
        $username       = $this->session->userdata('username');
        $password       = $this->session->userdata('password');
        $user           = $this->db->get_where('tb_membership', array('username'  => $username))->row();
        if (isset($user)) {
            $user->password = md5($user->password);
            if ($user->password == $password) {
                return $user->status;
            }
        }
        return 0;
    }

    public function return_all_memberships(){
        $query = $this->db->query("SELECT id_membership, username, status FROM tb_membership ORDER BY username ASC");
        return $query->result_array();
    }

    public function return_membership($id_membership){
        $query = $this->db->query("SELECT id_membership, username, status FROM tb_membership WHERE id_membership = $id_membership");
        return $query->row();
    }

    public function insert_membership($membership){
        return $this->db->insert('tb_membership', $membership);
    }

    public function update_membership($membership){
        $this->db->where('id_membership', $membership->id_membership);
        $this->db->update('tb_membership', $membership);
    }
}