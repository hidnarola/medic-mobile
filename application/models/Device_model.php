<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device_model extends MY_Model {
	public function get_other_details($deviceIDs){
		//$sql = "SELECT v.deviceGUID,v.registration,o.operativeGUID,max_session.sessionID FROM ".TBL_VEHICLE." as v LEFT JOIN ".TBL_OPERATIVE." as o ON v.baseDepotGUID=o.baseDepotGUID LEFT JOIN ( SELECT s.sessionID,s.operativeGUID FROM ".TBL_SESSION." as s ORDER BY s.sessionID DESC LIMIT 1 ) as max_session ON o.operativeGUID=max_session.operativeGUID WHERE v.deviceGUID in ('".$deviceIDs."')";
		$sql = "SELECT v.deviceGUID,v.registration,o.operativeGUID,s.sessionID
				FROM vehicle AS v
				LEFT JOIN operative AS o ON v.baseDepotGUID = o.baseDepotGUID
 				LEFT JOIN session AS s ON o.operativeGUID = s.operativeGUID
				WHERE v.deviceGUID IN('".$deviceIDs."')
				GROUP BY s.operativeGUID
				ORDER BY s.sessionID DESC";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
}

/* End of file Device_model.php */
/* Location: ./application/models/Device_model.php */