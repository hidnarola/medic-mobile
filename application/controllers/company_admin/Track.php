<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('track_model','vehicle_model'));
	}

	public function vehicle_track($deviceGUID=''){
		$data['title'] = 'Vehicle - Live Tracking';
		if(empty($_GET)){
			$pre_datetime = date('Y-m-d H:i:s',(time() - 86400)); //345600
			$post_datetime = date('Y-m-d H:i:s',time());
		} else {
			$time = ($_GET['track_start_time']=='') ? '12:00 AM' : $_GET['track_start_time'];
			$pre_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $_GET['track_start_date'].' '.$time)));
			$time = ($_GET['track_end_time']=='') ? '11:30 PM' : $_GET['track_end_time'];
			$post_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $_GET['track_end_date'].' '.$time)));
		}
		if($deviceGUID=='MEDIC17L0018' || $deviceGUID=='MEDIC18A0036'){
			$return_arr = $this->get_device_json(constant($deviceGUID.'_json'));
	        $device_arr = $return_arr['reverse_device_Array'];
	        $vehicle_latlong = [];
	        foreach($device_arr as $k => $v){
	        	if( date('Y-m-d H:i:s',floor($v['t']/1000)) > $pre_datetime && date('Y-m-d H:i:s',floor($v['t']/1000)) < $post_datetime){
	        		$key_ind = (string)$v['t'];
		        	if($v['k']=='LOC:lon'){
		        		$vehicle_latlong[$key_ind]['longitude'] = $v['v'];
		        		$vehicle_latlong[$key_ind]['is_google_route'] = 0; 
		        	}else if($v['k']=='LOC:lat'){
		        		$vehicle_latlong[$key_ind]['latitude'] = $v['v'];
		        		$vehicle_latlong[$key_ind]['is_google_route'] = 0; 
		        	}
		        }
	        }
	        $device_latlng = array_values($vehicle_latlong);
	        $data['vehicle_latlong'] = $device_latlng;
		} else {
			$where = array(
				'g.timeStamp>=' => $pre_datetime,
				'g.timeStamp<=' => $post_datetime,
				'v.deviceGUID'	=> $deviceGUID
			);
	        $data['vehicle_latlong'] = $this->track_model->get_gps_by_sessionID($where)->result_array();
		}
		$this->template->load('default','company_admin/track',$data);
	}
}

/* End of file Track.php */
/* Location: ./application/controllers/company_admin/Track.php */