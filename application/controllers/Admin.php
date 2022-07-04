<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->library('session');
        $this->load->model('Admin_model', 'admin');
    }


    public function index() {
        $this->load->view('templates/header');
        if ($this->session->has_userdata("logged_in")) {
            $this->load->view('adminhome');
        } else {
            $this->load->view('admin');
        }
    }

    public function adminhome() {
        $this->load->view('templates/header');
        $this->load->view('adminhome');
    }

    public function login() {
        $password = $this->input->post("password");
        $validation_password = $this->admin->getPassword();

        if (strcmp($password, $validation_password) == 0) {
            // password is correct
            $this->session->set_userdata("logged_in", TRUE);
            redirect("admin", "refresh");
        } else {
            $this->session->set_flashdata("invalid_password", "Invalid Password.");
            redirect("admin", "refresh");
        }
    }

    public function logout() {
        $this->session->unset_userdata("logged_in");
        $this->session->set_flashdata("logged_out", "Logged out.");
        redirect("admin", "refresh");
    }

    
}