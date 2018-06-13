<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model','settings_model');
        //-- Check if logged in user is admin if not admin than redirect user back to dashboard page
        if (!get_AdminLogin('A')) {
            redirect('dashboard');
        }
    }

    /**
     * Display areas listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_areas() {
        $data['title'] = 'List of Areas';
        $this->template->load('default_admin', 'super_admin/region/listing', $data);
    }

    /**
     * Get all the data of areas for listing datatable.
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_areas_data() {
        $final['recordsTotal'] = $this->settings_model->get_areas_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $areas = $this->settings_model->get_areas_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($areas as $key => $val) {
            $areas[$key] = $val;
            $areas[$key]['sr_no'] = $start++;
        }
        $final['data'] = $areas;
        echo json_encode($final);
    }

    /**
     * Add areas data with manager details as well as with region data
     * @param --
     * @return redirect
     * @author PAV
     */
    public function add_areas() {
        $data['title'] = 'Add Areas';
        $Sec_managerGUID = '';
        $this->form_validation->set_rules('txt_depot_name', 'Depot Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_addressLine1', 'Address Line1', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('txt_addressLine2', 'Address Line2', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_addressLine3', 'Address Line3', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_postcode', 'Postcode', 'trim|required|max_length[9]');
        $this->form_validation->set_rules('txt_office_phone', 'Office Phone', 'trim|required');
        $this->form_validation->set_rules('txt_depot_name', 'Company Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_manager_name1', 'Manager Email', 'trim|required');
        $this->form_validation->set_rules('txt_manager_mobile1', 'Manager Mobile No.', 'trim|required');
        $this->form_validation->set_rules('txt_manager_email1', 'Manager Email', 'trim|required');
        $data['regionArr'] = $this->settings_model->get_all_details(TBL_REGION, array('companyGUID' => get_AdminLogin('COMP_GUID')), array(array('field' => 'regionName', 'type' => 'asc')))->result_array();
        $data['managerArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array(), array(array('field' => 'firstName', 'type' => 'asc')))->result_array();
        if ($this->form_validation->run() == true) {
            // Depot Details
            $depotGUID = Uuid_v4();
            $insertArr = array(
                'depotGUID' => $depotGUID,
                'regionGUID' => htmlentities($this->input->post('txt_region_name')),
                'depotName' => htmlentities($this->input->post('txt_depot_name')),
                'addressLine1' => htmlentities($this->input->post('txt_addressLine1')),
                'addressLine2' => htmlentities($this->input->post('txt_addressLine2')),
                'addressLine3' => htmlentities($this->input->post('txt_addressLine3')),
                'postcode_zipcode' => htmlentities($this->input->post('txt_postcode')),
                'officePhone' => htmlentities($this->input->post('txt_office_phone')),
                'ManagerGUID' => htmlentities($this->input->post('txt_manager_name1')),
                'secondaryManagerGUID' => htmlentities($this->input->post('txt_manager_name2'))
            );
            $is_deport = $this->settings_model->insert_update('insert', TBL_DEPOT, $insertArr);
            if ($is_deport > 0) {
                $this->session->set_flashdata('success', 'Area has been added successfully.');
                redirect('settings/manage_areas');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try it again.');
            }
        }
        $this->template->load('default_admin', 'super_admin/region/add', $data);
    }

    /**
     * Edit areas data by it's depotGUID
     * @param $id -> string
     * @return redirect
     * @author PAV
     */
    public function edit_areas($id = '') {
        $data['title'] = 'Edit Areas';
        $record_id = base64_decode($id);
        $data['dataArr'] = $dataArr = $this->settings_model->get_area_details_by_id($record_id)->row_array();
        $data['regionArr'] = $this->settings_model->get_all_details(TBL_REGION, array('companyGUID' => get_AdminLogin('COMP_GUID')), array(array('field' => 'regionName', 'type' => 'asc')))->result_array();
        $data['managerArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array(), array(array('field' => 'firstName', 'type' => 'asc')))->result_array();
        $Sec_managerGUID = '';
        $this->form_validation->set_rules('txt_depot_name', 'Depot Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_addressLine1', 'Address Line1', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('txt_addressLine2', 'Address Line2', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_addressLine3', 'Address Line3', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_postcode', 'Postcode', 'trim|required|max_length[9]');
        $this->form_validation->set_rules('txt_office_phone', 'Office Phone', 'trim|required');
        $this->form_validation->set_rules('txt_depot_name', 'Company Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_manager_name1', 'Manager Email', 'trim|required');
        $this->form_validation->set_rules('txt_manager_mobile1', 'Manager Mobile No.', 'trim|required');
        $this->form_validation->set_rules('txt_manager_email1', 'Manager Email', 'trim|required');
        if ($this->form_validation->run() == true) {
            // Depot Details
            $insertArr4 = array(
                'depotName' => htmlentities($this->input->post('txt_depot_name')),
                'regionGUID' => htmlentities($this->input->post('txt_region_name')),
                'addressLine1' => htmlentities($this->input->post('txt_addressLine1')),
                'addressLine2' => htmlentities($this->input->post('txt_addressLine2')),
                'addressLine3' => htmlentities($this->input->post('txt_addressLine3')),
                'postcode_zipcode' => htmlentities($this->input->post('txt_postcode')),
                'officePhone' => htmlentities($this->input->post('txt_office_phone')),
                'ManagerGUID' => htmlentities($this->input->post('txt_manager_name1')),
                'secondaryManagerGUID' => htmlentities($this->input->post('txt_manager_name2'))
            );
            $is_deport = $this->settings_model->insert_update('update', TBL_DEPOT, $insertArr4, array('depotGUID' => $dataArr['depotGUID']));

            $this->session->set_flashdata('success', 'Area has been updated successfully.');
            redirect('settings/manage_areas');
        }
        $this->template->load('default_admin', 'super_admin/region/add', $data);
    }

    /**
     * Add region data by ajax
     * @param --
     * @return JSON
     * @author PAV
     */
    public function add_region_data_ajax() {
        $regionGUID = Uuid_v4();
        $insertArr = array(
            'regionGUID' => $regionGUID,
            'companyGUID' => get_AdminLogin('COMP_GUID'),
            'regionName' => $this->input->post('txt_modal_region_name'),
            'regionDescription' => $this->input->post('txt_modal_region_desc')
        );
        $is_inserted = $this->settings_model->insert_update('insert', TBL_REGION, $insertArr);
        if ($is_inserted > 0) {
            $return = array(
                'status' => 'success',
                'regionGUID' => $regionGUID,
                'regionName' => htmlentities($this->input->post('txt_modal_region_name'))
            );
        }
        echo json_encode($return);
        exit;
    }

    public function view_area_ajax() {
        $area_id = base64_decode($this->input->post('id'));
        $data['viewArr'] = $this->settings_model->get_area_details_by_id($area_id)->row_array();
        return $this->load->view('company_admin/partial_view/area_view', $data);
        die;
    }

}
