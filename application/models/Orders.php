<?php

class Orders extends CI_Model {
    private $table = "orders";

    public function getOrders() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /*
        Order Status: 0, di pa accepted
        Order Status: 1, orderder accepted

        paymentStatus: 0,
        paymentStatus: 1,
    */


    public function getOrderByStatus($flag = 0) {
        
    }
}