<?php
class Ingredients_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_ingredients(){
        $query = $this->db->get("tb_ingredient");
        return $query->result_array();
    }

    public function return_ingredient($id_ingredient){
        $query = $this->db->get_where('tb_ingredient', array('id_ingredient' => $id_ingredient));
        return $query->result_array();
    }

    public function insert_ingredient($ingredient){
        return $this->db->insert('tb_ingredient', $ingredient);
    }

    public function edit_ingredient($ingredient){
        $this->db->update('tb_ingredient', $ingredient, array('id_ingredient' => $ingredient['id_ingredient']));
    }
}