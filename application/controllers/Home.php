<?php

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('templates/header');
        $product["productList"] = array("","","","","","","","");
        if(empty($this->session->userdata('order'))) {
            $order = array();
            for ($x = 0; $x <= count($product["productList"]); $x++) {
                $order[$x] = 0;
            }

            $this->session->userdata('order');
            $this->session->set_userdata('order',$order);
        }

        $this->load->view('home',$product);
    }

    public function placeOrder() {
        header('content-type: text/json');
        if (!isset($_POST['pid']) || !isset($_POST['bs'])) {
            exit;
        }
        $bs = $_POST['bs'];
        $order = $this->session->userdata('order');
        if($bs == "1") {
            $bs = 0;
        } else {
            $bs = 1;
        }

        $order[$_POST['pid']] = $bs;
        $this->session->set_userdata('order', $order);
        

        echo json_encode($bs);
    }
}