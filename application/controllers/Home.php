<?php

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Product', 'product');
        
    }

    // public function try() {
    //     $data['arr'] = $this->product->getProduct();
    //     print_r($data);
    //     $this->load->view('try' ,$data);
    // }

    public function index() {
        $this->load->helper('url');
        $this->load->view('templates/header');

        //$product["productList"] = array("","","","","","","","");
        $product["productList"] = $this->product->getProduct();
        if(empty($this->session->userdata('order'))) {
            $order = array();
            for ($x = 0; $x <= count($product["productList"])-1; $x++) {
                $order[$x] = 0;
            }

            $this->session->userdata('order');
            $this->session->set_userdata('order',$order);
        }

        $this->load->view('home',$product);
    }

    public function cartPage(){
        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('order');
    }

    public function updateItem(){
        header('content-type: text/json');
        if ((!isset($_POST['oid'])) || (!isset($_POST['count']))) {
            exit;
        }
        $order = $this->session->userdata('order');
        $order[$_POST['oid']] = $_POST['count'];
        $this->session->set_userdata('order', $order);
        $total = 0;        
        $this->session->userdata('orderTotal');

        for($x = 0; count($order) > $x; $x++){
            if($order[$x] > 0){
                $total++;
            }
        }
        $orderT = $total;
        $this->session->set_userdata('orderTotal', $orderT);
        $status = ($_POST['count']>0)? 1: 0;
        echo json_encode(array("status"=>$status,"total"=>$total));
    }

    public function removeItem(){
        header('content-type: text/json');
        if (!isset($_POST['oid'])) {
            exit;
        }
        $order = $this->session->userdata('order');
        $order[$_POST['oid']] = 0;
        $this->session->set_userdata('order', $order);
        $total = 0;        
        $this->session->userdata('orderTotal');
        for($x = 0; count($order) > $x; $x++){
            if($order[$x] > 0){
                $total++;
            }
        }
        $orderT = $total;
        $this->session->set_userdata('orderTotal', $orderT);
        echo json_encode(array("status"=>0,"total"=>$total));
    }

    public function placeOrder() {
        header('content-type: text/json');
        if (!isset($_POST['pid']) || !isset($_POST['bs'])) {
            exit;
        }
        $total = 0;
        $bs = $_POST['bs'];
        $order = $this->session->userdata('order');
        if($bs > 0) {
            $bs = 0;
        } else {
            $bs = 1;
        }
        $order[$_POST['pid']] = $bs;
        $this->session->set_userdata('order', $order);

        $this->session->userdata('orderTotal');

        for($x = 0; count($order) > $x; $x++){
            if($order[$x] == 1){
                $total++;
            }
        }
        $orderT = $total;
        $this->session->set_userdata('orderTotal', $orderT);
        

        echo json_encode(array("status"=>$bs,"total"=>$total));
    }

    public function resetOrder(){
        session_unset();
        session_destroy();
    }
}