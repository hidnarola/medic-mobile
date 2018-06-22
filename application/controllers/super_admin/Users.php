<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manage system users functionality
 * @author KU 
 */
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

        $data['companies'] = $this->users_model->get_companies();

        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
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
                'companyGUID' => $this->input->post('company_name'),
                'tier' => $this->input->post('user_role'),
                'isAdmin' => 0,
                'passwordHash' => md5($this->input->post('password'))
            );

            $is_loginDetails = $this->users_model->insert_update('insert', TBL_LOGIN_DETAILS, $insertArr);

            $insertArr['password'] = $this->input->post('password');
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
    public function edit($id = null) {
        if (!is_null($id)) {
            $data['title'] = 'Edit User';
            $data['heading'] = 'Manage System Users';
            $data['companies'] = $this->users_model->get_companies(TBL_COMPANY);

            $record_id = base64_decode($id);
            $data['user'] = $this->users_model->get_user_by_id($record_id);

            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if ($this->form_validation->run() == true) {
                $updateArr = array(
                    'firstName' => htmlentities($this->input->post('firstname')),
                    'lastName' => htmlentities($this->input->post('lastname')),
                    'username' => htmlentities($this->input->post('username')),
                    'emailAddress' => htmlentities($this->input->post('email')),
                    'companyGUID' => $this->input->post('company_name'),
                    'tier' => $this->input->post('user_role'),
                );
                if ($this->input->post('password') != '') {
                    $updateArr['passwordHash'] = md5($this->input->post('password'));
                }

                $this->users_model->insert_update('update', TBL_LOGIN_DETAILS, $updateArr, array('userGUID' => $record_id));

                $this->session->set_flashdata('success', 'User has been updated successfully.');
                redirect('users');
            }
            $this->template->load('default_admin', 'super_admin/user/add', $data);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong! Please try again later.');
            redirect('users');
        }
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
     * Delete user (Make is_delete 1)
     * @param string $userGUID
     * @author KU
     */
    public function delete($userGUID = null) {
        if (!is_null($userGUID)) {
            // Decode userGUID
            $user_id = base64_decode($userGUID);
            $user = $this->users_model->get_user_by_id($user_id);  //-- check user exist or not of this user_id
            if (!empty($user)) {
                $this->users_model->insert_update('update', TBL_LOGIN_DETAILS, ['is_delete' => 1], array('userGUID' => $user_id));
                $this->session->set_flashdata('success', 'User has been deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try again later.');
            }
            redirect('users');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong! Please try again later.');
            redirect('users');
        }
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/super_admin/Users.php */