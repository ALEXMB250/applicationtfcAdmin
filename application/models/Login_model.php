<?php
class Login_model extends CI_Model {

    public function check_user($login, $pwd)
    {
        $this->db->select();
        $this->db->from("admin");
        $this->db->where("email", $login);
        $this->db->where("mdp", $pwd);

        $query = $this->db->get();
        $query = $query->row();  

        return $query;
    }

}
