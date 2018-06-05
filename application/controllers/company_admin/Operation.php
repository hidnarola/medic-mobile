<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Operation controller
 * @author KU
 */
class Operation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('track_model', 'vehicle_model', 'operation_model'));
        $this->companyGUID = $this->session->userdata('companyGUID');
        $this->regions = $this->operation_model->get_regions($this->companyGUID);
    }

    /**
     * Index page
     */
    public function index() {
        $this->template->load('default', 'company_admin/operation/index');
    }

    /**
     * Trends page
     */
    public function trends() {
        $this->template->load('default', 'company_admin/operation/trends');
    }

    /**
     * Map page
     */
    public function map() {
        $this->template->load('default', 'company_admin/operation/map');
    }

    /**
     * Ajax call to this function get vehicle information based on query parameter
     * @param string $deviceGUID : Device GUID
     */
    public function track_vehicle($deviceGUID = null) {
        $data['title'] = 'Vehicle - Live Tracking';
        $data['track_heading'] = $this->input->get('track_time');
        $data['last_active'] = '';
        $data['vehicle_status'] = '<h6 class="offline">Offline</h6>';
        $data['vehicle_details'] = $this->vehicle_model->get_vehicle_details($deviceGUID);

        $last_hour = date("Y/m/d H:i:s", strtotime("-30 minutes"));

        if ($this->input->get()) {

            $time = ($this->input->get('track_start_time') == '') ? '12:00 AM' : $this->input->get('track_start_time');
            $pre_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $this->input->get('track_start_date') . ' ' . $time)));
            $time = ($this->input->get('track_end_time') == '') ? '11:30 PM' : $this->input->get('track_end_time');
            $post_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $this->input->get('track_end_date') . ' ' . $time)));

            $last_datetime = $this->track_model->get_last_gps_by_sessionID(['v.deviceGUID' => $deviceGUID]);
            if (!empty($last_datetime)) {
                $data['last_active'] = date('Y-m-d h:i:s A', strtotime($last_datetime['timeStamp']));
                if (strtotime($last_datetime['timeStamp']) >= strtotime($last_hour)) {
                    $data['vehicle_status'] = '<h6 class="online">Online</h6>';
                }
            }
            //-- If request is for last use then get $pre_datetime and $post_datetime 
            if ($this->input->get('last_use') == 1) {
                if (!empty($last_datetime)) {
                    $post_datetime = $last_datetime['timeStamp'];
                    $data['track_heading'] = date('Y-m-d h:i:s A', strtotime($post_datetime));
                    $pre_datetime = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($post_datetime)));
                }
            }
        } else {
            $pre_datetime = date('Y-m-d H:i:s', (time() - 86400)); //345600
            $post_datetime = date('Y-m-d H:i:s', time());
        }
        if ($deviceGUID == 'MEDIC17L0018' || $deviceGUID == 'MEDIC18A0036') {
            $return_arr = $this->get_device_json(constant($deviceGUID . '_json'));
            $device_arr = $return_arr['reverse_device_Array'];
            $vehicle_latlong = [];
            $last_datetime = null;
            foreach ($device_arr as $k => $v) {
                if ($v['k'] == 'LOC:lon' || $v['k'] == 'LOC:lat') {
                    $last_datetime = date('Y-m-d H:i:s', floor($v['t'] / 1000));
                    break;
                }
            }
            if (strtotime($last_datetime) >= strtotime($last_hour)) {
                $data['vehicle_status'] = '<h6 class="online">Online</h6>';
            }
            $data['last_active'] = date('Y-m-d h:i:s A', strtotime($last_datetime));

            //-- If request is for last use then get $pre_datetime and $post_datetime 
            if ($this->input->get('last_use') == 1) {
                $post_datetime = $last_datetime;
                $pre_datetime = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($post_datetime)));

                $data['track_heading'] = date('Y-m-d h:i:s A', strtotime($post_datetime));
            }

            foreach ($device_arr as $k => $v) {
                $check_date = date('Y-m-d H:i:s', floor($v['t'] / 1000));
//                if (($check_date > $pre_datetime && $check_date < $post_datetime)) {
                if (($check_date > $pre_datetime && $check_date < $post_datetime) || ($check_date == $pre_datetime) || ($check_date == $post_datetime)) {
                    $key_ind = (string) $v['t'];
                    if ($v['k'] == 'LOC:lon') {
                        $vehicle_latlong[$key_ind]['longitude'] = $v['v'];
                        $vehicle_latlong[$key_ind]['is_google_route'] = 0;
                    } else if ($v['k'] == 'LOC:lat') {
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
                'v.deviceGUID' => $deviceGUID
            );
            $data['vehicle_latlong'] = $this->track_model->get_gps_by_sessionID($where)->result_array();
        }
        $data['deviceGUID'] = $deviceGUID;
        echo json_encode($data);
//        echo $this->load->view('company_admin/operation/vehicle_track', $data, true);
        exit;
    }

    /**
     * Machines page
     */
    public function machines() {
        $data['machines'] = $this->operation_model->get_vehicles($this->companyGUID);
        $this->template->load('default', 'company_admin/operation/machines', $data);
    }

    /**
     * Visits page
     */
    public function visits() {
        $this->template->load('default', 'company_admin/operation/visits');
    }

    /**
     * Operators page
     */
    public function operators() {
        $data['operators'] = $this->operation_model->get_operators($this->companyGUID);
        $this->template->load('default', 'company_admin/operation/operators', $data);
    }

}

/* End of file Notification.php */
/* Location: ./application/controllers/company_admin/Operation.php */