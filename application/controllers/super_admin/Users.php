<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        //-- Check if logged in user is admin if not admin than redirect user back to dashboard page
        if (!get_AdminLogin('A')) {
            redirect('dashboard');
        }
    }

    /**
     * Listing of users with associated company 
     * @author KU
     */
    public function display_users() {
        $data['title'] = 'List of Company';
        $data['heading'] = 'Manage System Users';
        $this->template->load('default_admin', 'super_admin/user/display', $data);
    }

    /**
     * Get all users for data table AJAX
     * @author KU
     * @retunr JSON
     */
    public function get_users() {
        $final['recordsTotal'] = $this->users_model->get_users('count');
        $final['redraw'] = 1;
        $final['recordsFiltered'] = $final['recordsTotal'];
        $users = $this->users_model->get_users('result');
        $start = $this->input->get('start') + 1;
        foreach ($users as $key => $val) {
            $users[$key] = $val;
            $users[$key]['sr_no'] = $start++;
        }
        $final['data'] = $users;
        echo json_encode($final);
    }

    /**
     * Add user in database
     * @author KU
     */
    public function add() {
        $data['title'] = 'Add User';
        $data['heading'] = 'Manage System Users';
        $data['companies'] = $this->users_model->get_all_details(TBL_COMPANY, 1)->result_array();

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == true) {
            $insertArr = array(
                'userGUID' => Uuid_v4(),
                'firstName' => htmlentities($this->input->post('firstname')),
                'lastName' => htmlentities($this->input->post('lastname')),
                'username' => htmlentities($this->input->post('username')),
                'emailAddress' => htmlentities($this->input->post('email')),
                'isAdmin' => 0,
                'passwordHash' => md5($this->input->post('password'))
            );
            $is_loginDetails = $this->users_model->insert_update('insert', TBL_LOGIN_DETAILS, $insertArr);

            $message = $this->load->view('email_template/default_header.php', $insertArr, true);
            $message .= $this->load->view('email_template/comp_reg.php', $insertArr, true);
            $message .= $this->load->view('email_template/default_footer.php', $insertArr, true);
            $email_array = array(
                'mail_type' => 'html',
                'from_mail_id' => $this->config->item('smtp_user'),
                'from_mail_name' => 'Medic Mobile',
                'to_mail_id' => htmlentities($this->input->post('email')),
                'cc_mail_id' => '',
                'subject_message' => 'Company Registration',
                'body_messages' => $message
            );
            $email_send = common_email_send($email_array);
            if ($is_loginDetails > 0) {
                $this->session->set_flashdata('success', 'User has been added successfully.');
                redirect('users');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try it again.');
            }
        }
        $this->template->load('default_admin', 'super_admin/user/add', $data);
    }

    /**
     * Edit user 
     * @param integer $id
     * @author KU
     */
    public function edit($id = '') {
        $data['title'] = 'Edit User';
        $data['heading'] = 'Manage System Users';
        $data['companies'] = $this->users_model->get_all_details(TBL_COMPANY);

        $record_id = base64_decode($id);
        $data['dataArr'] = $this->users_model->get_all_details(TBL_COMPANY, array('companyGUID' => $record_id))->row_array();
        $data['LoginDetailsArr'] = $this->users_model->get_all_details(TBL_LOGIN_DETAILS, array('companyGUID' => $record_id))->row_array();
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
            $this->users_model->insert_update('update', TBL_COMPANY, $updateArr, array('companyGUID' => $record_id));
            $this->session->set_flashdata('success', 'Company has been updated successfully.');
            redirect('manage_company');
        }
        $this->template->load('default_admin', 'super_admin/user/add', $data);
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

/* End of file Users.php */
/* Location: ./application/controllers/super_admin/Users.php */