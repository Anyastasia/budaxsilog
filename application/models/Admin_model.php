<?php

class Admin_model extends CI_Model {

    private $table = "admin";

    public function getPassword() {
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row->password;
    }
}
?>