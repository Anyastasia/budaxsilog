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


    // public function getOrderByStatus($flag = 0) {
        
    // }

    public function updateOrderStatus($customerID, $flag) {
            $query = $this->db->get_where($this->table, array("customerID" => $customerID));
            $row = $query->row();
            $flag;
            $this->db->where('customerID', $customerID);
            $this->db->update($this->table, array("orderStatus" => $flag));

    }

    public function checkOrderHistory($num, $loc){
        $query = 0;
        if(isset($num) && isset($loc)){
            $this->db->where('contactNumber',$num);
            $this->db->where('orderStatus',4);
            $this->db->or_where('address',$loc);
            $this->db->where('orderStatus',4);
            $query = $this->db->get('orders');
        }
        return $query->num_rows();
    }

    public function checkStatus($code){
        $query = "";
        if(isset($code)){
            $this->db->select('orderStatus, modeOfPayment');
            $this->db->where('code',$code);
            $query = $this->db->get('orders')->result_array();
        }
        return $query;
    }

    public function cancelOrderM($code){
        $status = 0;
        if(isset($code)){
            $this->db->set('orderStatus', 0);
            $this->db->where('code',$code);
            $this->db->update('orders');
            $status = 1;
        }
        return $status;
    }
    
    public function getOrderPending() {
        $query = $this->db->where("orderStatus", NULL);
        $query = $this->db->or_where("orderStatus", 1);
        $query = $this->db->or_where("orderStatus", 2);
        $query = $this->db->or_where("orderStatus", 3);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function getOrderAccepted() {
        $query = $this->db->get_where($this->table, array("orderStatus" => 1));
        return $query->result_array();
    }

    public function getOrderDelivered() {
        $query = $this->db->get_where($this->table, array("orderStatus" => 4));
        return $query->result_array();
    }

    public function getOrderCanceled() {
        $query = $this->db->get_where($this->table, array("orderStatus" => 0));
        return $query->result_array();
    }
}