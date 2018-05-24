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
        if ($this->input->get()) {
            $time = ($this->input->get('track_start_time') == '') ? '12:00 AM' : $this->input->get('track_start_time');
            $pre_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $this->input->get('track_start_date') . ' ' . $time)));
            $time = ($this->input->get('track_end_time') == '') ? '11:30 PM' : $this->input->get('track_end_time');
            $post_datetime = date('Y-m-d H:i:s', strtotime(str_replace(',', '', $this->input->get('track_end_date') . ' ' . $time)));
        } else {
            $pre_datetime = date('Y-m-d H:i:s', (time() - 86400)); //345600
            $post_datetime = date('Y-m-d H:i:s', time());
        }
        if ($deviceGUID == 'MEDIC17L0018' || $deviceGUID == 'MEDIC18A0036') {
            $return_arr = $this->get_device_json(constant($deviceGUID . '_json'));
            $device_arr = $return_arr['reverse_device_Array'];
            $vehicle_latlong = [];
            foreach ($device_arr as $k => $v) {
                if (date('Y-m-d H:i:s', floor($v['t'] / 1000)) > $pre_datetime && date('Y-m-d H:i:s', floor($v['t'] / 1000)) < $post_datetime) {
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