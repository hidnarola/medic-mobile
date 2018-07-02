<?php

/**
 * Manage company related activity
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends MY_Model {

    /**
     * Get company data for data table listing
     * @param string $type count/string
     * @param string $user_id userGUID
     * @return integer/array
     */
    public function get_company_data($type, $user_id = null) {
        $columns = ['c.companyGUID', 'c.companyName', 'c.addressLine1', 'c.town_city', 'c.country_state', 'c.postcode_zipcode', 'c.country'];
        $keyword = $this->input->get('search');
        $this->db->select('c.*');
        $this->db->join(TBL_LOGIN_DETAILS . ' l', 'c.companyGUID=l.companyGUID', 'left');

        if (!empty($keyword['value'])) {
            $where = '(c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') .
                    ' OR c.addressLine2 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') .
                    ' OR c.town_city LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.country_state LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') .
                    ' OR c.postcode_zipcode LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.country LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        if (!is_null($user_id)) {
            $this->db->where('l.userGUID', $user_id);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_COMPANY . ' c');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_COMPANY . ' c');
            return $query;
        }
    }

}

/* End of file Company_model.php */
/* Location: ./application/models/Company_model.php */