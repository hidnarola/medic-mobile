<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('login_model', 'vehicle_model', 'dashboard_model'));
        $this->controller = strtolower($this->router->fetch_class());
        $this->action = strtolower($this->router->fetch_method());
        //$this->global['all_vehicles'] = $this->vehicle_model->get_all_details(TBL_VEHICLE,array())->result_array();
    }

    /**
     * Generate unique username
     * @param $string_name, $rand_no
     * @return $username
     */
    public function generate_unique_username($string_name = "", $rand_no = 200) {
        while (true) {
            $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
            $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part

            $part1 = (!empty($username_parts[0])) ? substr($username_parts[0], 0, 8) : ""; //cut first name to 8 letters
            $part2 = (!empty($username_parts[1])) ? substr($username_parts[1], 0, 5) : ""; //cut second name to 5 letters
            $part3 = ($rand_no) ? rand(0, $rand_no) : "";

            $username = $part1 . str_shuffle($part2) . $part3; //str_shuffle to randomly shuffle all characters 

            $username_exist_in_db = $this->username_exist_in_database($username); //check username in database
            if (!$username_exist_in_db) {
                return $username;
            }
        }
    }

    /**
     * Check the $username exists or not
     * @param - username (String)
     * @return - return 1-true, 0-false
     * @author - PAV
     * Last_edited : [26-03-2018]
     */
    public function username_exist_in_database($username) {
        $result = $this->login_model->get_all_details(TBL_LOGIN_DETAILS, array('username' => $username));
        $result2 = $this->login_model->get_all_details(TBL_OPERATIVE, array('username' => $username));
        if ($result->num_rows() > 0 && $result2->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Get the data from JSON api
     * @param - json_url (String)
     * @return - array
     * @author - PAV
     * Last_edited : [26-03-2018]
     */
    public function get_device_json($json_url) {
        $json_string = $json_url;
        $jsondata = file_get_contents($json_string);
        $device_Array = json_decode($jsondata, true);
        $reverse_device_Array = array_reverse($device_Array);
        $latest_lat_key = array_search('LOC:lat', array_column($reverse_device_Array, 'k'));
        $latest_lon_key = array_search('LOC:lon', array_column($reverse_device_Array, 'k'));
        return array(
            'reverse_device_Array' => $reverse_device_Array,
            'latest_lat_key' => $latest_lat_key,
            'latest_lon_key' => $latest_lon_key
        );
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */