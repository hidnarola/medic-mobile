<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends MY_Model {

	/**********************************************************
						Area Related Query
	**********************************************************/
		/**
	     * Get area data for datatable listing
	     * @param $type -> String
	     * @return Object
	     * @author PAV
	    */
		public function get_areas_data($type){
			$columns = ['d.depotGUID', 'd.depotName', 'd.addressLine1', 'm1.firtName as m1_fname', 'm2.firtName'];
	        $keyword = $this->input->get('search');
	        $this->db->select('d.*,m1.firstName as m1_fname,m1.lastName as m1_lname,m1.email as m1_email,m1.mobileNumber as m1_mobile,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email,m2.mobileNumber as m2_mobile');
	        if (!empty($keyword['value'])) {
	            $where = '(d.depotName LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine1 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine2 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.addressLine3 LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.postcode_zipcode LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') . ' OR d.officePhone LIKE ' . $this->db->escape('%' . $keyword['value'] . '%') .')';
	            $this->db->where($where);
	        }
	        $this->db->join(TBL_REGION.' as r','d.regionGUID=r.regionGUID','left');
	        $this->db->join(TBL_MANAGER.' as m1','d.ManagerGUID=m1.managerGUID','left');
	        $this->db->join(TBL_MANAGER.' as m2','d.secondaryManagerGUID=m2.managerGUID','left');
	        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
	        if ($type == 'count') {
	            $query = $this->db->get(TBL_DEPOT . ' d');
	            return $query->num_rows();
	        } else {
	            $this->db->limit($this->input->get('length'), $this->input->get('start'));
	            $query = $this->db->get(TBL_DEPOT . ' d');
	            return $query;
	        }
		}

		/**
	     * Get area details by id
	     * @param $id -> String
	     * @return Object
	     * @author PAV
	    */
		public function get_area_details_by_id($id){
			$this->db->select('d.*,r.*,m1.managerGUID as m1_GUID,m1.firstName as m1_fname,m1.lastName as m1_lname,m1.email as m1_email,m1.mobileNumber as m1_mobile,m2.managerGUID as m2_GUID,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email,m2.mobileNumber as m2_mobile');
			$this->db->from(TBL_DEPOT.' as d');
			$this->db->join(TBL_MANAGER.' as m1','d.managerGUID=m1.managerGUID','left');
			$this->db->join(TBL_MANAGER.' as m2','d.secondaryManagerGUID=m2.managerGUID','left');
			$this->db->join(TBL_REGION.' as r','d.regionGUID=r.regionGUID','left');
			$this->db->where('d.depotGUID',$id);
			return $this->db->get();
		}

	/**********************************************************
						Users Related Query
	**********************************************************/
		/**
	     * Get users data for datatable listing
	     * @param $type -> String
	     * @return Object
	     * @author PAV
	    */	
		public function get_users_data($type){
			$columns = ['m.managerGUID','m.firstName','m.email','m.officeNumber','m2.firstName as m2_fname', 'm.multi-siteResponsibility'];
	        $keyword = $this->input->get('search');
	        $this->db->select('m.*,m2.firstName as m2_fname,m2.lastName as m2_lname,m2.email as m2_email');
	        if (!empty($keyword['value'])) {
	            $where = '(m.firstName LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR m.lastName LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR m.email LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR m.officeNumber LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR m.mobileNumber LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
	            $this->db->where($where);
	        }

	        $this->db->join(TBL_MANAGER.' as m2','m.lineManagerID=m2.managerGUID','left');
	        $this->db->group_by('m.managerGUID');
	        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
	        if ($type == 'count') {
	            $query = $this->db->get(TBL_MANAGER . ' m');
	            return $query->num_rows();
	        } else {
	            $this->db->limit($this->input->get('length'), $this->input->get('start'));
	            $query = $this->db->get(TBL_MANAGER . ' m');
	            return $query;
	        }
		}

	/**********************************************************
						Vehicles Related Query
	**********************************************************/
		/**
	     * Get vehicles data for datatable listing
	     * @param $type -> String
	     * @return Object
	     * @author PAV
	    */	
		public function get_vehicles_data($type){
			$columns = ['v.registration','v.vin','v.fuelType','v.licenceType','v.resetServiceCounter'];
	        $keyword = $this->input->get('search');
	        $this->db->select('v.*');
	        if (!empty($keyword['value'])) {
	            $where = '(v.registration LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.vin LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.fuelType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.licenceType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.numberOfAxles LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.axle1TyreSize LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR v.resetServiceCounter LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
	            $this->db->where($where);
	        }

	        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
	        if ($type == 'count') {
	            $query = $this->db->get(TBL_VEHICLE . ' v');
	            return $query->num_rows();
	        } else {
	            $this->db->limit($this->input->get('length'), $this->input->get('start'));
	            $query = $this->db->get(TBL_VEHICLE . ' v');
	            return $query;
	        }
		}

	/**********************************************************
						operators Related Query
	**********************************************************/
		/**
	     * Get Forklifts data for datatable listing
	     * @param $type -> String
	     * @return Object
	     * @author PAV
	    */
		public function get_forklifts_data($type){
			$columns = ['f.registration','f.vin','f.fuelType','f.licenceType','f.numberOfWheels','f.axle1TyreSize as tyre_details','f.resetServiceCounter'];
	        $keyword = $this->input->get('search');
	        $this->db->select('f.*');
	        if (!empty($keyword['value'])) {
	            $where = '(f.registration LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.vin LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.fuelType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.licenceType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.numberOfWheels LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.axle1TyreSize LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.resetServiceCounter LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
	            $this->db->where($where);
	        }

	        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
	        if ($type == 'count') {
	            $query = $this->db->get(TBL_FORKLIFT . ' f');
	            return $query->num_rows();
	        } else {
	            $this->db->limit($this->input->get('length'), $this->input->get('start'));
	            $query = $this->db->get(TBL_FORKLIFT . ' f');
	            return $query;
	        }
		}

		/**
	     * To check uniqueness at the time of ADD/EDIT functionality
	     * @param  array $condition
	     * @return array()
	     * @author PAV
	     */
	    public function check_unique_forklift($condition) {
	        $this->db->select('f.*');
	        $this->db->from(TBL_FORKLIFT.' as f');
	        $this->db->where($condition);
	        $query = $this->db->get();
	        return $query->row_array();
	    }

	/**********************************************************
						Operators Related Query
	**********************************************************/
		/**
	     * Get Operators data for datatable listing
	     * @param $type -> String
	     * @return Object
	     * @author PAV
	    */
		public function get_operators_data($type){
			$columns = ['o.operativeGUID','d.depotName','o.fullName','o.DOB','o.employee','q.qualification_detials'];
	        $keyword = $this->input->get('search');
	        $this->db->select('o.*,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type SEPARATOR ":-:") lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date');
	        if (!empty($keyword['value'])) {
	            // $where = '(f.registration LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.vin LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.fuelType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.licenceType LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.numberOfWheels LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.axle1TyreSize LIKE '.$this->db->escape('%'.$keyword['value'].'%').' OR f.resetServiceCounter LIKE '.$this->db->escape('%'.$keyword['value'].'%').')';
	            // $this->db->where($where);
	        }
	        $this->db->join(TBL_DEPOT.' as d','o.baseDepotGUID=d.depotGUID','left');
	        $this->db->join(TBL_QUALIFICATION.' as q','o.operativeGUID=q.operativeGUID','left'); 
	        $this->db->group_by('o.operativeGUID');
	        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
	        if ($type == 'count') {
	            $query = $this->db->get(TBL_OPERATIVE . ' o');
	            return $query->num_rows();
	        } else {
	            $this->db->limit($this->input->get('length'), $this->input->get('start'));
	            $query = $this->db->get(TBL_OPERATIVE . ' o');
	            return $query;
	        }
		}

		public function get_depot_by_company(){
			$this->db->select('d.depotGUID,d.depotName');
			$this->db->from(TBL_DEPOT.' as d');
			$this->db->join(TBL_REGION.' as r','d.regionGUID=r.regionGUID and r.companyGUID="'.get_AdminLogin('COMP_GUID').'"','left');
			return $this->db->get();
		}

		public function get_operators_by_id($operativeGUID){
			$this->db->select('o.*,d.depotName,GROUP_CONCAT(q.number SEPARATOR ":-:") lic_no,GROUP_CONCAT(q.type SEPARATOR ":-:") lic_type,GROUP_CONCAT(q.expiry SEPARATOR ":-:") exp_date');
			$this->db->from(TBL_OPERATIVE.' as o');
	        $this->db->join(TBL_DEPOT.' as d','o.baseDepotGUID=d.depotGUID','left');
	        $this->db->join(TBL_QUALIFICATION.' as q','o.operativeGUID=q.operativeGUID','left');
	        $this->db->where(array(
	        	'o.operativeGUID' => $operativeGUID
	        ));
	        $q = $this->db->get();
	        return $q->row_array();
		}
}

/* End of file Settings_model.php */
/* Location: ./application/models/Settings_model.php */