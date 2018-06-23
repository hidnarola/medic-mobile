<?php

/**
 * Manage operators functionality
 * @author KU
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Operators extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('operators_model');
        //-- Check if logged in user is admin if not admin than redirect user back to dashboard page
        if (!get_AdminLogin('A')) {
            redirect('dashboard');
        }
    }

    /**
     * Display Operators listing
     */
    public function display_operators() {
        $data['title'] = 'List Of Operators';
        $data['heading'] = 'Manage Operators';
        $this->template->load('default_admin', 'super_admin/operator/listing', $data);
    }

    /**
     * Get all the data of operators for data-table listing .
     * @author KU
     * @return JSON
     */
    public function get_operators_data() {
        $final['recordsTotal'] = $this->operators_model->get_all_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $operators = $this->operators_model->get_all_data('result');
        $start = $this->input->get('start') + 1;
        foreach ($operators as $key => $val) {
            $operators[$key] = $val;
            $operators[$key]['sr_no'] = $start++;
        }
        $final['data'] = $operators;
        echo json_encode($final);
    }

    /**
     * Add new company operator
     * @author KU
     */
    public function add_operators() {
        $data['locationArr'] = [];
        $data['companies'] = $this->operators_model->sql_select(TBL_COMPANY, 'companyGUID,companyName');
        $data['heading'] = 'Manage Operators';

        $this->form_validation->set_rules('company_name', 'Company', 'trim|required');
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
            $is_inserted = $this->operators_model->insert_update('insert', TBL_OPERATIVE, $insertArr);
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
                    $this->operators_model->batch_insert_update('insert', TBL_QUALIFICATION, $insertArr2);
                }
                extract($insertArr);
                $email_var = array(
                    'firstName' => htmlentities($this->input->post('txt_forename')),
                    'lastName' => htmlentities($this->input->post('txt_surname')),
                    'username' => htmlentities($this->input->post('txt_username')),
                    'emailAddress' => htmlentities($this->input->post('txt_email')),
                    'password' => $password
                );
                $message = $this->load->view('email_template/default_header.php', $email_var, true);
                $message .= $this->load->view('email_template/comp_reg.php', $email_var, true);
                $message .= $this->load->view('email_template/default_footer.php', $email_var, true);
                $email_array = array(
                    'mail_type' => 'html',
                    'from_mail_id' => $this->config->item('smtp_user'),
                    'from_mail_name' => 'Medic Mobile',
                    'to_mail_id' => htmlentities($this->input->post('txt_email')),
                    'cc_mail_id' => '',
                    'subject_message' => 'Operator Registration',
                    'body_messages' => $message
                );
                $email_send = common_email_send($email_array);
                $this->session->set_flashdata('success', 'Operators has been added successfully.');
                redirect('operators');
            } else {
                $this->session->set_flashdata('success', 'Sorry something went wrong! Please try it again.');
            }
        }
        $this->template->load('default_admin', 'super_admin/operator/add', $data);
    }

    /**
     * Edit operators by its id 
     * @param string $id 
     */
    public function edit_operators($id = null) {
        $operatorID = base64_decode($id);
        $data['dataArr'] = $this->operators_model->get_operators_by_id($operatorID);
        $data['companies'] = $this->operators_model->sql_select(TBL_COMPANY, 'companyGUID,companyName');
        $data['lic_no'] = explode(':-:', $data['dataArr']['lic_no']);
        $data['lic_type'] = explode(':-:', $data['dataArr']['lic_type']);
        $data['exp_date'] = explode(':-:', $data['dataArr']['exp_date']);

        if (!empty($data['dataArr'])) {
            $data['locationArr'] = $this->operators_model->get_depots_by_company($data['dataArr']['companyGUID']);
            $data['heading'] = 'Manage Operators';

            $record_id = base64_decode($id);

            $this->form_validation->set_rules('company_name', 'Company', 'trim|required');
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
                $is_inserted = $this->operators_model->insert_update('update', TBL_OPERATIVE, $insertArr, array('operativeGUID' => $record_id));
                $this->operators_model->insert_update('delete', TBL_QUALIFICATION, array(), array('operativeGUID' => $record_id));

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
                    $this->operators_model->batch_insert_update('insert', TBL_QUALIFICATION, $insertArr2);
                }
                $this->session->set_flashdata('success', 'Operators has been updated successfully.');
                redirect('operators');
            }
            $this->template->load('default_admin', 'super_admin/operator/add', $data);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, Please try again later');
            redirect('operators');
        }
    }

    /**
     * Check operator's email is unique or not
     * @param string $id operativeGUID At the time of edit operators page
     * @author KU
     */
    public function is_unique_operator_email($id = NULL) {
        $id = base64_decode($id);
        $operator_email = trim($this->input->get_post('txt_email'));
        $data = array('email' => $operator_email);
        if (!is_null($id)) {
            $data = array_merge($data, array('operativeGUID!=' => $id));
        }
        $operative = $this->operators_model->check_unique(TBL_OPERATIVE, $data);
        if ($operative > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * check operator's username is unique or not
     * @param string $id operativeGUID At the time of edit operators page
     * 
     */
    public function is_unique_operator_uname($id = NULL) {
        $id = base64_decode($id);
        $operator_uname = trim($this->input->get_post('txt_username'));
        $data = array('username' => $operator_uname);
        if (!is_null($id)) {
            $data = array_merge($data, array('operativeGUID!=' => $id));
        }
        $operative = $this->operators_model->check_unique(TBL_OPERATIVE, $data);
        if ($operative > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * Get all depots of selected company and display it in drop-down
     * @author KU
     */
    public function get_basedepot() {
        $company = $this->input->post('company');
        $all_depots = $this->operators_model->get_depots($company);
        $str = '<option value="">Select a location</option>';

        foreach ($all_depots as $k => $v) {
            $str .= '<option value="' . $v['depotGUID'] . '">' . $v['depotName'] . '</option>';
        }

        echo $str;
        exit;
    }

}
