<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends MY_Model {

    /**
     * Get company data for datatable listing
     * @param $type -> String
     * @return Object
     * @author PAV
    */
	public function get_company_data($type){
		$columns = ['c.companyGUID', 'c.companyName', 'c.addressLine1'];
        $keyword = $this->input->get('search');
        $this->db->select('c.*');
        if (!empty($keyword['value'])) {
            $where = '(c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.addressLine2 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.town_city LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.country_state LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.postcode_zipcode LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%').')';
            $this->db->where($where);
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