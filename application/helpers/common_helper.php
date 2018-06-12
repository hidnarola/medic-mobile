<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Print array/string.
 * @param array $data - data which is going to be printed
 * @param boolean $is_die - if set to true then excecution will stop after print. 
 */
function p($data, $is_die = false) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        echo $data;
    }

    if ($is_die)
        die;
}

/**
 * Print last executed query
 * @param boolean $bool - if set to true then excecution will stop after print
 */
function qry($bool = false) {
    $CI = & get_instance();
    echo $CI->db->last_query();
    if ($bool)
        die;
}

/**
 * Uploads image
 * @param string $image_name
 * @param string $image_path
 * @return array - Either name of the image if uploaded successfully or Array of errors if image is not uploaded successfully
 */
function upload_image($image_name, $image_path) {
    $CI = & get_instance();
    $extension = explode('/', $_FILES[$image_name]['type']);
    $randname = time() . '.' . end($extension);
    $config = array(
        'upload_path' => $image_path,
        'allowed_types' => "png|jpg|jpeg|gif",
        'max_size' => "10240",
        'file_name' => $randname
    );
    //--Load the upload library
    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if ($CI->upload->do_upload($image_name)) {
        $img_data = $CI->upload->data();
        $imgname = $img_data['file_name'];
    } else {
        $imgname = array('errors' => $CI->upload->display_errors());
    }
    return $imgname;
}

/**
 * Set up configuration array for pagination
 * @return array - Configuration array for pagination
 */
function front_pagination() {
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li style="display:none"></li><li class="active"><a data-type="checked" style="background-color:#62a0b4;color:#ffffff; pointer-events: none;">';
    $config['cur_tag_close'] = '</a></li><li style="display:none"></li>';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    return $config;
}

/**
 * Returns all the categories
 */
function get_all_cats() {
    echo "here";
    exit;
    $CI = & get_instance();
    p(1, 1);
    $CI->load->model('categories_model');
    $data = $this->categories_model->get_all_active_cats();
    return $data;
}

/**
 * Return verfication code with check already exit or not for business user signup
 */
function verification_code() {
    $CI = & get_instance();
    $CI->load->model('users_model');
    for ($i = 0; $i < 1; $i++) {
        $verification_string = 'abcdefghijk123' . time();
        $verification_code = str_shuffle($verification_string);
        $check_code = $CI->users_model->get_all_details(TBL_USERS, array('password_verify' => $verification_code))->num_rows();
        if ($check_code > 0) {
            $i--;
        } else {
            return $verification_code;
        }
    }
}

/**
 * Returns file size in GB/MB or KB
 * @author KU
 * @param int $bytes
 * @return string
 */
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

/**
 * Send Email
 * @param array $email_values
 * @return string success
 */
function common_email_send($email_values = array()) {
    $CI = & get_instance();
    $CI->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'demo.narola@gmail.com';
    $config['smtp_pass'] = 'Narola21!';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['mailtype'] = 'html';
    $config['validation'] = TRUE;
    $CI->email->initialize($config);
    $type = $email_values ['mail_type'];
    $subject = $email_values ['subject_message'];
    $to = $email_values ['to_mail_id'];
    $from = $email_values ['from_mail_id'];
    $from_name = $email_values ['from_mail_name'];
    $CI->email->subject($subject);
    $CI->email->from($from, $from_name);
    $CI->email->to($to);
    if ($email_values['cc_mail_id'] != '') {
        $CI->email->cc($email_values['cc_mail_id']);
    }
    $CI->email->message(stripslashes($email_values ['body_messages']));

    if (isset($email_values['attachment'])) {
        $CI->email->attach($email_values['attachment']);
    }
    $CI->email->send();
    // if (!$CI->email->send()) {
    //     echo $CI->email->print_debugger();
    //     die;
    // }
    return 'success';
}

/**
 * This function is used to get all fired quiries
 * @author PAV
 * @param - $is_die - boolean(true/false)
 * @return --
 */
function get_all_queries($is_die = false) {
    $CI = & get_instance();
    echo "<pre>";
    print_r($CI->db->queries);
    echo "</pre>";
    if ($is_die)
        die;
}

/**
 * Generate Random Password
 * @author PAV
 * @param - $pass
 * @return --
 */
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!?~@#-_+<>[]{}";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function controller_validation() {
    $CI = & get_instance();
    if ($CI->session->userdata('user_role') != '1') {
        $CI->session->set_flashdata('error', 'You can\'t access this page.');
        redirect('dashboard');
    } else {
        return true;
    }
}

function get_AdminLogin($type = '') {
    $CI = & get_instance();
    if ($type == 'I') {
        return $CI->session->userdata('userGUID');
    } else if ($type == 'U') {
        return $CI->session->userdata('username');
    } else if ($type == 'F') {
        return $CI->session->userdata('firstName');
    } else if ($type == 'L') {
        return $CI->session->userdata('lastName');
    } else if ($type == 'DOB') {
        return $CI->session->userdata('DOB');
    } else if ($type == 'E') {
        return $CI->session->userdata('emailAddress');
    } else if ($type == 'COMP_GUID') {
        return $CI->session->userdata('companyGUID');
    } else if ($type == 'A') {
        return $CI->session->userdata('isAdmin');
    } else if ($type == 'LI') {
        return $CI->session->userdata('logged_in');
    }
}

function time_elapsed_string($datetime) {
    $timestamp = strtotime($datetime);
    $datetime1 = new DateTime("now");
    $datetime2 = date_create($datetime);
    $diff = date_diff($datetime1, $datetime2);
    $timemsg = '';
    if ($diff->y > 0) {
        $timemsg .= $diff->y . ' year';
    }
    if ($diff->m > 0) {
        $timemsg .= $diff->m . ' month' . ($diff->m > 1 ? "s" : '');
    }
    if ($diff->d > 0) {
        $timemsg .= $diff->d . ' day' . ($diff->d > 1 ? "s" : '');
    }
    if ($diff->h > 0) {
        $timemsg .= $diff->h . ' hour' . ($diff->h > 1 ? "s" : '');
    }
    if ($diff->i > 0) {
        $timemsg .= $diff->i . ' min' . ($diff->i > 1 ? "s" : '');
    }
    if ($diff->s > 0) {
        if ($diff->s < 60 && $diff->i <= 0) {
            $timemsg .= 'just now';
        } else {
            $timemsg .= $diff->s . ' sec' . ($diff->s > 1 ? "'s" : '');
        }
    }
    return $timemsg;
}

function Uuid_v4() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function get_curl_request($url) {
    $curl = curl_init();
    $curl_header = array(
        "accept: application/json",
    );
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => "budliz@gmail.com:pass",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $curl_header,
    ));
    $response = curl_exec($curl);
    //$err = curl_error($curl);
    //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $result_Array = (array) json_decode($response);
    return $result_Array;
}

/**
 * Returns unique id of table
 */

/**
 * Returns unique id of table
 * @param string $field name of field
 * @param string $table name of table
 * @return string
 */
function unique_id($field, $table) {
    $CI = & get_instance();
    $CI->load->model('users_model');

    $uniqe_id = Uuid_v4();
    //--- when text with table name then check generated slug is already exist or not
    for ($i = 0; $i < 1; $i++) {
        $where = [$field => $uniqe_id];

        $result = $CI->users_model->sql_select($table, '*', ['where' => $where], ['single' => true]);
        if (sizeof($result) > 0) {
            $uniqe_id = Uuid_v4();
            $i--;
        } else {
            return $uniqe_id;
        }
    }
}
