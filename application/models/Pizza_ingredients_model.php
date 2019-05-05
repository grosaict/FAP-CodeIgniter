<?php
class Pizza_Ingredients_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_pizza_ingredients($id_pizza){
        $query = $this->db->get_where('tb_ingredient_pizza', array('id_pizza' => $id_pizza));
        return $query->result_array();
    }

    public function insert_pizza_ingredient($pizza_ingredient){
        return $this->db->insert('tb_ingredient_pizza', $pizza_ingredient);
    }
}