<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_model extends MY_Model {

	public function get_gps_by_sessionID($where = array()){
		$this->db->select('g.*,v.is_google_route');
		$this->db->from(TBL_GPS.' as g');
		$this->db->join(TBL_SESSION.' as s','g.sessionID=s.sessionID','LEFT');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','LEFT');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','LEFT');
		$this->db->where($where);
		return $this->db->get();
	}
}

/* End of file Track_model.php */
/* Location: ./application/models/Track_model.php */