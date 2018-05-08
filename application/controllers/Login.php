<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('login_model'));
		//echo md5('admin@123#'); die;
	}

    /**
     * This function is used to Logeed in user
     * @param --
     * @return --
     * @author PAV
    */
	public function index(){
		if ($this->session->userdata('logged_in') && $this->session->userdata('isAdmin') == 1) {
            redirect(site_url('dashboard'));
        }

        $data['title'] = 'Login';
        if (!$this->session->userdata('logged_in')) {
            $remember = base64_decode(get_cookie('_remember_me', TRUE));
            if (!empty($remember) && $remember > 0) {
                $ssn_data = $this->login_model->get_user_details($remember);
                $cookie_ssn_data = array();
                $cookie_ssn_data['loginDetailsID'] 	= $ssn_data['loginDetailsID'];
                $cookie_ssn_data['firstName'] 		= $ssn_data['firstName'];
                $cookie_ssn_data['lastName'] 		= $ssn_data['lastName'];
                $cookie_ssn_data['username'] 		= $ssn_data['username'];
                $cookie_ssn_data['DOB'] 			= $ssn_data['DOB'];
                $cookie_ssn_data['emailAddress']	= $ssn_data['emailAddress'];
                $cookie_ssn_data['companyGUID']		= $ssn_data['companyGUID'];
                $cookie_ssn_data['isAdmin'] 		= $ssn_data['isAdmin'];
                $cookie_ssn_data['logged_in'] 		= 1;
                $this->session->set_userdata($cookie_ssn_data);
                redirect(site_url('dashboard'));
            }
        }

        if ($this->input->post()) {
            $username = $this->input->post('txt_uname');
            $password = $this->input->post('txt_pass');
            $this->db->select('ld.*');
            $this->db->from(TBL_LOGIN_DETAILS.' as ld');
            $this->db->group_start();
	            $this->db->where('ld.emailAddress',$username);
	            $this->db->or_where('ld.username',$username);
	        $this->db->group_end();
            $res = $this->db->get();
            $data_exists = $res->row_array();

            if(!empty($data_exists)){
            	$_auth_data = $this->login_model->check_login_validation($username, $password);
            	if(!empty($_auth_data)){
	                $user_ssn_data = array();
	                $user_ssn_data['loginDetailsID']= $_auth_data['loginDetailsID'];
	                $user_ssn_data['firstName'] 	= $_auth_data['firstName'];
	                $user_ssn_data['lastName'] 		= $_auth_data['lastName'];
	                $user_ssn_data['username'] 		= $_auth_data['username'];
	                $user_ssn_data['DOB'] 			= $_auth_data['DOB'];
	                $user_ssn_data['emailAddress']	= $_auth_data['emailAddress'];
	                $user_ssn_data['companyGUID']	= $_auth_data['companyGUID'];
	                $user_ssn_data['isAdmin'] 		= $_auth_data['isAdmin'];
	                $user_ssn_data['logged_in'] 	= 1;

	                $this->session->set_userdata($user_ssn_data);
	                $this->session->set_flashdata('success', 'You have successfully logged in.');
	                redirect(site_url('dashboard'));
	            }else{
	            	$this->session->set_flashdata('error', 'Username and password did not match.');
                        redirect('/');
	            }
	        }else{
	        	$this->session->set_flashdata('error', 'User no more exists.');
                redirect('/');
	        }
        }

		$this->template->load('login','authentication/login',$data);
	}

	/**
     * Logout
     * @author PAV
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */