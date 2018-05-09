<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Device extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('device_model'));
    }

	public function get_data(){
		$myfile = fopen("http://80.95.189.228/Socket/obd_device_data.txt", "r") or die("Unable to open file!");
		$file_data = fread($myfile,10240);
		$ch = curl_init('http://clientapp.narola.online:1016/api/getdecodeddata');
		$postdata = json_encode(array("data"=>$file_data));
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec($ch);
		curl_close($ch);
		$r1 = (array) json_decode($result);
		$file_data_Array = array_values(array_filter(explode('*',$file_data)));
		$temp_device_data = '';
		foreach($file_data_Array as $k => $v){
			if($k==0){
				$temp_device_data = str_replace("Starting decode...\r\nTXT frame: *$file_data_Array[$k]\r\n    ",'@pav@',$r1['Data']);
			}else{
				$temp_device_data = str_replace("TXT frame: *$file_data_Array[$k]\r\n    ",'@pav@',$temp_device_data);
			}
		}
		$temp_device_data = str_replace("\r\n\r\nDecode finished!\r\n", "", $temp_device_data);
		$temp_data_Array = array_values(array_filter(explode('@pav@',$temp_device_data)));
		$four_tab = "\r\n    ";
		$eight_tab = "\r\n        ";
		$final_device_data_Array = [];
		foreach($temp_data_Array as $k => $device_data){
			$parent_key = $sub_p_key = '';
			$is_previous_eight = $four_tab_position = $eight_tab_position = 0;
			while(strlen($device_data)!=0){
				$four_tab_position = strpos($device_data,$four_tab);
				$eight_tab_position = strpos($device_data,$eight_tab);

				if($four_tab_position<$eight_tab_position){
					$temp_data = substr($device_data, 0, $four_tab_position);
					$flag = 4;
				}else if($four_tab_position=='' && $eight_tab_position==''){
					$temp_data = $device_data;
					$flag = 0;
				}else{
					$temp_data = substr($device_data, 0, $eight_tab_position);
					$flag = 8;
				}
			
				if($flag==4){
					if($is_previous_eight==0){
						$key =  str_replace(' ','_',explode(':',$temp_data,2)[0]);
						$value = explode(':',$temp_data,2)[1];
						$device_data_Array[$key] = trim($value);
						$device_data = substr_replace($device_data, '', 0, ($four_tab_position+6));
					}else if($is_previous_eight == 1){
						$is_previous_eight = 0;
						if($sub_p_key!=''){
							$key =  str_replace(' ','_',trim(explode(':',$temp_data,2)[0]));
							$value = trim(explode(':',$temp_data,2)[1]);
							$device_data_Array[$parent_key][$sub_p_key][$key] = trim($value);
							$device_data = substr_replace($device_data, '', 0, ($four_tab_position+6));	
						}else{
							$key =  str_replace(' ','_',trim(explode(':',$temp_data,2)[0]));
							$value = trim(explode(':',$temp_data,2)[1]);
							$device_data_Array[$parent_key][$key] = trim($value);
							$device_data = substr_replace($device_data, '', 0, ($four_tab_position+6));
						}
						$parent_key = '';
						$sub_p_key = '';
					}
				} else if($flag==8){
					$is_previous_eight = 1;
					$key = str_replace(' ','_',trim(explode(':',$temp_data,2)[0]));
					$value = (isset(explode(':',$temp_data,2)[1])) ? trim(explode(':',$temp_data,2)[1]) : '';
					if($parent_key==''){
						$parent_key = $key;
					}
					if($parent_key=='STT' && ($key=='Status' || $key=='Alarm')){
						$sub_p_key = $key;
						$key = '';
					}
					if($parent_key=='STT' && $sub_p_key!=''){
						if($value!='' && $key!=''){
							$device_data_Array[$parent_key][$sub_p_key][$key] = trim($value);	
						}else{
							$device_data_Array[$parent_key][$sub_p_key] = '';	
						}
					}else{
						if($value!=''){
							$device_data_Array[$parent_key][$key] = trim($value);
						}else{
							$device_data_Array[$parent_key] = '';
						}
					}
					$device_data = substr_replace($device_data, '', 0, ($eight_tab_position+10));
				} else if($flag==0){
					$key = str_replace(' ','_',trim(explode(':',$temp_data,2)[0]));
					$value = trim(explode(':',$temp_data,2)[1]);
					if($value!=''){
						$device_data_Array[$parent_key][$key] = trim($value);
					}else{
						$device_data_Array[$parent_key] = '';
					}
					$device_data = '';
				}
			}
			$final_device_data_Array[$device_data_Array['Device_ID']] = $device_data_Array;
			$device_data_Array = [];		
		}
		
		$return_arr = $this->get_device_json(MEDIC17L0018_json);
	    $MEDIC17L0018_Array = $return_arr['reverse_device_Array'];
	    $final_device_data_Array['MEDIC17L0018']['Device_ID'] = 'MEDIC17L0018';
	    $final_device_data_Array['MEDIC17L0018']['Time_stamp'] = date('d/m/Y h:i:s A',time($MEDIC17L0018_Array[$return_arr['latest_lat_key']]['t']));
	    $final_device_data_Array['MEDIC17L0018']['GPS']['Latitude'] = $MEDIC17L0018_Array[$return_arr['latest_lat_key']]['v'];
	    $final_device_data_Array['MEDIC17L0018']['GPS']['Longitude'] = $MEDIC17L0018_Array[$return_arr['latest_lon_key']]['v'];
		$final_device_data_Array['MEDIC17L0018']['Mileage'] = '';

		$return_arr = $this->get_device_json(MEDIC18A0036_json);
	    $MEDIC18A0036_Array = $return_arr['reverse_device_Array'];
	    $final_device_data_Array['MEDIC18A0036']['Device_ID'] = 'MEDIC18A0036';
	    $final_device_data_Array['MEDIC18A0036']['Time_stamp'] = date('d/m/Y h:i:s A',time($MEDIC18A0036_Array[$return_arr['latest_lat_key']]['t']));
	    $final_device_data_Array['MEDIC18A0036']['GPS']['Latitude'] = $MEDIC18A0036_Array[$return_arr['latest_lat_key']]['v'];
	    $final_device_data_Array['MEDIC18A0036']['GPS']['Longitude'] = $MEDIC18A0036_Array[$return_arr['latest_lon_key']]['v'];
		$final_device_data_Array['MEDIC18A0036']['Mileage'] = '';
		
		$this->insert_device_data($final_device_data_Array);
		echo json_encode($final_device_data_Array);
		die;
	}

	public function insert_device_data($device_data_Array){
		$dataArr = $dataArr2 = [];
		$deviceID_Array = array_keys($device_data_Array);
		$deviceIDs = implode("', '", $deviceID_Array);
		$result = $this->device_model->get_other_details($deviceIDs);
		$cnt = 0;
		foreach($result as $k => $v){
			if(isset($device_data_Array[$v['deviceGUID']]) && isset($device_data_Array[$v['deviceGUID']]['GPS'])){
				$dataArr[$cnt]['sessionID'] = $v['sessionID'];
				$dataArr[$cnt]['deviceData'] = json_encode($device_data_Array[$v['deviceGUID']]);
				$dataArr[$cnt]['timeStamp'] = strtotime($device_data_Array[$v['deviceGUID']]['Time_stamp']);

				$dataArr2[$cnt]['sessionID'] = $v['sessionID'];
				$dataArr2[$cnt]['latitude'] = json_encode($device_data_Array[$v['deviceGUID']]['GPS']['Latitude']);
				$dataArr2[$cnt]['longitude'] = json_encode($device_data_Array[$v['deviceGUID']]['GPS']['Longitude']);
				$dataArr2[$cnt]['timeStamp'] = date('Y-m-d h:i:s',strtotime($device_data_Array[$v['deviceGUID']]['Time_stamp']));
				$cnt++;
			}
		}
		$insertArray = $dataArr;
		$insertArray2 = $dataArr2;
		if(!empty($insertArray) && !empty($insertArray2)){
			$this->device_model->batch_insert_update('insert',TBL_TELEMATICS,$insertArray);
			$this->device_model->batch_insert_update('insert',TBL_GPS,$insertArray2);
		}
	}

	public function get_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}
}

/* End of file Device.php */
/* Location: ./application/controllers/Device.php */