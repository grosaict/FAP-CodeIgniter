<?php
class Pizzas_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_pizzas(){
        $query  = $this->db->get("tb_pizza");
        return $query->result_array();
    }

    public function return_pizza($id_pizza){
        $query = $this->db->get_where('tb_pizza', array('id_pizza' => $id_pizza));
        return $query->row();
    }

    public function insert_pizza($pizza){
        return $this->db->insert('tb_pizza', $pizza);
    }
}