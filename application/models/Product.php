<?php

class Product extends CI_Model {
    private $table = 'Product';

    public function getProduct() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function getActiveProduct() {
        $query = $this->db->get_where($this->table, array("status" => "active"));
        return $query->result_array();
    }

    public function getProductName() {
        $this->db->select('productName');
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

    public function updateProductStatus($pid) {
        $query = $this->db->get_where($this->table, array("productID" => $pid));
        $row = $query->row();
        $updateID = ($row->status == "active") ? "deactivated" : "active";
        $data = array("status" => $updateID);
        $this->db->where('productID', $pid);
        $this->db->update($this->table, $data);
    }
}