<?php 

class Orderlist extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->library('session');
        $this->load->model('orders');  
        $this->load->model('Product', 'product');
    }

    public function index($flag = 0) {
        $this->load->view('templates/header');
        $arr["orderList"] = array();
        switch ($flag) {
            case 1:
                $arr["orderList"] = $this->orders->getOrders();
                break;
            case 2:
                $arr["orderList"] = $this->orders->getOrderAccepted();
                break;
            case 3:
                $arr["orderList"] = $this->orders->getOrderDelivered();
                break;
            case 4:
                $arr["orderList"] = $this->orders->getOrderCanceled();
            break;
            default:
                $arr["orderList"] = $this->orders->getOrderPending();
                break;
        }
        $arr['productList'] = $this->product->getProductName();
        $this->load->view('orderlist', $arr);
    }

    public function updateOrderStatus() {
        $customerID = $this->input->post('customerID');
        $flag = $this->input->post('updateStatusButton');
        $this->orders->updateOrderStatus($customerID, $flag);
        redirect("/orderlist", "refresh");
    }
}