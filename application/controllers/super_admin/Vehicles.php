<?php

/**
 * Manage vehicles functionality : Super Admin
 * @author KU
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('vehicle_model', 'settings_model', 'users_model'));
        //-- Check if logged in user is admin if not admin than redirect user back to dashboard page
        if (!get_AdminLogin('A')) {
            redirect('dashboard');
        }
    }

    /**
     * Display vehicles listing
     * @author KU
     */
    public function display_vehicles() {
        $data['heading'] = 'Manage Vehicles';
        $data['title'] = 'List Of Vehicles';
        $this->template->load('default_admin', 'super_admin/vehicle/listing', $data);
    }

    /**
     * Get vehicles data for data-table listing
     * @author KU
     * @return JSON
     */
    public function get_vehicles_data() {
        $final['recordsTotal'] = $this->vehicle_model->get_results('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $vehicles = $this->vehicle_model->get_results('result');
        $start = $this->input->get('start') + 1;
        foreach ($vehicles as $key => $val) {
            $vehicles[$key] = $val;
            $vehicles[$key]['sr_no'] = $start++;
        }
        $final['data'] = $vehicles;
        echo json_encode($final);
    }

    /**
     * Add new vehicle
     * @author KU
     */
    public function add_vehicles() {
        $data['title'] = 'Add Vehicles';
        $data['heading'] = 'Manage Vehicles';
        $data['companies'] = $this->vehicle_model->sql_select(TBL_COMPANY, 'companyGUID,companyName');

//        $data['depotArray'] = $this->settings_model->get_all_details(TBL_DEPOT, array(), array(array('field' => 'depotName', 'type' => 'ASC')))->result_array();
        $data['depotArray'] = [];
        $data['used_depotGUID'] = array_column($this->vehicle_model->get_vehicle_depot(), 'baseDepotGUID');

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('txt_device_id', 'Device ID', 'trim|required|max_length[45]|is_unique[vehicle.deviceGUID]');
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_reg_no', 'Registration No', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_vin_no', 'VIN No', 'trim|required|max_length[17]');
        $this->form_validation->set_rules('txt_fuel_type', 'Fuel Type', 'trim|required');
        $this->form_validation->set_rules('txt_licence_type', 'License Type', 'trim|required');
        if ($this->form_validation->run() == true) {
            $vehicle_type = $this->input->post('vehicle_type');
            if (!in_array($vehicle_type, array('car', 'van', 'flatbed_lorry', 'articulated_lorry', 'forklift_truck'))) {
                $vehicle_type = 'car';
            }

            $odo_measurment = $this->input->post('odo_measurment');
            if (!in_array($odo_measurment, array('km', 'miles', 'hours'))) {
                $odo_measurment = 'km';
            }
            $insertArr = array(
                'vehicleGUID' => Uuid_v4(),
                'deviceGUID' => htmlentities($this->input->post('txt_device_id')),
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'registration' => htmlentities($this->input->post('txt_reg_no')),
                'description' => htmlentities($this->input->post('txt_vehicle_desc')),
                'vin' => htmlentities($this->input->post('txt_vin_no')),
                'fuelType' => htmlentities($this->input->post('txt_fuel_type')),
                'licenceType' => htmlentities($this->input->post('txt_licence_type')),
                'odoReading' => htmlentities($this->input->post('txt_curr_odo')),
                'resetServiceCounter' => ($this->input->post('txt_reset_counter') == 'on') ? 1 : 0,
                'serviceIntervals' => htmlentities($this->input->post('txt_service_intervals')),
                'lastServiceDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_service_date')))),
                'lastServiceODO' => htmlentities($this->input->post('txt_last_service_odo')),
                'nextServiceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_next_service_due')))),
                'roadDutyDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_road_due_date')))),
                'inspectionIntervals' => htmlentities($this->input->post('txt_inspeaction_intervals')),
                'lastInspectionDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_inspection_date')))),
                'lastInspectionODO' => htmlentities($this->input->post('txt_last_service_odo')),
                'nextInspectionDue' => htmlentities($this->input->post('txt_last_inspection_due')),
                'insuranceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_insurance_due')))),
                'type' => $vehicle_type,
                'odo_measurment' => $odo_measurment,
                'is_google_route' => ($this->input->post('txt_google_route') == 'on') ? 1 : 0
            );
            $is_inserted = $this->settings_model->insert_update('insert', TBL_VEHICLE, $insertArr);
            if ($is_inserted > 0) { 
                $this->session->set_flashdata('success', 'Vehicles has been added successfully.');
                redirect('vehicles');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default_admin', 'super_admin/vehicle/add', $data);
    }

    /**
     * Edit vehicle details by its id
     * @param string $id
     * @return redirect
     * @author KU
     */
    public function edit_vehicles($id = '') {
        $data['title'] = 'Edit Vehicles';
        $data['heading'] = 'Manage Vehicles';
        $data['companies'] = $this->vehicle_model->sql_select(TBL_COMPANY, 'companyGUID,companyName');

        $record_id = base64_decode($id);
        $data['depotArray'] = $this->settings_model->get_all_details(TBL_DEPOT, array(), array(array('field' => 'depotName', 'type' => 'ASC')))->result_array();

        $data['used_depotGUID'] = array_column($this->vehicle_model->get_vehicle_depot(), 'baseDepotGUID');
//        $data['dataArr'] = $this->settings_model->get_all_details(TBL_VEHICLE, array('vehicleGUID' => $record_id))->row_array();
        $data['dataArr'] = $this->vehicle_model->get_vehicle_by_id($record_id);

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('txt_device_id', 'Device ID', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_reg_no', 'Registration No', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_vin_no', 'VIN No', 'trim|required|max_length[17]');
        $this->form_validation->set_rules('txt_fuel_type', 'Fuel Type', 'trim|required');
        $this->form_validation->set_rules('txt_licence_type', 'License Type', 'trim|required');

        if ($this->form_validation->run() == true) {
            $vehicle_type = $this->input->post('vehicle_type');
            if (!in_array($vehicle_type, array('car', 'van', 'flatbed_lorry', 'articulated_lorry', 'forklift_truck'))) {
                $vehicle_type = 'car';
            }

            $odo_measurment = $this->input->post('odo_measurment');
            if (!in_array($odo_measurment, array('km', 'miles', 'hours'))) {
                $odo_measurment = 'km';
            }

            $updateArr = array(
                'deviceGUID' => htmlentities($this->input->post('txt_device_id')),
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'registration' => htmlentities($this->input->post('txt_reg_no')),
                'description' => htmlentities($this->input->post('txt_vehicle_desc')),
                'vin' => htmlentities($this->input->post('txt_vin_no')),
                'fuelType' => htmlentities($this->input->post('txt_fuel_type')),
                'licenceType' => htmlentities($this->input->post('txt_licence_type')),
                'odoReading' => htmlentities($this->input->post('txt_curr_odo')),
                'resetServiceCounter' => ($this->input->post('txt_reset_counter') == 'on') ? 1 : 0,
                'serviceIntervals' => htmlentities($this->input->post('txt_service_intervals')),
                'lastServiceDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_service_date')))),
                'lastServiceODO' => htmlentities($this->input->post('txt_last_service_odo')),
                'nextServiceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_next_service_due')))),
                'roadDutyDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_road_due_date')))),
                'inspectionIntervals' => htmlentities($this->input->post('txt_inspeaction_intervals')),
                'lastInspectionDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_inspection_date')))),
                'lastInspectionODO' => htmlentities($this->input->post('txt_last_service_odo')),
                'nextInspectionDue' => htmlentities($this->input->post('txt_last_inspection_due')),
                'insuranceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_insurance_due')))),
                'type' => $vehicle_type,
                'odo_measurment' => $odo_measurment,
                'is_google_route' => ($this->input->post('txt_google_route') == 'on') ? 1 : 0
            );
            $is_inserted = $this->settings_model->insert_update('update', TBL_VEHICLE, $updateArr, array('vehicleGUID' => $record_id));
            $this->session->set_flashdata('success', 'Vehicles has been updated successfully.');
            redirect('vehicles');
        }
        $this->template->load('default_admin', 'super_admin/vehicle/add', $data);
    }

    public function checkUnique_device_id($vehicleGUID = NULL) {
        $device_id = trim($this->input->get('txt_device_id'));
        $condition['deviceGUID'] = $device_id;
        if ($vehicleGUID != '') {
            $condition['vehicleGUID'] = $vehicleGUID;
        }
        $result = $this->settings_model->get_all_details(TBL_VEHICLE, $condition)->result_array();
        //$result = $this->menu_model->check_unique_menu_item($condition);
        if ($result) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * Get all depots of selected company and display it in dropdown
     * @author KU
     */
    public function get_basedepot() {
        $company = $this->input->post('company');
        $baseDepot = $this->input->post('baseDepot');

        $all_depots = $this->vehicle_model->get_depots($company);
        $used_depotGUID = array_column($this->vehicle_model->get_vehicle_depot(), 'baseDepotGUID');
        $str = '<option value="">Select</option>';

        foreach ($all_depots as $k => $v) {
            $disabled = '';
            if (in_array($v['depotGUID'], $used_depotGUID) && ($baseDepot != $v['depotGUID'])) {
                $disabled = 'disabled';
            }

            $str .= '<option value="' . $v['depotGUID'] . '" ' . $disabled . '>' . $v['depotName'] . '</option>';
        }

        echo $str;
        exit;
    }

    /**
     * Ajax call to this function get vehicle data
     * @author KU
     */
    public function view($vehicleGUID = NULL) {
        $vehicleGUID = base64_decode($vehicleGUID);
        $data['viewArr'] = $this->vehicle_model->get_vehicle_by_id($vehicleGUID);
        return $this->load->view('super_admin/vehicle/view', $data);
        die;
    }

}

/* End of file Vehicles.php */
/* Location: ./application/controllers/super_admin/Vehicles.php */