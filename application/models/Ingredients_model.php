<?php
class Ingredients_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_ingredients(){
        $query = $this->db->get("tb_ingredient");
        return $query->result_array();
    }

    public function insert_ingredient($ingredient){
        return $this->db->insert('tb_ingredient', $ingredient);
    }
}