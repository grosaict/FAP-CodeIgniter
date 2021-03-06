<?php
class Ingredients_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function return_all_ingredients(){
        $this->db->order_by('ingredient', 'ASC');
        $query = $this->db->get("tb_ingredient");
        return $query->result_array();
    }

    public function return_ingredient($id_ingredient){
        $query = $this->db->get_where('tb_ingredient', array('id_ingredient' => $id_ingredient));
        return $query->row();
    }

    public function insert_ingredient($ingredient){
        return $this->db->insert('tb_ingredient', $ingredient);
    }

    public function update_ingredient($ingredient){
        $this->db->where('id_ingredient', $ingredient->id_ingredient);
        $this->db->update('tb_ingredient', $ingredient);
    }
}