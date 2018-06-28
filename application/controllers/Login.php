<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('login_model'));
    }

    /**
     * This function is used to Logged in user
     * @param --
     * @return --
     * @author PAV
     */
    public function index() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('isAdmin') == 1) {
            redirect(site_url('dashboard'));
        }

        $data['title'] = 'Login';
        if (!$this->session->userdata('logged_in')) {
            $remember = base64_decode(get_cookie('_remember_me', TRUE));
            if (!empty($remember) && $remember > 0) {
                $ssn_data = $this->login_model->get_user_details($remember);
                $cookie_ssn_data = array();
                $cookie_ssn_data['userGUID'] = $ssn_data['userGUID'];
                $cookie_ssn_data['firstName'] = $ssn_data['firstName'];
                $cookie_ssn_data['lastName'] = $ssn_data['lastName'];
                $cookie_ssn_data['username'] = $ssn_data['username'];
                $cookie_ssn_data['DOB'] = $ssn_data['DOB'];
                $cookie_ssn_data['emailAddress'] = $ssn_data['emailAddress'];
                $cookie_ssn_data['companyGUID'] = $ssn_data['companyGUID'];
                $cookie_ssn_data['isAdmin'] = $ssn_data['isAdmin'];
                $cookie_ssn_data['logged_in'] = 1;
                $this->session->set_userdata($cookie_ssn_data);
                redirect(site_url('dashboard'));
            }
        }

        if ($this->input->post()) {
            $username = $this->input->post('txt_uname');
            $password = $this->input->post('txt_pass');
            $this->db->select('ld.*');
            $this->db->from(TBL_LOGIN_DETAILS . ' as ld');
            $this->db->group_start();
            $this->db->where('ld.emailAddress', $username);
            $this->db->or_where('ld.username', $username);
            $this->db->group_end();
            $res = $this->db->get();
            $data_exists = $res->row_array();

            if (!empty($data_exists)) {
                $_auth_data = $this->login_model->check_login_validation($username, $password);
                if (!empty($_auth_data)) {
                    if ($_auth_data['is_delete'] == 0) {
                        $user_ssn_data = array();
                        $user_ssn_data['userGUID'] = $_auth_data['userGUID'];
                        $user_ssn_data['firstName'] = $_auth_data['firstName'];
                        $user_ssn_data['lastName'] = $_auth_data['lastName'];
                        $user_ssn_data['username'] = $_auth_data['username'];
                        $user_ssn_data['DOB'] = $_auth_data['DOB'];
                        $user_ssn_data['emailAddress'] = $_auth_data['emailAddress'];
                        $user_ssn_data['companyGUID'] = $_auth_data['companyGUID'];
                        $user_ssn_data['isAdmin'] = $_auth_data['isAdmin'];
                        $user_ssn_data['logged_in'] = 1;

                        $this->session->set_userdata($user_ssn_data);
//                    $this->session->set_flashdata('success', 'You have successfully logged in.');
                        redirect(site_url('dashboard'));
                    } else {
                        $this->session->set_flashdata('error', 'User is blocekd! Please contact your system Administrator.');
                        redirect('/');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username and password did not match.');
                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('error', 'User no more exists.');
                redirect('/');
            }
        }

        $this->template->load('login', 'authentication/login', $data);
    }

    /**
     * Logout
     * @author PAV
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    /**
     * Forgot password page
     * @author KU
     */
    public function forgot_password() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_validation');
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
        } else {
            $user = $this->login_model->sql_select(TBL_LOGIN_DETAILS, '*', ['where' => ['emailAddress' => trim($this->input->post('email')), 'is_delete' => 0]], ['single' => true]);

            $verification_code = verification_code();

            $this->login_model->insert_update('update', TBL_LOGIN_DETAILS, array('verificationCode' => $verification_code), array('userGUID' => $user['userGUID']));

//            $verification_code = $this->encrypt->encode($verification_code);
            $verification_code = base64_encode($verification_code);
            $encoded_verification_code = $verification_code;

            $email_var = array(
                'userGUID' => $user['userGUID'],
                'firstName' => $user['firstName'],
                'lastName' => $user['lastName'],
                'username' => $user['username'],
                'emailAddress' => $user['emailAddress'],
                'url' => site_url() . 'reset_password?code=' . $encoded_verification_code,
            );
            $message = $this->load->view('email_template/default_header.php', $email_var, true);
            $message .= $this->load->view('email_template/forgot_password.php', $email_var, true);
            $message .= $this->load->view('email_template/default_footer.php', $email_var, true);

            $email_array = array(
                'mail_type' => 'html',
                'from_mail_id' => $this->config->item('smtp_user'),
                'from_mail_name' => 'Medic Mobile',
                'to_mail_id' => htmlentities($this->input->post('email')),
                'cc_mail_id' => '',
                'subject_message' => 'Reset Password - Medic Mobile',
                'body_messages' => $message
            );
            $email_send = common_email_send($email_array);

            $this->session->set_flashdata('success', 'Email has been successfully sent to reset password! Please check email');
            redirect('login');
        }

        $data['title'] = 'Medic Mobile | Forgot Password';
        $this->template->load('login', 'authentication/forgot_password', $data);
    }

    /**
     * Reset password page
     */
    public function reset_password() {
        $data['title'] = 'Medic mobile | Reset Password';
        $verification_code = $this->input->get('code');
//        $verification_code = $this->encrypt->decode($verification_code);
        $verification_code = base64_decode($verification_code);
        //--- check varification code is valid or not
        $result = $this->login_model->check_verification_code($verification_code);
        if (!empty($result)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('con_password', 'Confirm password', 'trim|required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
            } else {

                //--- if valid then reset password and generate new verification code
                //--- generate verification code
                $new_verification_code = verification_code();
                $id = $result['userGUID'];
                $data = array(
                    'passwordHash' => md5($this->input->post('password')),
                    'verificationCode' => $new_verification_code
                );
                $this->login_model->insert_update('update', TBL_LOGIN_DETAILS, $data, ['userGUID' => $id]);
                $this->session->set_flashdata('success', 'Your password changed successfully');
                redirect('login');
            }
            $this->template->load('login', 'authentication/reset_password', $data);
        } else {
            //--- if invalid verification code
            $this->session->set_flashdata('error', 'Invalid request or already changed password');
            redirect('login');
        }
    }

    /**
     * Forgot password email validation
     */
    public function email_validation() {
        $requested_email = trim($this->input->post('email'));
        $user = $this->login_model->sql_select(TBL_LOGIN_DETAILS, 'userGUID', ['where' => ['emailAddress' => $requested_email, 'is_delete' => 0]], ['single' => true]);
        if (empty($user)) {
            $this->form_validation->set_message('email_validation', 'Invalid Email Address');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Check email is valid or not
     */
    public function check_email() {
        $requested_email = trim($this->input->get('email'));
        $user = $this->login_model->sql_select(TBL_LOGIN_DETAILS, 'userGUID', ['where' => ['emailAddress' => $requested_email, 'is_delete' => 0]], ['single' => true]);
        if ($user) {
            echo "true";
        } else {
            echo "false";
        }
        exit;
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */