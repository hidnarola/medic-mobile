<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Notifications controller
 * @author KU
 */
class Operation extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->load('default', 'company_admin/operation/index');
    }

    /**
     * Service error page
     */
    public function log() {
        $this->template->load('default', 'company_admin/notifications/log');
    }


}

/* End of file Notification.php */
/* Location: ./application/controllers/company_admin/Notification.php */