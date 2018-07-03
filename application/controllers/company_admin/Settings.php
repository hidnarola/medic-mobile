<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings controller
 * @author pav
 */
class Settings extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('settings_model'));
        $this->isAdmin = true;
        if (!get_AdminLogin('A')) {
            $this->isAdmin = false;
        }
        $this->tier = $this->session->userdata('tier');
    }

    /**
     * General info settings page
     * @author KU
     */
    public function index() {
        $this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_validation');
        $user_id = $this->session->userdata('userGUID');
        $companyGUID = $this->session->userdata('companyGUID');

        if ($this->form_validation->run() == true) {
            $name = htmlentities($this->input->post('name'));
            $name_arr = $this->split_name($name);
            $updateArr = [
                'firstName' => $name_arr[0],
                'lastName' => $name_arr[1],
                'username' => htmlentities($this->input->post('username')),
                'emailAddress' => htmlentities($this->input->post('email')),
            ];
            $this->settings_model->insert_update('update', TBL_LOGIN_DETAILS, $updateArr, ['userGUID' => $user_id]);

            $updateCompArr = array(
                'companyName' => htmlentities($this->input->post('company_name')),
                'phoneNumber' => htmlentities($this->input->post('phone_number')),
                'smsNotification' => htmlentities($this->input->post('sms_notifications')),
                'smsNotification1' => htmlentities($this->input->post('sms_notifications1')),
                'addressLine1' => htmlentities($this->input->post('address')),
            );
            $this->settings_model->insert_update('update', TBL_COMPANY, $updateCompArr, ['companyGUID' => $companyGUID]);

            //-- Update user session data
            $user_ssn_data = array();
            $user_ssn_data['firstName'] = $updateArr['firstName'];
            $user_ssn_data['lastName'] = $updateArr['lastName'];
            $user_ssn_data['username'] = $updateArr['username'];
            $user_ssn_data['emailAddress'] = $updateArr['emailAddress'];

            $this->session->set_userdata($user_ssn_data);

            $this->session->set_flashdata('success', 'Information updated successfully!');
            redirect('settings');
        } else {

            $data['user'] = $this->session->userdata();
            $data['company'] = $this->settings_model->get_all_details(TBL_COMPANY, ['companyGUID' => $companyGUID])->row_array();
            $this->template->load('default', 'company_admin/settings/index', $data);
        }
    }

    /**
     * Update password functionality
     */
    public function updatepassword() {
        $companyGUID = $this->session->userdata('companyGUID');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]|min_length[5]');

        if ($this->form_validation->run() == true) {
            $user_id = $this->session->userdata('userGUID');

            $updateArr = [
                'passwordHash' => md5($this->input->post('password')),
            ];
            $this->settings_model->insert_update('update', TBL_LOGIN_DETAILS, $updateArr, ['userGUID' => $user_id]);
            $this->session->set_flashdata('success', 'Password updated successfully!');
            redirect('settings');
        } else {
            $data['user'] = $this->session->userdata();
            $data['company'] = $this->settings_model->get_all_details(TBL_COMPANY, ['companyGUID' => $companyGUID])->row_array();
            $this->template->load('default', 'company_admin/settings/index', $data);
        }
    }

    /**
     * Callback Validate function to check unique email validation
     * @return boolean
     */
    public function email_validation() {
        $user_id = $this->session->userdata('userGUID');
        $result = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, ['emailAddress' => trim($this->input->post('email')), 'userGUID!=' => $user_id])->row_array();
        if (!empty($result)) {
            $this->form_validation->set_message('email_validation', 'Email Already exist!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Callback Validate function to check username validation
     * @return boolean
     */
    public function username_validation() {
        $user_id = $this->session->userdata('userGUID');
        $result = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, ['username' => trim($this->input->post('username')), 'userGUID!=' => $user_id])->row_array();
        if (!empty($result)) {
            $this->form_validation->set_message('username_validation', 'Username Already exist!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Separate first-name and last-name from full name
     * Uses regex that accepts any word character or hyphen in last name
     * @param string $name
     * @return array
     * @author KU
     */
    public function split_name($name = null) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }

    /**
     * Check user email exist or not for edit profile page
     * @author KU
     */
    public function check_useremail() {
        $requested_email = trim($this->input->get('email'));
        $user_id = $this->session->userdata('userGUID');
        $user = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, ['emailAddress' => $requested_email, 'userGUID!=' => $user_id])->row_array();
        if (!empty($user)) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * Check username exist or not for edit profile page
     * @author KU
     */
    public function check_username() {
        $requested_username = trim($this->input->get('username'));
        $user_id = $this->session->userdata('userGUID');
        $user = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, ['username' => $requested_username, 'userGUID!=' => $user_id])->row_array();
        if (!empty($user)) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    //-- Manage Areas

    /**
     * Display areas listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_areas() {
        $data['title'] = 'List of Areas';
        $this->template->load('default', 'company_admin/settings/display_areas', $data);
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
        $this->template->load('default', 'company_admin/settings/add_areas', $data);
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
        $this->template->load('default', 'company_admin/settings/add_areas', $data);
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

    /*     * ****************************************************
      Manage Users
     * ***************************************************** */

    /**
     * Display users listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_users() {
        $data['title'] = 'List Of Users';
        $this->template->load('default', 'company_admin/settings/display_users', $data);
    }

    /**
     * Get all the data of users for listing datatable.
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_users_data() {
        $final['recordsTotal'] = $this->settings_model->get_users_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $users = $this->settings_model->get_users_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($users as $key => $val) {
            $users[$key] = $val;
            $users[$key]['sr_no'] = $start++;
            $users[$key]['multi_site'] = $val['multi-siteResponsibility'];
        }
        $final['data'] = $users;
        echo json_encode($final);
    }

    /**
     * Add new users
     * @param --
     * @return --
     * @author PAV
     */
    public function add_users() {
        $data['title'] = 'Add Users';
        $data['managerArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array(), array(array('field' => 'firstName', 'type' => 'asc')))->result_array();
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_surname', 'Surname', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('txt_forename', 'Forename', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_office_number', 'Office Number', 'trim|required');
        $this->form_validation->set_rules('txt_mobile_number', 'Mobile Number', 'trim|required');
        if ($this->form_validation->run() == true) {
            $insertArr = array(
                'managerGUID' => Uuid_v4(),
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'firstName' => htmlentities($this->input->post('txt_forename')),
                'lastName' => htmlentities($this->input->post('txt_surname')),
                'email' => htmlentities($this->input->post('txt_email')),
                'officeNumber' => htmlentities($this->input->post('txt_office_number')),
                'mobileNumber' => htmlentities($this->input->post('txt_mobile_number')),
                'multi-siteResponsibility' => ($this->input->post('txt_multi_site') == 'on') ? 1 : 0,
                'lineManagerID' => htmlentities($this->input->post('txt_line_manager')),
                'dailyLogIssuesEmail' => ($this->input->post('txt_email_notfy[0]') == 'on') ? 1 : 0,
                'dailyLogIssuesSMS' => ($this->input->post('txt_sms_notfy[0]') == 'on') ? 1 : 0,
                'faultsEmail' => ($this->input->post('txt_email_notfy[1]') == 'on') ? 1 : 0,
                'faultsSMS' => ($this->input->post('txt_sms_notfy[1]') == 'on') ? 1 : 0,
                'speedEmail' => ($this->input->post('txt_email_notfy[2]') == 'on') ? 1 : 0,
                'speedSMS' => ($this->input->post('txt_sms_notfy[2]') == 'on') ? 1 : 0,
                'incidentsEmails' => ($this->input->post('txt_email_notfy[3]') == 'on') ? 1 : 0,
                'incidentsSMS' => ($this->input->post('txt_sms_notfy[3]') == 'on') ? 1 : 0,
                'notifyLineManagerEmail' => ($this->input->post('txt_email_notfy[4]') == 'on') ? 1 : 0,
                'notifyLineManagerSMS' => ($this->input->post('txt_sms_notfy[4]') == 'on') ? 1 : 0,
                'clearFaults' => ($this->input->post('txt_permission[0]') == 'on') ? 1 : 0,
                'lockUnLock' => ($this->input->post('txt_permission[1]') == 'on') ? 1 : 0,
                'setResetService' => ($this->input->post('txt_permission[2]') == 'on') ? 1 : 0,
                'addUsers' => ($this->input->post('txt_permission[3]') == 'on') ? 1 : 0,
                'addOperatives' => ($this->input->post('txt_permission[4]') == 'on') ? 1 : 0,
                'addLocations' => ($this->input->post('txt_permission[5]') == 'on') ? 1 : 0,
                'addVehicles' => ($this->input->post('txt_permission[6]') == 'on') ? 1 : 0,
                'addFortklifts' => ($this->input->post('txt_permission[7]') == 'on') ? 1 : 0,
                'editSubscriptions' => ($this->input->post('txt_permission[8]') == 'on') ? 1 : 0
            );
            $is_inserted = $this->settings_model->insert_update('insert', TBL_MANAGER, $insertArr);
            if ($is_inserted > 0) {
                $this->session->set_flashdata('success', 'Users has been added successfully.');
                redirect('settings/manage_users');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default', 'company_admin/settings/add_users', $data);
    }

    /**
     * Edit user's details by it's id
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function edit_users($id = '') {
        $data['title'] = 'Edit Users';
        $record_id = base64_decode($id);
        $data['managerArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array('managerGUID!=' => $record_id), array(array('field' => 'firstName', 'type' => 'asc')))->result_array();
        $data['dataArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array('managerGUID' => $record_id))->row_array();
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('txt_surname', 'Surname', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('txt_forename', 'Forename', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|max_length[80]');
        $this->form_validation->set_rules('txt_office_number', 'Office Number', 'trim|required');
        $this->form_validation->set_rules('txt_mobile_number', 'Mobile Number', 'trim|required');
        // $this->form_validation->set_rules('txt_line_manager', 'Line Manager', 'trim|required');
        if ($this->form_validation->run() == true) {
            $updateArr = array(
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'firstName' => htmlentities($this->input->post('txt_forename')),
                'lastName' => htmlentities($this->input->post('txt_surname')),
                'email' => htmlentities($this->input->post('txt_email')),
                'officeNumber' => htmlentities($this->input->post('txt_office_number')),
                'mobileNumber' => htmlentities($this->input->post('txt_mobile_number')),
                'multi-siteResponsibility' => ($this->input->post('txt_multi_site') == 'on') ? 1 : 0,
                'lineManagerID' => htmlentities($this->input->post('txt_line_manager')),
                'dailyLogIssuesEmail' => ($this->input->post('txt_email_notfy[0]') == 'on') ? 1 : 0,
                'dailyLogIssuesSMS' => ($this->input->post('txt_sms_notfy[0]') == 'on') ? 1 : 0,
                'faultsEmail' => ($this->input->post('txt_email_notfy[1]') == 'on') ? 1 : 0,
                'faultsSMS' => ($this->input->post('txt_sms_notfy[1]') == 'on') ? 1 : 0,
                'speedEmail' => ($this->input->post('txt_email_notfy[2]') == 'on') ? 1 : 0,
                'speedSMS' => ($this->input->post('txt_sms_notfy[2]') == 'on') ? 1 : 0,
                'incidentsEmails' => ($this->input->post('txt_email_notfy[3]') == 'on') ? 1 : 0,
                'incidentsSMS' => ($this->input->post('txt_sms_notfy[3]') == 'on') ? 1 : 0,
                'notifyLineManagerEmail' => ($this->input->post('txt_email_notfy[4]') == 'on') ? 1 : 0,
                'notifyLineManagerSMS' => ($this->input->post('txt_sms_notfy[4]') == 'on') ? 1 : 0,
                'clearFaults' => ($this->input->post('txt_permission[0]') == 'on') ? 1 : 0,
                'lockUnLock' => ($this->input->post('txt_permission[1]') == 'on') ? 1 : 0,
                'setResetService' => ($this->input->post('txt_permission[2]') == 'on') ? 1 : 0,
                'addUsers' => ($this->input->post('txt_permission[3]') == 'on') ? 1 : 0,
                'addOperatives' => ($this->input->post('txt_permission[4]') == 'on') ? 1 : 0,
                'addLocations' => ($this->input->post('txt_permission[5]') == 'on') ? 1 : 0,
                'addVehicles' => ($this->input->post('txt_permission[6]') == 'on') ? 1 : 0,
                'addFortklifts' => ($this->input->post('txt_permission[7]') == 'on') ? 1 : 0,
                'editSubscriptions' => ($this->input->post('txt_permission[8]') == 'on') ? 1 : 0
            );
            $is_inserted = $this->settings_model->insert_update('update', TBL_MANAGER, $updateArr, array('managerGUID' => $record_id));
            $this->session->set_flashdata('success', 'Users has been added successfully.');
            redirect('settings/manage_users');
        }
        $this->template->load('default', 'company_admin/settings/add_users', $data);
    }

    public function view_user_ajax() {
        $user_id = base64_decode($this->input->post('id'));
        $data['viewArr'] = $this->settings_model->get_all_details(TBL_MANAGER, array('managerGUID' => $user_id))->row_array();
        return $this->load->view('company_admin/partial_view/user_view', $data);
        die;
    }

    /*     * ****************************************************
      Manage Vehicles
     * ***************************************************** */

    /**
     * Display vehicles listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_vehicles() {
        $data['title'] = 'List Of Vehicles';
        $this->template->load('default', 'company_admin/settings/display_vehicles', $data);
    }

    /**
     * Get all the data of vehicles for listing datatable.
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_vehicles_data() {
        $final['recordsTotal'] = $this->settings_model->get_vehicles_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $vehicles = $this->settings_model->get_vehicles_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($vehicles as $key => $val) {
            $vehicles[$key] = $val;
            $vehicles[$key]['sr_no'] = $start++;
        }
        $final['data'] = $vehicles;
        echo json_encode($final);
    }

    /**
     * Add new vehicles
     * @param --
     * @return --
     * @author PAV
     */
    public function add_vehicles() {
        $data['title'] = 'Add Vehicles';
        $data['depotArray'] = $this->settings_model->get_all_details(TBL_DEPOT, array(), array(array('field' => 'depotName', 'type' => 'ASC')))->result_array();
        $data['used_depotGUID'] = array_column($this->vehicle_model->get_vehicle_depot(), 'baseDepotGUID');
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
                redirect('settings/manage_vehicles');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default', 'company_admin/settings/add_vehicles', $data);
    }

    /**
     * Edit user's details by it's id
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function edit_vehicles($id = '') {
        $data['title'] = 'Edit Vehicles';
        $record_id = base64_decode($id);
        $data['depotArray'] = $this->settings_model->get_all_details(TBL_DEPOT, array(), array(array('field' => 'depotName', 'type' => 'ASC')))->result_array();
        $data['used_depotGUID'] = array_column($this->vehicle_model->get_vehicle_depot(), 'baseDepotGUID');
        $data['dataArr'] = $this->settings_model->get_all_details(TBL_VEHICLE, array('vehicleGUID' => $record_id))->row_array();
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
            redirect('settings/manage_vehicles');
        }
        $this->template->load('default', 'company_admin/settings/add_vehicles', $data);
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

    /*     * ****************************************************
      Manage ForkLifts
     * ***************************************************** */

    /**
     * Display ForkLifts listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_forklifts() {
        $data['title'] = 'List Of ForkLifts';
        $this->template->load('default', 'company_admin/settings/display_forklifts', $data);
    }

    /**
     * Get all the data of forklifts for listing datatable.
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_forklifts_data() {
        $final['recordsTotal'] = $this->settings_model->get_forklifts_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $forklifts = $this->settings_model->get_forklifts_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($forklifts as $key => $val) {
            $forklifts[$key] = $val;
            $forklifts[$key]['sr_no'] = $start++;
        }
        $final['data'] = $forklifts;
        echo json_encode($final);
    }

    /**
     * Add new forklifts
     * @param --
     * @return --
     * @author PAV
     */
    public function add_forklifts() {
        $data['title'] = 'Add Forklifts';
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_reg_no', 'Registration No', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_vin_no', 'VIN No', 'trim|required|max_length[17]');
        $this->form_validation->set_rules('txt_fuel_type', 'Fuel Type', 'trim|required');
        $this->form_validation->set_rules('txt_licence_type', 'License Type', 'trim|required');
        $this->form_validation->set_rules('txt_wheel_no', 'Wheel Number', 'trim|required|max_length[1]');

        $this->form_validation->set_rules('txt_tyre1[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[3]', 'Tyre Quantity', 'trim|required');

        $this->form_validation->set_rules('txt_tyre2[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[3]', 'Tyre Quantity', 'trim|required');

        $this->form_validation->set_rules('txt_tyre3[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[3]', 'Tyre Quantity', 'trim|required');
        if ($this->form_validation->run() == true) {
            $insertArr = array(
                'forkliftGUID' => Uuid_v4(),
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'registration' => htmlentities($this->input->post('txt_reg_no')),
                'vin' => htmlentities($this->input->post('txt_vin_no')),
                'fuelType' => htmlentities($this->input->post('txt_fuel_type')),
                'licenceType' => htmlentities($this->input->post('txt_licence_type')),
                'currentHourReading' => htmlentities($this->input->post('txt_curr_hrs')),
                'numberOfWheels' => htmlentities($this->input->post('txt_wheel_no')),
                'resetServiceCounter' => ($this->input->post('txt_reset_counter') == 'on') ? 1 : 0,
                'axle1TyreSize' => htmlentities($this->input->post('txt_tyre1[0]')),
                'axle1Radius' => htmlentities($this->input->post('txt_tyre1[1]')),
                'axle1psi' => htmlentities($this->input->post('txt_tyre1[2]')),
                'axle1Quantity' => htmlentities($this->input->post('txt_tyre1[3]')),
                'axle2TyreSize' => htmlentities($this->input->post('txt_tyre2[0]')),
                'axle2Radius' => htmlentities($this->input->post('txt_tyre2[1]')),
                'axle2psi' => htmlentities($this->input->post('txt_tyre2[2]')),
                'axle2Quantity' => htmlentities($this->input->post('txt_tyre2[3]')),
                'axle3TyreSize' => htmlentities($this->input->post('txt_tyre3[0]')),
                'axle3Radius' => htmlentities($this->input->post('txt_tyre3[1]')),
                'axle3psi' => htmlentities($this->input->post('txt_tyre3[2]')),
                'axle3Quantity' => htmlentities($this->input->post('txt_tyre3[3]')),
                'serviceIntervals' => htmlentities($this->input->post('txt_service_intervals')),
                'lastServiceDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_service_date')))),
                'lastServiceHrs' => htmlentities($this->input->post('txt_last_service_hrs')),
                'nextServiceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_next_service_due')))),
                'roadDutyDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_road_duty_due')))),
                'inspectionIntervals' => htmlentities($this->input->post('txt_inspection_intervals')),
                'lastInspectionDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_inspection_date')))),
                'lastInspectionHrs' => htmlentities($this->input->post('txt_last_inspection_hrs')),
                'nextInspectionDue' => htmlentities($this->input->post('txt_next_inspection_due')),
                'insuranceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_insurance_due')))),
                'forkTruckStatus' => ($this->input->post('txt_status') == 'on') ? 1 : 0,
                'locked' => ($this->input->post('txt_locked') == 'on') ? 1 : 0,
            );
            $is_inserted = $this->settings_model->insert_update('insert', TBL_FORKLIFT, $insertArr);
            if ($is_inserted > 0) {
                $this->session->set_flashdata('success', 'ForkLift has been added successfully.');
                redirect('settings/manage_forklifts');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default', 'company_admin/settings/add_forklifts');
    }

    /**
     * Edit forklifts's details by it's id
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function edit_forklifts($id = '') {
        $data['title'] = 'Edit ForkLifts';
        $record_id = base64_decode($id);
        $data['dataArr'] = $this->settings_model->get_all_details(TBL_FORKLIFT, array('forkliftGUID' => $record_id))->row_array();
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_reg_no', 'Registration No', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_vin_no', 'VIN No', 'trim|required|max_length[17]');
        $this->form_validation->set_rules('txt_fuel_type', 'Fuel Type', 'trim|required');
        $this->form_validation->set_rules('txt_licence_type', 'License Type', 'trim|required');
        $this->form_validation->set_rules('txt_wheel_no', 'Wheel Number', 'trim|required|max_length[1]');

        $this->form_validation->set_rules('txt_tyre1[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre1[3]', 'Tyre Quantity', 'trim|required');

        $this->form_validation->set_rules('txt_tyre2[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre2[3]', 'Tyre Quantity', 'trim|required');

        $this->form_validation->set_rules('txt_tyre3[0]', 'Tyre Size', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[1]', 'Tyre Radius', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[2]', 'Tyre PSI', 'trim|required');
        $this->form_validation->set_rules('txt_tyre3[3]', 'Tyre Quantity', 'trim|required');
        if ($this->form_validation->run() == true) {
            $updateArr = array(
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'registration' => htmlentities($this->input->post('txt_reg_no')),
                'vin' => htmlentities($this->input->post('txt_vin_no')),
                'fuelType' => htmlentities($this->input->post('txt_fuel_type')),
                'licenceType' => htmlentities($this->input->post('txt_licence_type')),
                'currentHourReading' => htmlentities($this->input->post('txt_curr_hrs')),
                'numberOfWheels' => htmlentities($this->input->post('txt_wheel_no')),
                'resetServiceCounter' => ($this->input->post('txt_reset_counter') == 'on') ? 1 : 0,
                'axle1TyreSize' => htmlentities($this->input->post('txt_tyre1[0]')),
                'axle1Radius' => htmlentities($this->input->post('txt_tyre1[1]')),
                'axle1psi' => htmlentities($this->input->post('txt_tyre1[2]')),
                'axle1Quantity' => htmlentities($this->input->post('txt_tyre1[3]')),
                'axle2TyreSize' => htmlentities($this->input->post('txt_tyre2[0]')),
                'axle2Radius' => htmlentities($this->input->post('txt_tyre2[1]')),
                'axle2psi' => htmlentities($this->input->post('txt_tyre2[2]')),
                'axle2Quantity' => htmlentities($this->input->post('txt_tyre2[3]')),
                'axle3TyreSize' => htmlentities($this->input->post('txt_tyre3[0]')),
                'axle3Radius' => htmlentities($this->input->post('txt_tyre3[1]')),
                'axle3psi' => htmlentities($this->input->post('txt_tyre3[2]')),
                'axle3Quantity' => htmlentities($this->input->post('txt_tyre3[3]')),
                'serviceIntervals' => htmlentities($this->input->post('txt_service_intervals')),
                'lastServiceDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_service_date')))),
                'lastServiceHrs' => htmlentities($this->input->post('txt_last_service_hrs')),
                'nextServiceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_next_service_due')))),
                'roadDutyDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_road_duty_due')))),
                'inspectionIntervals' => htmlentities($this->input->post('txt_inspection_intervals')),
                'lastInspectionDate' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_last_inspection_date')))),
                'lastInspectionHrs' => htmlentities($this->input->post('txt_last_inspection_hrs')),
                'nextInspectionDue' => htmlentities($this->input->post('txt_next_inspection_due')),
                'insuranceDue' => date('Y-m-d', strtotime(htmlentities($this->input->post('txt_insurance_due')))),
                'forkTruckStatus' => ($this->input->post('txt_status') == 'on') ? 1 : 0,
                'locked' => ($this->input->post('txt_locked') == 'on') ? 1 : 0,
            );
            $is_inserted = $this->settings_model->insert_update('update', TBL_FORKLIFT, $updateArr, array('forkliftGUID' => $record_id));
            $this->session->set_flashdata('success', 'ForkLift has been updated successfully.');
            redirect('settings/manage_forklifts');
        }
        $this->template->load('default', 'company_admin/settings/add_forklifts', $data);
    }

    /**
     * Check ForkLift's Name is it unique
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function forklift_Name($id = NULL) {
        $vin = trim($this->input->get('txt_vin_no'));
        $condition = 'f.vin="' . $vin . '"';
        if ($id != '') {
            $condition .= " AND f.forkliftGUID!=" . $id;
        }
        $result = $this->settings_model->check_unique_forklift($condition);
        if ($result) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /*     * ****************************************************
      Manage Operators
     * ***************************************************** */

    /**
     * Display Operators listing
     * @param --
     * @return --
     * @author PAV
     */
    public function display_operators() {
        $data['title'] = 'List Of Operators';
        $data['locationArr'] = $this->settings_model->get_depot_by_company()->result_array();
        $this->template->load('default', 'company_admin/settings/display_operators', $data);
    }

    /**
     * Get all the data of operators for listing datatable.
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_operators_data() {
        $final['recordsTotal'] = $this->settings_model->get_operators_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $operators = $this->settings_model->get_operators_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($operators as $key => $val) {
            $operators[$key] = $val;
            $operators[$key]['sr_no'] = $start++;
        }
        $final['data'] = $operators;
        echo json_encode($final);
    }

    /**
     * Add new operators
     * @param --
     * @return --
     * @author PAV
     */
    public function add_operators() {
        $data['locationArr'] = $this->settings_model->get_depot_by_company()->result_array();
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required');
        $this->form_validation->set_rules('txt_surname', 'Surname', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_forename', 'Forename', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_dob', 'Date Of Birth', 'trim|required');
        if ($this->form_validation->run() == true) {
            $operativeGUID = Uuid_v4();
            $password = htmlentities($this->input->post('txt_pass')); //randomPassword();
            $insertArr = array(
                'operativeGUID' => $operativeGUID,
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'firstName' => htmlentities($this->input->post('txt_forename')),
                'lastName' => htmlentities($this->input->post('txt_surname')),
                'DOB' => date('Y-m-d', strtotime(str_replace('/', '-', htmlentities($this->input->post('txt_dob'))))),
                'employee' => ($this->input->post('txt_is_employee') == 'on') ? 1 : 0,
                'username' => htmlentities($this->input->post('txt_username')), //$this->generate_unique_username(htmlentities($this->input->post('txt_surname')).' '.htmlentities($this->input->post('txt_forename'))),
                'passwordHash' => md5($password),
                'email' => htmlentities($this->input->post('txt_email'))
            );
            $is_inserted = $this->settings_model->insert_update('insert', TBL_OPERATIVE, $insertArr);
            if ($is_inserted > 0) {
                $lic_type_arr = $this->input->post('txt_licence_type[]');
                $lic_no_arr = $this->input->post('txt_licence_no[]');
                $exp_date_arr = $this->input->post('txt_expiry_date[]');
                $insertArr2 = array();
                foreach ($lic_type_arr as $k => $v) {
                    if ($lic_type_arr[$k] != '' && $lic_no_arr[$k] != '' && $exp_date_arr[$k] != '') {
                        $insertArr2[] = array(
                            'qualificationID' => Uuid_v4(),
                            'operativeGUID' => $operativeGUID,
                            'number' => $lic_no_arr[$k],
                            'type' => $lic_type_arr[$k],
                            'expiry' => date('Y-m-d', strtotime(str_replace('/', '-', $exp_date_arr[$k])))
                        );
                    }
                }
                if (!empty($insertArr2)) {
                    $this->settings_model->batch_insert_update('insert', TBL_QUALIFICATION, $insertArr2);
                }
                extract($insertArr);
                $email_var = array(
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'username' => $username,
                    'emailAddress' => $email,
                    'password' => $password
                );
                $message = $this->load->view('email_template/default_header.php', $email_var, true);
                $message .= $this->load->view('email_template/comp_reg.php', $email_var, true);
                $message .= $this->load->view('email_template/default_footer.php', $email_var, true);
                $email_array = array(
                    'mail_type' => 'html',
                    'from_mail_id' => $this->config->item('smtp_user'),
                    'from_mail_name' => 'Medic Mobile',
                    'to_mail_id' => $email,
                    'cc_mail_id' => '',
                    'subject_message' => 'Operator Registration',
                    'body_messages' => $message
                );
                $email_send = common_email_send($email_array);
                $this->session->set_flashdata('success', 'Operators has been added successfully.');
                redirect('settings/manage_operators');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default', 'company_admin/settings/display_operators', $data);
    }

    /**
     * Edit forklifts's details by it's id
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function edit_operators($id = '') {
        $record_id = base64_decode($id);
        $this->form_validation->set_rules('txt_base_depot', 'Base Depot', 'trim|required');
        $this->form_validation->set_rules('txt_surname', 'Surname', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_forename', 'Forename', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('txt_dob', 'Date Of Birth', 'trim|required');
        if ($this->form_validation->run() == true) {
            $password = htmlentities($this->input->post('txt_pass')); //randomPassword();
            $insertArr = array(
                'baseDepotGUID' => htmlentities($this->input->post('txt_base_depot')),
                'firstName' => htmlentities($this->input->post('txt_forename')),
                'lastName' => htmlentities($this->input->post('txt_surname')),
                'DOB' => date('Y-m-d', strtotime(str_replace('/', '-', htmlentities($this->input->post('txt_dob'))))),
                'employee' => ($this->input->post('txt_is_employee') == 'on') ? 1 : 0,
                'username' => htmlentities($this->input->post('txt_username')), //$this->generate_unique_username(htmlentities($this->input->post('txt_surname')).' '.htmlentities($this->input->post('txt_forename'))),
                'email' => htmlentities($this->input->post('txt_email'))
            );
            if ($password != '') {
                $insertArr['passwordHash'] = md5($password);
            }
            $is_inserted = $this->settings_model->insert_update('update', TBL_OPERATIVE, $insertArr, array('operativeGUID' => $record_id));
            $this->settings_model->insert_update('delete', TBL_QUALIFICATION, array(), array('operativeGUID' => $record_id));

            $lic_type_arr = $this->input->post('txt_licence_type[]');
            $lic_no_arr = $this->input->post('txt_licence_no[]');
            $exp_date_arr = $this->input->post('txt_expiry_date[]');
            $insertArr2 = array();
            foreach ($lic_type_arr as $k => $v) {
                if ($lic_type_arr[$k] != '' && $lic_no_arr[$k] != '' && $exp_date_arr[$k] != '') {
                    $insertArr2[] = array(
                        'operativeGUID' => $record_id,
                        'number' => $lic_no_arr[$k],
                        'type' => $lic_type_arr[$k],
                        'expiry' => date('Y-m-d', strtotime(str_replace('/', '-', $exp_date_arr[$k])))
                    );
                }
            }
            if (!empty($insertArr2)) {
                $this->settings_model->batch_insert_update('insert', TBL_QUALIFICATION, $insertArr2);
            }
            $this->session->set_flashdata('success', 'Operators has been updated successfully.');
            redirect('settings/manage_operators');
        }
        $this->template->load('default', 'company_admin/settings/display_operators', $data);
    }

    public function get_operators_data_ajax() {
        $operatorID = base64_decode($this->input->post('id'));
        $dataArr = $this->settings_model->get_operators_by_id($operatorID);
        echo json_encode($dataArr);
    }

    public function is_unique_operator_email($id = NULL) {
        $id = base64_decode($id);
        $operator_email = trim($this->input->get_post('txt_email'));
        $data = array('email' => $operator_email);
        if (!is_null($id)) {
            $data = array_merge($data, array('operativeGUID!=' => $id));
        }
        $operative = $this->settings_model->check_unique(TBL_OPERATIVE, $data);
        if ($operative > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    public function is_unique_operator_uname($id = NULL) {
        $id = base64_decode($id);
        $operator_uname = trim($this->input->get_post('txt_username'));
        $data = array('username' => $operator_uname);
        if (!is_null($id)) {
            $data = array_merge($data, array('operativeGUID!=' => $id));
        }
        $operative = $this->settings_model->check_unique(TBL_OPERATIVE, $data);
        if ($operative > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

}

/* End of file Settings.php */
/* Location: ./application/controllers/company_admin/Settings.php */