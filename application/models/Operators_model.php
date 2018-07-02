<?php

/**
 * Manage operators model related activity
 * @author KU
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Operators_model extends MY_Model {

    /**
     * Get Operators data for data table listing
     * @param string $type result/count
     * @param string $user_id
     * @return int/array
     * @author KU
     */
    public function get_all_data($type = 'result', $user_id = null) {
        $columns = ['o.operativeGUID', 'c.companyName', 'd.depotName', 'o.firstName', 'o.DOB', 'o.employee', 'lic_type'];
        $keyword = $this->input->get('search');
        $this->db->select('o.*,c.companyName,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type) lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date');
        if (!empty($keyword['value'])) {
            // $where = '(f.registration LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.vin LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.fuelType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.licenceType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.numberOfWheels LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.axle1TyreSize LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.resetServiceCounter LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
            // $this->db->where($where);
            $where = '(d.depotName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.firstName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.lastName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR CONCAT(o.firstName,\' \',o.lastName) LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR o.DOB LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR c.companyName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ')';
            $this->db->where($where);
        }
        $this->db->join(TBL_DEPOT . ' as d', 'o.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_REGION . ' as r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->join(TBL_COMPANY . ' as c', 'c.companyGUID=r.companyGUID', 'left');
        $this->db->join(TBL_LOGIN_DETAILS . ' as l', 'c.companyGUID=l.companyGUID', 'left');
        $this->db->join(TBL_QUALIFICATION . ' as q', 'o.operativeGUID=q.operativeGUID', 'left');
        $this->db->group_by('o.operativeGUID');

        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        
        if (!is_null($user_id)) {
            $this->db->where('l.userGUID', $user_id);
        }
        
        if ($type == 'count') {
            $query = $this->db->get(TBL_OPERATIVE . ' o');
            return $query->num_rows();
        } else {
            $this->db->limit($this->input->get('length'), $this->input->get('start'));
            $query = $this->db->get(TBL_OPERATIVE . ' o')->result_array();
            return $query;
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

/* End of file Operators_model.php */
/* Location: ./application/models/Operators_model.php */