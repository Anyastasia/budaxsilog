<?php

class Product extends CI_Model {
    private $table = 'Product';

    public function getProduct() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    public function checkOutProduct($name, $cnum, $loc, $modePayment, $order, $code) {
    $data = array(
        'name' => $name,
        'contactNumber' => $cnum,
        'address' => $loc,
        'order' => $order,
        'code' => $code,
        'modeOfPayment' => $modePayment,
    );
    
    $this->db->insert('orders', $data);
    }
}