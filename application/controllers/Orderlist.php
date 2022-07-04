<?php 

class Orderlist extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library('session');
        $this->load->model('orders');  
        $this->load->model('Product', 'product');
    }

    public function index() {
        $this->load->view('templates/header');
        $arr['productList'] = $this->product->getProductName();
        $arr["orderList"] = $this->orders->getOrders();
        $this->load->view('orderlist', $arr);
    }
}