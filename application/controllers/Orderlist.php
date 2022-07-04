<?php 

class Orderlist extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library('session');
        $this->load->model('orders');  
        $this->load->model('Product', 'product');
    }

    public function index($flag = 0) {
        $this->load->view('templates/header');
        $arr["orderList"] = array();
        switch ($flag) {
            case 1:
                $arr["orderList"] = $this->orders->getOrderPending();
                break;
            case 2:
                $arr["orderList"] = $this->orders->getPaymentPending();
                break;
            default:
                $arr["orderList"] = $this->orders->getOrders();
                break;
        }
        $arr['productList'] = $this->product->getProductName();
        $this->load->view('orderlist', $arr);
    }
}