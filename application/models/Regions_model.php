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
     * @return integer/array
     */
    public function get_areas_data($type) {
        $columns = ['d.depotGUID', 'c.companyName', 'd.depotName', 'd.addressLine1', 'm1.firtName as m1_fname', 'm2.firtName'];
        $keyword = $this->input->get('search');
        $this->db->select('d.*,m1.firstName as m1_fname,m1.lastName as m1_lname,m1.email as m1_email,m1.mobileNumber as m1_mobile,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email,m2.mobileNumber as m2_mobile,c.companyName');
        if (!empty($keyword['value'])) {
            $where = '(c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.depotName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine2 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine3 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.postcode_zipcode LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.officePhone LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->join(TBL_COMPANY . ' as c', 'r.companyGUID=c.companyGUID', 'left');
        $this->db->join(TBL_MANAGER . ' as m1', 'd.ManagerGUID=m1.managerGUID', 'left');
        $this->db->join(TBL_MANAGER . ' as m2', 'd.secondaryManagerGUID=m2.managerGUID', 'left');
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
     * Get operator details by it GUID 
     * @param string $operativeGUID
     * @return array
     */
    public function get_operators_by_id($operativeGUID) {
        $this->db->select('o.*,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type SEPARATOR ":-:") lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date,c.companyGUID,c.companyName');
        $this->db->from(TBL_OPERATIVE . ' o');
        $this->db->join(TBL_DEPOT . ' d', 'o.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_REGION . ' r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->join(TBL_COMPANY . ' c', 'r.companyGUID=c.companyGUID', 'left');
        $this->db->join(TBL_QUALIFICATION . ' q', 'o.operativeGUID=q.operativeGUID', 'left');
        $this->db->where(array(
            'o.operativeGUID' => $operativeGUID
        ));
        $q = $this->db->get();
        return $q->row_array();
    }

    /**
     * Get all company depots
     * @param string $companyGUID
     * @return array
     */
    public function get_depots_by_company($companyGUID) {
        $this->db->select('d.depotGUID,d.depotName');
        $this->db->from(TBL_DEPOT . ' as d');
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->where('r.companyGUID', $companyGUID);
        $q = $this->db->get();
        return $q->result_array();
    }

    /**
     * Get all company depots
     * @param string $company companyGUID
     * @author KU
     */
    public function get_depots($company) {
        $this->db->select('d.depotGUID,d.depotName');

        $this->db->join(TBL_REGION . ' r', 'd.regionGUID=r.regionGUID', 'LEFT');
        $this->db->where('companyGUID', $company);

        $query = $this->db->get(TBL_DEPOT . ' d');
        return $query->result_array();
    }

}

/* End of file Region_model.php */
/* Location: ./application/models/Region_model.php */