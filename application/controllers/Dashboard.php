<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('dashboard_model', 'vehicle_model', 'track_model', 'operation_model'));
        $this->companyGUID = $this->session->userdata('companyGUID');
        $this->regions = $this->operation_model->get_regions($this->companyGUID);
        $this->operators_per_page = $this->service_due_per_page = $this->faults_per_page = $this->pod_per_page = $this->incidents_per_page = 10;
        $this->dailycheck_per_page = 25;
    }

    /**
     * This function is used to redirect on Dashboard page.
     * @param $id -> String
     * @return redirect
     * @author PAV
     */
    public function index() {
        if (get_AdminLogin('A')) {
            $data['title'] = 'Dashboard';
            redirect('manage_company');
            //$this->template->load('default','authentication/dashboard',$data);
        } else {
            $data['title'] = 'Dashboard';
            $start_date_data = date('Y-m-d H:i:s', (time() - 86400)); //345600
            $end_date_data = date('Y-m-d H:i:s', time());

            $where = " WHERE tbl_gps.timeStamp>='" . $start_date_data . "' AND tbl_gps.timeStamp<='" . $end_date_data . "' ";
            $data['vehicle_latlong'] = $this->vehicle_model->get_vehicle_latlong($where);
            foreach ($data['vehicle_latlong'] as $k => $v) {
                $where = array(
                    'g.timeStamp>=' => $start_date_data,
                    'g.timeStamp<=' => $end_date_data,
                    'v.vehicleGUID' => $v['vehicleGUID'],
                    'v.deviceGUID' => $v['deviceGUID']
                );
                $vehilcle_track = $this->track_model->get_gps_by_sessionID($where)->result_array();
                foreach ($vehilcle_track as $key => $value) {
                    $data['vehicle_latlong'][$k]['telematics'][] = str_replace('"', '', $value['latitude']) . ',' . str_replace('"', '', $value['longitude']);
                }
            }

            $return_arr = $this->get_device_json(MEDIC17L0018_json);
            $MEDIC17L0018_Array = $return_arr['reverse_device_Array'];
            $lat_key = $return_arr['latest_lat_key'];
            $lon_key = $return_arr['latest_lon_key'];
            $data_arr = array(
                'latitude' => $MEDIC17L0018_Array[$lat_key]['v'],
                'longitude' => $MEDIC17L0018_Array[$lon_key]['v'],
                'telematics' => array(),
                'deviceGUID' => 'MEDIC17L0018'
            );
            $data['vehicle_latlong'][] = $data_arr;

            $return_arr = $this->get_device_json(MEDIC18A0036_json);
            $MEDIC18A0036_Array = $return_arr['reverse_device_Array'];
            $lat_key = $return_arr['latest_lat_key'];
            $lon_key = $return_arr['latest_lon_key'];
            $data_arr = array(
                'latitude' => $MEDIC18A0036_Array[$lat_key]['v'],
                'longitude' => $MEDIC18A0036_Array[$lon_key]['v'],
                'telematics' => array(),
                'deviceGUID' => 'MEDIC18A0036'
            );
            $data['vehicle_latlong'][] = $data_arr;
            $this->template->load('default', 'company_admin/operation/map', $data);
        }
    }

    /**
     * This function is used to get operators data by ajax with pagination.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_operators_pagination() {
        if ($this->input->post('print') != '') {
            $operators_details = $this->dashboard_model->get_operators_details();
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->operators_per_page;
            $operators_details = $this->dashboard_model->get_operators_details($this->operators_per_page, $offset);
        }
        foreach ($operators_details as $k => $v) {
            $operatorsArr[$v['operativeGUID']]['firstname'] = $v['firstName'];
            $operatorsArr[$v['operativeGUID']]['lastname'] = $v['lastName'];
            $operatorsArr[$v['operativeGUID']]['DOB'] = $v['DOB'];
            $operatorsArr[$v['operativeGUID']]['email'] = $v['email'];
            $operatorsArr[$v['operativeGUID']]['employee'] = $v['employee'];
            if ($v['qualification_id'] != '') {
                $qualification_id_Arr = explode(':-:', $v['qualification_id']);
                $lic_number_Arr = explode(':-:', $v['lic_number']);
                $lic_type_Arr = explode(':-:', $v['lic_type']);
                $lic_expiry_Arr = explode(':-:', $v['lic_expiry']);
                foreach ($qualification_id_Arr as $k1 => $v1) {
                    $operatorsArr[$v['operativeGUID']]['license'][$v1]['number'] = $lic_number_Arr[$k1];
                    $operatorsArr[$v['operativeGUID']]['license'][$v1]['type'] = $lic_type_Arr[$k1];
                    $operatorsArr[$v['operativeGUID']]['license'][$v1]['expiry'] = $lic_expiry_Arr[$k1];
                }
            }
        }
        $data['operatorsArr'] = $operatorsArr;

        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/print_operators_report.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Driver</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">HGV Licence No</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Expiry Date</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Classes Covered</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Additional Licence 1</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Expiry Date</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Additional Licence 2</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Expiry Date</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Classes Covered</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Status</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/operators_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get dailycheck data by ajax with pagination.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_dailycheck_pagination() {
        if ($this->input->post('txt_date') != '') {
            $date_range_start = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 00:00:00';
            $date_range_end = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 23:59:59';
            $where_Arr = array(
                'date_range_start' => $date_range_start,
                'date_range_end' => $date_range_end
            );
        } else {
            $where_Arr = array();
        }
        if ($this->input->post('print') != '') {
            $dailycheck_details = $this->dashboard_model->get_dailycheck_details('', '', $where_Arr);
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->dailycheck_per_page;
            $dailycheck_details = $this->dashboard_model->get_dailycheck_details($this->dailycheck_per_page, $offset, $where_Arr);
        }
        $data['dailycheckArr'] = $dailycheck_details;
        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/dailycheck/dailycheck_print.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Driver</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle RegNo.</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle Type</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Mileage</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Total Fault</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Added On</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/dailycheck/dailycheck_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get dailycheck data by ID.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function view_dailycheck() {
        $defaultCheckID = base64_decode($this->input->get_post('dailyCheckID'));
        $data['dailyCheckArr'] = $this->dashboard_model->get_dailycheck_details_by_id($defaultCheckID);
        $html = $this->load->view('partial_view/dailycheck/dailycheck_view.php', $data, true);
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get service_due data by ajax with pagination.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_service_due_pagination() {
        if ($this->input->post('txt_date') != '') {
            $data['txt_date'] = $txt_date = date('Y-m-d', strtotime($this->input->post('txt_date')));
        } else {
            $data['txt_date'] = $txt_date = date('Y-m-d');
        }
        $where_Arr = array();
        if ($this->input->post('print') != '') {
            $vehicles_details = $this->vehicle_model->get_all_vehicles('', '', $where_Arr);
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->service_due_per_page;
            $vehicles_details = $this->vehicle_model->get_all_vehicles($this->service_due_per_page, $offset, $where_Arr);
        }
        $data['vehiclesArr'] = $vehicles_details;
        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/service_due/service_due_print.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Registration</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Current ODO</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle Description</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Last Inspection Date</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Last Inspection ODO</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Next Inspection Due</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Confirmed?</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Status</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/service_due/service_due_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get proof_of_delivery data by ajax with pagination.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_pod_pagination() {
        if ($this->input->post('txt_date') != '') {
            $date_range_start = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 00:00:00';
            $date_range_end = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 23:59:59';
            $where_Arr = array(
                'date_range_start' => $date_range_start,
                'date_range_end' => $date_range_end
            );
            $data['txt_date'] = $txt_date = date('Y-m-d', strtotime($this->input->post('txt_date')));
        } else {
            $data['txt_date'] = $txt_date = date('Y-m-d');
            $where_Arr = array();
        }

        if ($this->input->post('print') != '') {
            $vehicles_details = $this->dashboard_model->get_all_pod('', '', $where_Arr)->result_array();
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->incidents_per_page;
            $vehicles_details = $this->dashboard_model->get_all_pod($this->pod_per_page, $offset, $where_Arr)->result_array();
        }
        $data['vehiclesArr'] = $vehicles_details;
        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/pod/pod_print.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle Registration</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Operative Name</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Original Depot</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Incidents</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">No. of Drops</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/pod/pod_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    public function view_pod() {
        $vehicleGUID = base64_decode($this->input->get_post('vehicleGUID'));
        $tempArr = $this->dashboard_model->get_pod_by_vehicleGUID($vehicleGUID);
        //p($tempArr,1);
        foreach ($tempArr as $k => $v) {
            $podArr[$v['vehicleGUID']]['vehicleGUID'] = $v['vehicleGUID'];
            $podArr[$v['vehicleGUID']]['registration'] = $v['registration'];
            $podArr[$v['vehicleGUID']]['firstName'] = $v['firstName'];
            $podArr[$v['vehicleGUID']]['lastName'] = $v['lastName'];
            $podArr[$v['vehicleGUID']]['proofs'][$v['proofID']]['is_img'] = $v['images'];
            $podArr[$v['vehicleGUID']]['proofs'][$v['proofID']]['description'] = $v['description'];
            $podArr[$v['vehicleGUID']]['proofs'][$v['proofID']]['updateDate'] = $v['updateDate'];
            $podArr[$v['vehicleGUID']]['proofs'][$v['proofID']]['signature'] = $v['signature'];
        }
        $data['podArr'] = $podArr;
        $data['vehicleGUID'] = $vehicleGUID;
        $html = $this->load->view('partial_view/pod/pod_view.php', $data, true);
        echo json_encode($html);
        die;
    }

    public function view_pod_images() {
        $proofID = $this->input->get_post('proofID');
        $this->db->select('*');
        $this->db->from(TBL_DELIVERYPROOFIMAGE);
        $this->db->where('proofID', $proofID);
        $q = $this->db->get();
        $imagesArr = $q->result_array();
        // p($imagesArr,1);
        $view = '<div class="row">';
        if (!empty($imagesArr)) {
            foreach ($imagesArr as $k => $v) {
                $view .= '<div class="col-lg-4">';
                $view .= '<div class="panel panel-flat">';
                $view .= '<div class="panel-body" style="padding:0px">';
                $view .= '<a href="' . POD_IMG_PATH . $v['image'] . '" data-popup="lightbox">';
                $view .= '<img src="' . POD_IMG_PATH . $v['image'] . '" style="width: 100%;height: 170px;">';
                $view .= '</a>';
                $view .= '</div>';
                $view .= '</div>';
                $view .= '</div>';
            }
        } else {
            $view .= '<div class="col-lg-12"><h2>No Image Exists</h2></div>';
        }
        $view .= '</div>';
        echo json_encode($view);
        die;
    }

    /**
     * This function is used to get faults data by ajax with paginoatin.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_faults_pagination() {
        if ($this->input->post('txt_date') != '') {
            $date_range_start = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 00:00:00';
            $date_range_end = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 23:59:59';
            $where_Arr = array(
                'date_range_start' => $date_range_start,
                'date_range_end' => $date_range_end
            );
            $data['txt_date'] = $txt_date = date('Y-m-d', strtotime($this->input->post('txt_date')));
        } else {
            $data['txt_date'] = $txt_date = date('Y-m-d');
            $where_Arr = array();
        }

        if ($this->input->post('print') != '') {
            $vehicles_details = $this->dashboard_model->get_all_faults('', '', $where_Arr)->result_array();
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->faults_per_page;
            $vehicles_details = $this->dashboard_model->get_all_faults($this->faults_per_page, $offset, $where_Arr)->result_array();
        }
        $data['vehiclesArr'] = $vehicles_details;
        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/faults/faults_print.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle Registration</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Operative Name</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Original Depot</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Incidents</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">No. of Drops</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/faults/faults_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get dailycheck data by ID.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function view_faults() {
        $vehicleGUID = base64_decode($this->input->get_post('vehicleGUID'));
        $tempArr = $this->dashboard_model->get_faults_by_vehicleGUID($vehicleGUID);
        $cnt = 0;
        foreach ($tempArr as $k => $v) {
            $faultsArr[$v['vehicleGUID']]['vehicleGUID'] = $v['vehicleGUID'];
            $faultsArr[$v['vehicleGUID']]['registration'] = $v['registration'];
            $faultsArr[$v['vehicleGUID']]['firstName'] = $v['firstName'];
            $faultsArr[$v['vehicleGUID']]['lastName'] = $v['lastName'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['faultType'] = $v['faultType'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['images'] = $v['images'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['vehicleType'] = $v['vehicleType'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['description'] = $v['description'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['dailyCheckFaultImagesID'] = $v['dailyCheckFaultImagesID'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['image'] = $v['image'];
            $faultsArr[$v['vehicleGUID']]['faults'][$cnt]['signatureImage'] = $v['signatureImage'];
            $cnt++;
        }
        $data['faultsArr'] = $faultsArr;
        $data['vehicleGUID'] = $vehicleGUID;
        $html = $this->load->view('partial_view/faults/faults_view.php', $data, true);
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get incidents data by ajax with pagination.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function get_incidents_pagination() {
        if ($this->input->post('txt_date') != '') {
            $date_range_start = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 00:00:00';
            $date_range_end = date('Y-m-d', strtotime($this->input->post('txt_date'))) . ' 23:59:59';
            $where_Arr = array(
                'date_range_start' => $date_range_start,
                'date_range_end' => $date_range_end
            );
            $data['txt_date'] = $txt_date = date('Y-m-d', strtotime($this->input->post('txt_date')));
        } else {
            $data['txt_date'] = $txt_date = date('Y-m-d');
            $where_Arr = array();
        }

        if ($this->input->post('print') != '') {
            $vehicles_details = $this->dashboard_model->get_all_incidents('', '', $where_Arr)->result_array();
        } else {
            $offset = ($this->input->post('page_no') - 1) * $this->incidents_per_page;
            $vehicles_details = $this->dashboard_model->get_all_incidents($this->incidents_per_page, $offset, $where_Arr)->result_array();
        }
        $data['vehiclesArr'] = $vehicles_details;
        if ($this->input->post('print') != '') {
            $html = $this->load->view('partial_view/incidents/incidents_print.php', $data, true);
            $tbl = '<table><thead>';
            $tbl .= '<tr>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Vehicle Registration</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Operative Name</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Original Depot</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">Incidents</th>';
            $tbl .= '<th style="font-size:13px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">No. of Drops</th>';
            $tbl .= '</tr>';
            $tbl .= '</thead>';
            $tbl .= '<tbody>' . $html . '</tbody></table>';
            $html = $tbl;
        } else {
            $html = $this->load->view('partial_view/incidents/incidents_report.php', $data, true);
        }
        echo json_encode($html);
        die;
    }

    /**
     * This function is used to get incidents data by ID.
     * @param --
     * @return JSON object
     * @author PAV
     */
    public function view_incidents() {
        $vehicleGUID = base64_decode($this->input->get_post('vehicleGUID'));
        $tempArr = $this->dashboard_model->get_incidents_by_vehicleGUID($vehicleGUID);
        $cnt = 0;
        foreach ($tempArr as $k => $v) {
            $incidentsArr[$v['vehicleGUID']]['vehicleGUID'] = $v['vehicleGUID'];
            $incidentsArr[$v['vehicleGUID']]['registration'] = $v['registration'];
            $incidentsArr[$v['vehicleGUID']]['firstName'] = $v['firstName'];
            $incidentsArr[$v['vehicleGUID']]['lastName'] = $v['lastName'];
            $incidentsArr[$v['vehicleGUID']]['incidentID'] = $v['incidentID'];
            if ($v['RTC'] != '') {
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['rtc'] = $v['RTC'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['building'] = $v['building'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['nonVehicular'] = $v['nonVehicular'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['casualties'] = $v['casualties'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['vehicleDamage'] = $v['vehicleDamage'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['nonVehicleDamage'] = $v['nonVehicleDamage'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['description'] = $v['description'];
                $incidentsArr[$v['vehicleGUID']]['incidents'][$cnt]['image'] = $v['image'];
                $cnt++;
            }
        }
        $data['incidentsArr'] = $incidentsArr;
        $data['vehicleGUID'] = $vehicleGUID;
        $html = $this->load->view('partial_view/incidents/incidents_view.php', $data, true);
        echo json_encode($html);
        die;
    }

    public function notifications() {
        $this->template->load('default', 'authentication/notification');
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */