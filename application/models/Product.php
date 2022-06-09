<?php

class Product extends CI_Model {
    private $table = 'Product';

    public function getProduct() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}