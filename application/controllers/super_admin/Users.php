<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('company_model', 'settings_model'));
        if (!get_AdminLogin('A')) {
            redirect('dashboard');
        }
    }

    /*     * *************************************************************
      Manage Company
     * ************************************************************* */

    /**
     * Display Company details in listing datatable
     * @param --
     * @return --
     * @author PAV
     */
    public function display_company() {
        $data['title'] = 'List of Company';
        $this->template->load('default_admin', 'super_admin/company/display', $data);
    }

    /**
     * Get company data by ajax
     * @param --
     * @return JSON
     * @author PAV
     */
    public function get_company_data() {
        $final['recordsTotal'] = $this->company_model->get_company_data('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $company = $this->company_model->get_company_data('result')->result_array();
        $start = $this->input->get('start') + 1;
        foreach ($company as $key => $val) {
            $company[$key] = $val;
            $company[$key]['sr_no'] = $start++;
        }
        $final['data'] = $company;
        echo json_encode($final);
    }

    /**
     * Add new company details
     * @param --
     * @return --
     * @author PAV
     */
    public function add_company() {
        $data['title'] = 'Add Company';
        $this->form_validation->set_rules('name', 'Company Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
        if ($this->form_validation->run() == true) {
            $insertArr = array(
                'companyGUID' => Uuid_v4(),
                'companyName' => htmlentities($this->input->post('name')),
                'addressLine1' => htmlentities($this->input->post('address')),
                'addressLine2' => '',
                'town_city' => htmlentities($this->input->post('city')),
                'country_state' => htmlentities($this->input->post('state')),
                'country' => htmlentities($this->input->post('country')),
                'postcode_zipcode' => htmlentities($this->input->post('postal_code')),
                'latitude' => htmlentities($this->input->post('latitude')),
                'longitude' => htmlentities($this->input->post('longitude')),
                'allowAPIAccess' => '',
                'apiAllowedIpAddresses' => '',
                'parentCompanyGUID' => 0
            );
            $is_comp_insert = $this->company_model->insert_update('insert', TBL_COMPANY, $insertArr);
            extract($insertArr);
            $password = htmlentities($this->input->post('txt_pass')); //randomPassword();
            $insertArr2 = array(
                'userGUID' => Uuid_v4(),
                'firstName' => htmlentities($this->input->post('txt_fname')),
                'lastName' => htmlentities($this->input->post('txt_lname')),
                'username' => htmlentities($this->input->post('txt_uname')),
                'emailAddress' => htmlentities($this->input->post('txt_email')),
                'companyGUID' => $companyGUID,
                'isAdmin' => 0,
                'passwordHash' => md5($password)
            );
            $is_loginDetails = $this->company_model->insert_update('insert', TBL_LOGIN_DETAILS, $insertArr2);
            extract($insertArr2);
            $email_var = array(
                'userGUID' => $userGUID,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'username' => $username,
                'emailAddress' => $emailAddress,
                'password' => $password
            );
            $message = $this->load->view('email_template/default_header.php', $email_var, true);
            $message .= $this->load->view('email_template/comp_reg.php', $email_var, true);
            $message .= $this->load->view('email_template/default_footer.php', $email_var, true);
            $email_array = array(
                'mail_type' => 'html',
                'from_mail_id' => $this->config->item('smtp_user'),
                'from_mail_name' => 'Medic Mobile',
                'to_mail_id' => $emailAddress,
                'cc_mail_id' => '',
                'subject_message' => 'Company Registration',
                'body_messages' => $message
            );
            $email_send = common_email_send($email_array);
            if ($is_comp_insert > 0 && $is_loginDetails > 0) {
                $this->session->set_flashdata('success', 'Company has been added successfully.');
                redirect('manage_company');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try it again.');
            }
        }
        $this->template->load('default_admin', 'super_admin/company/add', $data);
    }

    /**
     * Edit company details by its id
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function edit_company($id = '') {
        $data['title'] = 'Edit Company';
        $record_id = base64_decode($id);
        $data['dataArr'] = $this->company_model->get_all_details(TBL_COMPANY, array('companyGUID' => $record_id))->row_array();
        $data['LoginDetailsArr'] = $this->company_model->get_all_details(TBL_LOGIN_DETAILS, array('companyGUID' => $record_id))->row_array();
        $this->form_validation->set_rules('name', 'Company Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
        if ($this->form_validation->run() == true) {
            $updateArr = array(
                'companyName' => htmlentities($this->input->post('name')),
                'addressLine1' => htmlentities($this->input->post('address')),
                'addressLine2' => '',
                'town_city' => htmlentities($this->input->post('city')),
                'country_state' => htmlentities($this->input->post('state')),
                'country' => htmlentities($this->input->post('country')),
                'postcode_zipcode' => htmlentities($this->input->post('postal_code')),
                'latitude' => htmlentities($this->input->post('latitude')),
                'longitude' => htmlentities($this->input->post('longitude')),
                'allowAPIAccess' => '',
                'apiAllowedIpAddresses' => '',
                'parentCompanyGUID' => 0
            );
            $this->company_model->insert_update('update', TBL_COMPANY, $updateArr, array('companyGUID' => $record_id));
            $this->session->set_flashdata('success', 'Company has been updated successfully.');
            redirect('manage_company');
        }
        $this->template->load('default_admin', 'super_admin/company/add', $data);
    }

    /**
     * Check email validation for unique email
     * @param string $userGUID Edit time 
     * @author KU
     */
    public function check_useremail($userGUID = null) {
        $requested_email = trim($this->input->get('txt_email'));
        if ($userGUID != '') {
            $where = ['emailAddress' => $requested_email, 'userGUID!=' => $userGUID];
        } else {
            $where = ['emailAddress' => $requested_email];
        }
        $user = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, $where)->row_array();
        if (!empty($user)) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * Check unique username exist or not for edit profile page
     * @author KU
     */
    public function check_username($userGUID = null) {
        $requested_username = trim($this->input->get('txt_uname'));
        if ($userGUID != '') {
            $where = ['username' => $requested_username, 'userGUID!=' => $userGUID];
        } else {
            $where = ['username' => $requested_username];
        }
        $user = $this->settings_model->get_all_details(TBL_LOGIN_DETAILS, $where)->row_array();
        if (!empty($user)) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

    /**
     * Check company name is unique or not
     * @author KU
     */
    public function check_comapnyname($companyGUID = null) {
        $requested_name = trim($this->input->get('name'));
        if ($companyGUID != '') {
            $where = ['companyName' => $requested_name, 'companyGUID!=' => $companyGUID];
        } else {
            $where = ['companyName' => $requested_name];
        }
        $company = $this->settings_model->get_all_details(TBL_COMPANY, $where)->row_array();
        if (!empty($company)) {
            echo "false";
        } else {
            echo "true";
        }
        exit;
    }

}

/* End of file Company.php */
/* Location: ./application/controllers/super_admin/Company.php */