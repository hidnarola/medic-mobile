<?php

/**
 * Manage system users related function
 * @author KU
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

    /**
     * Get all users with associated company 
     * @param string $type 
     * @return integer/array
     */
    public function get_users($type = 'result') {
        $columns = ['l.username', 'l.firstName', 'l.lastName', 'l.emailAddress', 'l.tier', 'c.companyName'];
        $keyword = $this->input->get('search');
        $this->db->select('l.*,c.companyName');
        if (!empty($keyword['value'])) {
            $where = '(l.username LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR l.firstName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR l.lastName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR l.emailAddress LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        $this->db->where('isAdmin', 0);
        $this->db->where('is_delete', 0);
        $this->db->join(TBL_COMPANY . ' c', 'c.companyGUID=l.companyGUID', 'left');
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_LOGIN_DETAILS . ' l');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_LOGIN_DETAILS . ' l');
            $data = $query->result_array();
            return $data;
        }
    }

    /**
     * Get all companies
     * @author KU
     */
    public function get_companies() {
        $query = $this->db->get(TBL_COMPANY);
        $data = $query->result_array();
        return $data;
    }

    /**
     * Get user details by userGUID
     * @param string $id userGUID 
     * @return array
     */
    public function get_user_by_id($id) {
        $this->db->where('userGUID', $id);
        $this->db->where('is_delete', 0);
        $query = $this->db->get(TBL_LOGIN_DETAILS);
        return $query->row_array();
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */