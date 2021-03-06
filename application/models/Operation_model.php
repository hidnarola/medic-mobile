<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Operation model to manage operation tab related functions
 * @author KU
 */
class Operation_model extends MY_Model {

    /**
     * Get vehicles
     * @param string $companyGUID company's id to get vehicles of logged in company user
     * @return Array
     */
    public function get_vehicles($companyGUID = null) {
        $this->db->select('v.*,r.companyGUID');
        $this->db->join(TBL_DEPOT . ' d', 'v.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_REGION . ' r', 'd.regionGUID=r.regionGUID', 'left');
        $this->db->group_by('v.vehicleGUID');
        if (!is_null($companyGUID)) {
            $this->db->where('r.companyGUID', $companyGUID);
        }
        $query = $this->db->get(TBL_VEHICLE . ' v');
        return $query->result_array();
    }

    /**
     * Get regions
     * @param string $companyGUID company's id to get regions of logged in company user
     * @return Array
     */
    public function get_regions($companyGUID = null) {
        if (!is_null($companyGUID)) {
            $this->db->where('companyGUID', $companyGUID);
        }
        $query = $this->db->get(TBL_REGION);
        return $query->result_array();
    }

    /**
     * Get operators
     * @param type $companyGUID company's id to get regions of logged in company user
     * @return Array
     */
    public function get_operators($companyGUID = null) {
        $this->db->select('o.*');
        $this->db->join(TBL_DEPOT . ' d', 'o.baseDepotGUID=d.depotGUID', 'left');
        $this->db->join(TBL_REGION . ' r', 'd.regionGUID=r.regionGUID', 'left');
        
        if (!is_null($companyGUID)) {
            $this->db->where('r.companyGUID', $companyGUID);
        }

        $query = $this->db->get(TBL_OPERATIVE . ' o');
        return $query->result_array();
    }

}

/* End of file Operation_model.php */
/* Location: ./application/models/Operation_model.php */