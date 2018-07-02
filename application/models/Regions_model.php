<?php

/**
 * Manage Regions/Areas related activity
 * @author KU
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions_model extends MY_Model {

    /**
     * Get area data for data table listing
     * @param string $type count/result
     * @param string $user_id
     * @return integer/array
     */
    public function get_areas_data($type, $user_id = null) {
        $columns = ['d.depotGUID', 'c.companyName', 'd.depotName', 'd.addressLine1', 'm1.firtName as m1_fname', 'm2.firtName'];
        $keyword = $this->input->get('search');
        $this->db->select('d.*,m1.firstName as m1_fname,m1.lastName as m1_lname,m1.email as m1_email,m1.mobileNumber as m1_mobile,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email,m2.mobileNumber as m2_mobile,c.companyName');
        if (!empty($keyword['value'])) {
            $where = '(c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.depotName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine2 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine3 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.postcode_zipcode LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.officePhone LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->join(TBL_COMPANY . ' as c', 'r.companyGUID=c.companyGUID', 'left');
        $this->db->join(TBL_LOGIN_DETAILS . ' l', 'c.companyGUID=l.companyGUID', 'left');
        $this->db->join(TBL_MANAGER . ' as m1', 'd.ManagerGUID=m1.managerGUID', 'left');
        $this->db->join(TBL_MANAGER . ' as m2', 'd.secondaryManagerGUID=m2.managerGUID', 'left');
        
        if (!is_null($user_id)) {
            $this->db->where('l.userGUID', $user_id);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        if ($type == 'count') {
            $query = $this->db->get(TBL_DEPOT . ' d');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_DEPOT . ' d');
            return $query->result_array();
        }
    }

    /**
     * Get area details by id
     * @param sring $id
     * @return object
     */
    public function get_area_details_by_id($id) {
        $this->db->select('d.*,r.*,m1.managerGUID as m1_GUID,m1.firstName as m1_fname,m1.lastName as m1_lname,m1.email as m1_email,m1.mobileNumber as m1_mobile,m2.managerGUID as m2_GUID,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email,m2.mobileNumber as m2_mobile');
        $this->db->from(TBL_DEPOT . ' as d');
        $this->db->join(TBL_MANAGER . ' as m1', 'd.managerGUID=m1.managerGUID', 'left');
        $this->db->join(TBL_MANAGER . ' as m2', 'd.secondaryManagerGUID=m2.managerGUID', 'left');
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->where('d.depotGUID', $id);
        return $this->db->get();
    }

}

/* End of file Region_model.php */
/* Location: ./application/models/Region_model.php */