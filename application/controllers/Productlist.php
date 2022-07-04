<?php

class Productlist extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library('session');
        $this->load->model('Product', 'product');  
    }

    public function index() {
        $this->load->view('templates/header');
        $product["productList"] = $this->product->getProduct();
        $this->load->view('productlist', $product);
    }

    public function add_product() {

    }


}