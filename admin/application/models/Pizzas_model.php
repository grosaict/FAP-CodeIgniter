<?php
class Pizzas_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_pizzas(){
        $this->db->order_by('pizza', 'ASC');
        $query  = $this->db->get("tb_pizza");
        return $query->result_array();
    }

    public function return_pizza_byId($id_pizza){
        $query = $this->db->get_where('tb_pizza', array('id_pizza' => $id_pizza));
        return $query->row();
    }

    public function return_pizza_byName($pizza){
        $query = $this->db->get_where('tb_pizza', array('pizza' => $pizza));
        return $query->row();
    }

    public function insert_pizza($pizza){
        return $this->db->insert('tb_pizza', $pizza);
    }

    public function update_pizza($pizza){
        $this->db->where('id_pizza', $pizza->id_pizza);
        return $this->db->update('tb_pizza', $pizza);
    }

    public function delete_pizza($id_pizza){
        $this->db->where('id_pizza', $id_pizza);
        return $this->db->delete('tb_pizza');
    }
}