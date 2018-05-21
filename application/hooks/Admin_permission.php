<?php

/**
 * Check permission for logged in Admin/Restaurant Admin
 * @author KU
 */
class Admin_permission {

    function initialize() {
        $CI = & get_instance();
        $logged_in = $CI->session->userdata('logged_in');
        $directory = $CI->router->fetch_directory();
        $controller = $CI->router->fetch_class();
        $action = $CI->router->fetch_method();
        if (empty($logged_in) && $controller != 'login' && $controller != 'cron') {
            $redirect = site_url(uri_string());
            redirect('login?redirect=' . base64_encode($redirect));
        } else {
            if (!empty($logged_in) && ($controller == 'login' && $action == 'index')) {
                redirect('dashboard');
            }
        }
    }

}

?>