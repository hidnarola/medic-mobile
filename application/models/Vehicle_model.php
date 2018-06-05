<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends MY_Model {

    public function get_vehicle_latlong($where) {
        $sql = "SELECT v.vehicleGUID,v.registration,r.regionName,v.deviceGUID,v.lastServiceDate,v.nextServiceDue,v.lastInspectionDate,v.nextInspectionDue,o.operativeGUID,o.firstName,o.lastName,s.sessionID,tbl_gps.*
				FROM " . TBL_VEHICLE . " AS v
				LEFT JOIN " . TBL_OPERATIVE . " AS o ON v.baseDepotGUID = o.baseDepotGUID
				LEFT JOIN " . TBL_DEPOT . " AS d ON v.baseDepotGUID = d.depotGUID
				LEFT JOIN " . TBL_REGION . " AS r ON d.regionGUID = r.regionGUID
 				LEFT JOIN " . TBL_SESSION . " AS s ON o.operativeGUID=s.operativeGUID
 				LEFT JOIN " . TBL_GPS . " as tbl_gps ON s.sessionID=tbl_gps.sessionID
 				" . $where . "
				GROUP BY v.deviceGUID
				ORDER BY s.sessionID";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_all_vehicles($limit = '', $offset = '', $where_Arr = '') {
        $this->db->select('v.*');
        $this->db->from(TBL_VEHICLE . ' as v');
        $this->db->order_by('v.nextServiceDue', 'ASC');
        if ($offset == 0) {
            $this->db->limit($limit);
        } else {
            $this->db->limit($limit, $offset);
        }
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_vehicle_depot() {
        $this->db->select('baseDepotGUID');
        $this->db->from(TBL_VEHICLE);
        $q = $this->db->get();
        return $q->result_array();
    }

    /**
     * Get vehicle details of vehicle by device GUID 
     * @author KU
     */
    public function get_vehicle_details($deviceGUID) {
        $this->db->select('v.*,o.operativeGUID,CONCAT(o.firstName,o.lastName) as operator');
        $this->db->join(TBL_DEPOT . ' d', 'v.baseDepotGUID=d.depotGUID', 'LEFT');
        $this->db->join(TBL_OPERATIVE . ' o', 'o.baseDepotGUID=d.depotGUID', 'LEFT');
        $this->db->where('v.deviceGUID', $deviceGUID);
        $result = $this->db->get(TBL_VEHICLE . ' v');
        return $result->row_array();
    }

}

/* End of file Vehicle_model.php */
/* Location: ./application/models/Vehicle_model.php */