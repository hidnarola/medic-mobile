<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model {

    /**
     * Check the login credentials
     * @author pav
     * @param string username, string password
     * @return array
     */
    public function check_login_validation($uname, $pass) {
        $this->db->select('ld.*');
        $this->db->from(TBL_LOGIN_DETAILS . ' as ld');
        $this->db->group_start();
        $this->db->where('ld.emailAddress', $uname);
        $this->db->or_where('ld.username', $uname);
        $this->db->group_end();
        $this->db->where('ld.passwordHash', md5($pass));
        $this->db->limit(1);
        $res = $this->db->get();
        return $res->row_array();
    }

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */