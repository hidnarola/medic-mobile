<?php

/**
 * Manage operators model related activity
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Operators_model extends MY_Model {

    /**
     * Get Operators data for data table listing
     * @param string $type result/count
     * @return int/array
     * @author KU
     */
    public function get_all_data($type = 'result') {
        $columns = ['o.operativeGUID', 'c.companyName', 'd.depotName', 'o.firstName', 'o.DOB', 'o.employee', 'o.employee'];
        $keyword = $this->input->get('search');
        $this->db->select('o.*,c.companyName,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type SEPARATOR ":-:") lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date');
        if (!empty($keyword['value'])) {
            // $where = '(f.registration LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.vin LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.fuelType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.licenceType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.numberOfWheels LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.axle1TyreSize LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.resetServiceCounter LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
            // $this->db->where($where);
            $where = '(d.depotName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.firstName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.lastName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR CONCAT(o.firstName,\' \',o.lastName) LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.DOB LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        $this->db->join(TBL_DEPOT . ' as d', 'o.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->join(TBL_COMPANY . ' as c', 'c.companyGUID=r.companyGUID', 'left');
        $this->db->join(TBL_QUALIFICATION . ' as q', 'o.operativeGUID=q.operativeGUID', 'left');
        $this->db->group_by('o.operativeGUID');
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);

        if ($type == 'count') {
            $query = $this->db->get(TBL_OPERATIVE . ' o');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_OPERATIVE . ' o')->result_array();
            return $query;
        }
    }

    public function get_depot_by_company() {
        $this->db->select('d.depotGUID,d.depotName');
        $this->db->from(TBL_DEPOT . ' as d');
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID and r.companyGUID="' . get_AdminLogin('COMP_GUID') . '"', 'left');
        return $this->db->get();
    }

    public function get_operators_by_id($operativeGUID) {
        $this->db->select('o.*,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type SEPARATOR ":-:") lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date');
        $this->db->from(TBL_OPERATIVE . ' as o');
        $this->db->join(TBL_DEPOT . ' as d', 'o.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_QUALIFICATION . ' as q', 'o.operativeGUID=q.operativeGUID', 'left');
        $this->db->where(array(
            'o.operativeGUID' => $operativeGUID
        ));
        $q = $this->db->get();
        return $q->row_array();
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

/* End of file Operators_model.php */
/* Location: ./application/models/Operators_model.php */