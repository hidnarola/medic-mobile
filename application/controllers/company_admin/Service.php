<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Service controller
 * @author KU
 */
class Service extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->load('default', 'company_admin/service/index');
    }

    /**
     * Service error page
     */
    public function error() {
        $this->template->load('default', 'company_admin/service/error');
    }

    /**
     * Service history page
     */
    public function history() {
        $this->template->load('default', 'company_admin/service/history');
    }

}

/* End of file Service.php */
/* Location: ./application/controllers/company_admin/Service.php */