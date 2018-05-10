<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Operation controller
 * @author KU
 */
class Operation extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Index page
     */
    public function index() {
        $this->template->load('default', 'company_admin/operation/index');
    }

    /**
     * Trends page
     */
    public function trends() {
        $this->template->load('default', 'company_admin/operation/trends');
    }

    /**
     * Map page
     */
    public function map() {
        $this->template->load('default', 'company_admin/operation/map');
    }

    /**
     * Machines page
     */
    public function machines() {
        $this->template->load('default', 'company_admin/operation/machines');
    }

    /**
     * Visits page
     */
    public function visits() {
        $this->template->load('default', 'company_admin/operation/visits');
    }

    /**
     * Operators page
     */
    public function operators() {
        $this->template->load('default', 'company_admin/operation/operators');
    }

}

/* End of file Notification.php */
/* Location: ./application/controllers/company_admin/Operation.php */