<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

	public function get_operators_details($limit='',$offset=''){
		$this->db->select('o.*,GROUP_CONCAT(q.qualificationID SEPARATOR ":-:") as qualification_id,GROUP_CONCAT(q.number SEPARATOR ":-:") as lic_number,GROUP_CONCAT(q.type SEPARATOR ":-:") as lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") as lic_expiry');
		$this->db->from(TBL_OPERATIVE.' as o');
		$this->db->join(TBL_QUALIFICATION.' as q','q.operativeGUID=o.operativeGUID','left');
		$this->db->group_by('o.operativeGUID');
		if($offset==0){
			$this->db->limit($limit);
		}else{
			$this->db->limit($limit,$offset);
		}
		$q = $this->db->get();
		return $q->result_array();
	}

	public function get_dailycheck_details($limit='',$offset='',$where_Arr=''){
		$this->db->select('dc.dailyCheckID,dc.vehicleReg,dc.vinDetails,dc.mileage,dc.signatureDateTime,o.firstName,o.lastName,GROUP_CONCAT(COALESCE(dcf.faultType,"") SEPARATOR ":-:") as faultType');
		$this->db->from(TBL_DAILYCHECK.' as dc');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_DAILYCHECKFAULT.' as dcf','dc.dailyCheckID=dcf.dailyCheckID','left');
		if(isset($where_Arr['date_range_start'])){
			$this->db->where('dc.signatureDateTime>=',$where_Arr['date_range_start']);
			$this->db->where('dc.signatureDateTime<=',$where_Arr['date_range_end']);
		}
		$this->db->group_by('dc.dailyCheckID');
		$this->db->order_by('dc.signatureDateTime','DESC');
		if($offset==0){
			$this->db->limit($limit);
		}else{
			$this->db->limit($limit,$offset);
		}
		$q = $this->db->get();
		return $q->result_array();
	}

	public function get_dailycheck_details_by_id($id){
		$this->db->select('dc.*,o.firstName,o.lastName,GROUP_CONCAT(COALESCE(dcf.faultType,"") SEPARATOR ":-:") as faultType,GROUP_CONCAT(COALESCE(dcf.vehicleType,"") SEPARATOR ":-:") as vehicleType,GROUP_CONCAT(COALESCE(dcf.description,"") SEPARATOR ":-:") as faultDesc');
		$this->db->from(TBL_DAILYCHECK.' as dc');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_DAILYCHECKFAULT.' as dcf','dc.dailyCheckID=dcf.dailyCheckID','left');
		$this->db->where('dc.dailyCheckID',$id);
		$q = $this->db->get();
		return $q->row_array();
	}

	public function get_all_faults($limit='',$offset='',$where_Arr='',$all=0){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,v.description,count(dcf.dailyCheckFaultID) as total_faults');
		$this->db->from(TBL_DAILYCHECKFAULT.' as dcf');
		$this->db->join(TBL_DAILYCHECK.' as dc','dcf.dailyCheckID=dc.dailyCheckID','left');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		if(isset($where_Arr['date_range_start'])){
			$this->db->where('dc.signatureDateTime>=',$where_Arr['date_range_start']);
			$this->db->where('dc.signatureDateTime<=',$where_Arr['date_range_end']);
		}
		$this->db->order_by('dc.signatureDateTime','DESC');
		$this->db->group_by('v.vehicleGUID');
		if($all==0){
			if($offset==0){
				$this->db->limit($limit);
			}else{
				$this->db->limit($limit,$offset);
			}
		}
		$q = $this->db->get();
		return $q;
	}

	public function get_faults_by_vehicleGUID($vehicleGUID=''){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,dcf.*,dcfi.*,dc.signatureImage');
		$this->db->from(TBL_DAILYCHECKFAULT.' as dcf');
		$this->db->join(TBL_DAILYCHECKFAULTIMAGE.' as dcfi','dcf.dailyCheckFaultID=dcfi.dailyCheckFaultID','left');
		$this->db->join(TBL_DAILYCHECK.' as dc','dcf.dailyCheckID=dc.dailyCheckID','left');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		$this->db->where('v.vehicleGUID',$vehicleGUID);
		$this->db->group_by('dcf.dailyCheckFaultID');
		$q =  $this->db->get();
		return $q->result_array();
	}

	public function get_all_incidents($limit='',$offset='',$where_Arr='',$all=0){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,i.description,count(i.incidentID) as total_incidents');
		$this->db->from(TBL_INCIDENT.' as i');
		$this->db->join(TBL_DAILYCHECK.' as dc','i.dailyCheckID=dc.dailyCheckID','left');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		if(isset($where_Arr['date_range_start'])){
			$this->db->where('dc.signatureDateTime>=',$where_Arr['date_range_start']);
			$this->db->where('dc.signatureDateTime<=',$where_Arr['date_range_end']);
		}
		$this->db->order_by('dc.signatureDateTime','DESC');
		$this->db->group_by('v.vehicleGUID');
		if($all==0){
			if($offset==0){
				$this->db->limit($limit);
			}else{
				$this->db->limit($limit,$offset);
			}
		}
		$q = $this->db->get();
		return $q;
	}

	public function get_incidents_by_vehicleGUID($vehicleGUID=''){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,i.*,ii.image,dc.signatureImage');
		$this->db->from(TBL_INCIDENT.' as i');
		$this->db->join(TBL_INCIDENTIMAGE.' as ii','i.incidentID=ii.incidentID','left');
		$this->db->join(TBL_DAILYCHECK.' as dc','i.dailyCheckID=dc.dailyCheckID','left');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		$this->db->where('v.vehicleGUID',$vehicleGUID);
		$q =  $this->db->get();
		return $q->result_array();
	}

	public function get_all_pod($limit='',$offset='',$where_Arr='',$all=0){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,d.depotName,count(dp.proofID) as total_pod');
		$this->db->from(TBL_DELIVERYPROOF.' as dp');
		$this->db->join(TBL_DAILYCHECK.' as dc','dp.dailyCheckID=dc.dailyCheckID','right');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','right');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','right');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		$this->db->join(TBL_DEPOT.' as d','v.baseDepotGUID=d.depotGUID','right');
		if(isset($where_Arr['date_range_start'])){
			$this->db->where('dc.signatureDateTime>=',$where_Arr['date_range_start']);
			$this->db->where('dc.signatureDateTime<=',$where_Arr['date_range_end']);
		}
		$this->db->order_by('dc.signatureDateTime','DESC');
		$this->db->group_by('v.vehicleGUID');
		if($all==0){
			if($offset==0){
				$this->db->limit($limit);
			}else{
				$this->db->limit($limit,$offset);
			}
		}
		$q = $this->db->get();
		return $q;
	}

	public function get_pod_by_vehicleGUID($vehicleGUID=''){
		$this->db->select('v.vehicleGUID,v.registration,o.firstName,o.lastName,dp.*');
		$this->db->from(TBL_DELIVERYPROOF.' as dp');
		$this->db->join(TBL_DAILYCHECK.' as dc','dp.dailyCheckID=dc.dailyCheckID','left');
		$this->db->join(TBL_SESSION.' as s','dc.sessionID=s.sessionID','left');
		$this->db->join(TBL_OPERATIVE.' as o','s.operativeGUID=o.operativeGUID','left');
		$this->db->join(TBL_VEHICLE.' as v','o.baseDepotGUID=v.baseDepotGUID','right');
		$this->db->where('v.vehicleGUID',$vehicleGUID);
		$q =  $this->db->get();
		return $q->result_array();
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */