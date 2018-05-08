<?php
	if(isset($dataArr)){
		$form_action = 'settings/manage_vehicles/edit/'.base64_encode($dataArr['vehicleGUID']);
	}else{
		$form_action = 'settings/manage_vehicles/add';
	}
?>
<form action="<?php echo site_url($form_action); ?>" method="post" id="add_vehicle_form" class="form-horizontal">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Add Vehicles</h5>
			<div class="heading-elements">
				<div class="form-group">
					<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
						<input type="checkbox" class="switch" name="txt_google_route" id="txt_google_route" <?php echo (isset($dataArr) && $dataArr['is_google_route']==1) ? 'checked' : ''; ?>>
						<b>Google Route:</b>
					</label>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Registration No.</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Enter Registration No" name="txt_reg_no" id="txt_reg_no" value="<?php echo (isset($dataArr)) ? $dataArr['registration'] : set_value('txt_reg_no'); ?>">
							<?php echo '<label id="txt_reg_no_error2" class="validation-error-label" for="txt_reg_no">' . form_error('txt_reg_no') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Vehicle Description</label>
						<div class="col-md-9">
							<textarea class="form-control" placeholder="Enter Short Description" name="txt_vehicle_desc" id="txt_vehicle_desc"><?php echo (isset($dataArr)) ? $dataArr['description'] : set_value('txt_vehicle_desc'); ?></textarea>
							<?php echo '<label id="txt_vehicle_desc_error2" class="validation-error-label" for="txt_vehicle_desc">' . form_error('txt_vehicle_desc') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Telematics ID</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Enter Device ID" id="txt_device_id" name="txt_device_id" value="<?php echo (isset($dataArr)) ? $dataArr['deviceGUID'] : set_value('txt_device_id'); ?>">
							<?php echo '<label id="txt_device_id_error2" class="validation-error-label" for="txt_device_id">' . form_error('txt_device_id') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label col-md-3">VIN No.</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Enter VIN No." name="txt_vin_no" id="txt_vin_no" value="<?php echo (isset($dataArr)) ? $dataArr['vin'] : set_value('txt_vin_no'); ?>">
							<?php echo '<label id="txt_vin_no_error2" class="validation-error-label" for="txt_vin_no">' . form_error('txt_vin_no') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback select_form_group">
						<label class="control-label required col-md-3">Fuel Type</label>
						<div class="col-md-9">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="icon-gas"></i>
								</div>
								<select class="select" name="txt_fuel_type" id="txt_fuel_type">
									<option value="">Select&hellip;</option>
									<option value="Petrol" <?php if(isset($dataArr) && $dataArr['fuelType']=='Petrol'){ echo 'selected'; } ?>>Petrol</option>
									<option value="Diesel" <?php if(isset($dataArr) && $dataArr['fuelType']=='Diesel'){ echo 'selected'; } ?>>Diesel</option>
									<option value="Gasoline" <?php if(isset($dataArr) && $dataArr['fuelType']=='Gasoline'){ echo 'selected'; } ?>>Gasoline</option>
								</select>
							</div>
							<?php echo '<label id="txt_fuel_type_error2" class="validation-error-label" for="txt_fuel_type">' . form_error('txt_fuel_type') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-4">Current ODO Reading</label>
						<div class="col-md-8">
							<input type="text" placeholder="Enter Current ODO" class="form-control" name="txt_curr_odo" id="txt_curr_odo" value="<?php echo (isset($dataArr)) ? $dataArr['odoReading'] : set_value('txt_curr_odo'); ?>">
							<?php echo '<label id="txt_curr_odo_error2" class="validation-error-label" for="txt_curr_odo">' . form_error('txt_curr_odo') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Base Depot</label>
						<div class="col-md-9">
							<select class="select" name="txt_base_depot" id="txt_base_depot">
								<option value="">Select&hellip;</option>
								<?php foreach($depotArray as $k => $v){ ?>
									<?php 
										if(in_array($v['depotGUID'], $used_depotGUID)){ 
											if(isset($dataArr) && $dataArr['baseDepotGUID']==$v['depotGUID']){
												$disabled = '';
											}else{
												$disabled = 'disabled'; 	
											}
										} else { 
											$disabled = ''; 
										} 
									?>
									<option value="<?php echo $v['depotGUID']; ?>" <?php if(isset($dataArr) && $dataArr['baseDepotGUID']==$v['depotGUID']){ echo 'selected'; } ?> <?php echo $disabled; ?>><?php echo $v['depotName']; ?></option>
								<?php } ?>
							</select>
							<?php echo '<label id="txt_base_depot_error2" class="validation-error-label" for="txt_base_depot">' . form_error('txt_base_depot') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback select_form_group">
						<label class="control-label required col-md-3">Licence Type</label>
						<div class="col-md-9">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="icon-credit-card"></i>
								</div>
								<select class="select" name="txt_licence_type" id="txt_licence_type">
									<option value="">Select&hellip;</option>
									<option value="MC 50CC" <?php if(isset($dataArr) && $dataArr['licenceType']=='MC 50CC'){ echo 'selected'; } ?>>MC 50CC</option>
									<option value="MC EX50CC" <?php if(isset($dataArr) && $dataArr['licenceType']=='MC EX50CC'){ echo 'selected'; } ?>>MC EX50CC</option>
									<option value="FVG" <?php if(isset($dataArr) && $dataArr['licenceType']=='FVG—Motorcycles'){ echo 'selected'; } ?>>FVG—Motorcycles</option>
									<option value="LMV" <?php if(isset($dataArr) && $dataArr['licenceType']=='LMV'){ echo 'selected'; } ?>>LMV</option>
									<option value="LMV-NT" <?php if(isset($dataArr) && $dataArr['licenceType']=='LMV-NT'){ echo 'selected'; } ?>>LMV-NT</option>
									<option value="LMV-TR" <?php if(isset($dataArr) && $dataArr['licenceType']=='LMV-TR'){ echo 'selected'; } ?>>LMV-TR</option>
									<option value="HMV" <?php if(isset($dataArr) && $dataArr['licenceType']=='HMV'){ echo 'selected'; } ?>>HMV</option>
									<option value="HPMV" <?php if(isset($dataArr) && $dataArr['licenceType']=='HPMV'){ echo 'selected'; } ?>>HPMV</option>
									<option value="HTV" <?php if(isset($dataArr) && $dataArr['licenceType']=='HTV'){ echo 'selected'; } ?>>HTV</option>
									<option value="TRAILER" <?php if(isset($dataArr) && $dataArr['licenceType']=='TRAILER'){ echo 'selected'; } ?>>TRAILER</option>
								</select>
							</div>
							<?php echo '<label id="txt_licence_type_error2" class="validation-error-label" for="txt_licence_type">' . form_error('txt_licence_type') . '</label>'; ?>
							<!-- <input type="text" placeholder="Enter Licence Type" class="form-control" name="txt_licence_type" id="txt_licence_type" value="<?php echo (isset($dataArr)) ? $dataArr['officeNumber'] : set_value('txt_office_number'); ?>"> -->
						</div>
					</div>
					<!-- <div class="form-group has-feedback">
						<label class="control-label required col-md-3">No. of Axles</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter Axles No." class="form-control" name="txt_axles_no" id="txt_axles_no" value="<?php echo (isset($dataArr)) ? $dataArr['numberOfAxles'] : set_value('txt_axles_no'); ?>">
							<?php echo '<label id="txt_axles_no_error2" class="validation-error-label" for="txt_axles_no">' . form_error('txt_axles_no') . '</label>'; ?>
						</div>
					</div> -->
					
					<div class="form-group has-feedback">
						<label class="control-label col-md-4">Re-set Counter Service</label>
						<div class="col-md-8">
							<div class="checkbox checkbox-switchery">
								<input type="checkbox" class="switchery-info" name="txt_reset_counter" id="txt_reset_counter" <?php echo (isset($dataArr) && $dataArr['resetServiceCounter']==1) ? 'checked' : ''; ?>>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="display-block text-semibold control-label col-md-12">Specify Vehicle Type</label>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="vehicle_type" class="styled" value="car" <?php if(isset($dataArr)){ if($dataArr['type']=='car'){ echo 'checked'; }}else{ echo 'checked'; } ?>>Car</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="vehicle_type" class="styled" value="van" <?php if(isset($dataArr)){ if($dataArr['type']=='van'){ echo 'checked'; }} ?>>Van</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="vehicle_type" class="styled" value="flatbed_lorry" <?php if(isset($dataArr)){ if($dataArr['type']=='flatbed_lorry'){ echo 'checked'; }} ?>>Flatbed Lorry</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="vehicle_type" class="styled" value="articulated_lorry" <?php if(isset($dataArr)){ if($dataArr['type']=='articulated_lorry'){ echo 'checked'; }} ?>>Articulated Lorry</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="vehicle_type" class="styled" value="forklift_truck" <?php if(isset($dataArr)){ if($dataArr['type']=='forklift_truck'){ echo 'checked'; }} ?>>Fork Lift Truck</label>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="display-block text-semibold control-label col-md-12">ODO Measurment</label>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="odo_measurment" class="styled"  value="km" <?php if(isset($dataArr)){ if($dataArr['odo_measurment']=='km'){ echo 'checked'; }}else{ echo 'checked'; } ?>>Km</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="odo_measurment" class="styled" value="miles" <?php if(isset($dataArr)){ if($dataArr['odo_measurment']=='miles'){ echo 'checked'; }} ?>>Miles</label>
								</div>
								<div class="radio col-md-12" style="padding-top:0px">
									<label class="control-label col-md-12"><input type="radio" name="odo_measurment" class="styled" value="hours" <?php if(isset($dataArr)){ if($dataArr['odo_measurment']=='hours'){ echo 'checked'; }} ?>>Hours</label>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="form-group has-feedback">
						<label class="control-label required col-md-2">Tyre Size & Nos. Axle 1</label>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Size" name="txt_tyre1[0]" value="<?php echo (isset($dataArr) ? $dataArr['axle1TyreSize'] : set_value('txt_tyre1[0]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Radius" name="txt_tyre1[1]" value="<?php echo (isset($dataArr) ? $dataArr['axle1Radius'] : set_value('txt_tyre1[1]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="PSI" name="txt_tyre1[2]" value="<?php echo (isset($dataArr) ? $dataArr['axle1psi'] : set_value('txt_tyre1[2]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Quantity" name="txt_tyre1[3]" value="<?php echo (isset($dataArr) ? $dataArr['axle1Quantity'] : set_value('txt_tyre1[3]')); ?>"></div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-2">Tyre Size & Nos. Axle 2</label>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Size" name="txt_tyre2[0]" value="<?php echo (isset($dataArr) ? $dataArr['axle2TyreSize'] : set_value('txt_tyre2[0]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Radius" name="txt_tyre2[1]" value="<?php echo (isset($dataArr) ? $dataArr['axle2Radius'] : set_value('txt_tyre2[1]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="PSI" name="txt_tyre2[2]" value="<?php echo (isset($dataArr) ? $dataArr['axle2psi'] : set_value('txt_tyre2[2]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Quantity" name="txt_tyre2[3]" value="<?php echo (isset($dataArr) ? $dataArr['axle2Quantity'] : set_value('txt_tyre2[3]')); ?>"></div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-2">Tyre Size & Nos. Axle 3</label>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Size" name="txt_tyre3[0]" value="<?php echo (isset($dataArr) ? $dataArr['axle3TyreSize'] : set_value('txt_tyre3[0]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Radius" name="txt_tyre3[1]" value="<?php echo (isset($dataArr) ? $dataArr['axle3Radius'] : set_value('txt_tyre3[1]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="PSI" name="txt_tyre3[2]" value="<?php echo (isset($dataArr) ? $dataArr['axle3psi'] : set_value('txt_tyre3[2]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Quantity" name="txt_tyre3[3]" value="<?php echo (isset($dataArr) ? $dataArr['axle3Quantity'] : set_value('txt_tyre3[3]')); ?>"></div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-2">Tyre Size & Nos. Axle 4</label>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Size" name="txt_tyre4[0]" value="<?php echo (isset($dataArr) ? $dataArr['axle4TyreSize'] : set_value('txt_tyre4[0]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Radius" name="txt_tyre4[1]" value="<?php echo (isset($dataArr) ? $dataArr['axle4Radius'] : set_value('txt_tyre4[1]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="PSI" name="txt_tyre4[2]" value="<?php echo (isset($dataArr) ? $dataArr['axle4psi'] : set_value('txt_tyre4[2]')); ?>"></div>
						<div class="col-md-2"><input type="text" class="form-control input-xs txt_tyre_details" placeholder="Quantity" name="txt_tyre4[3]" value="<?php echo (isset($dataArr) ? $dataArr['axle4Quantity'] : set_value('txt_tyre4[3]')); ?>"></div>
					</div> -->
				
					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Service Intervals</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Service Intervals" id="txt_service_intervals" name="txt_service_intervals" value="<?php echo (isset($dataArr)) ? $dataArr['serviceIntervals'] : set_value('txt_service_intervals'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Last Service Date</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Last Service Date" name="txt_last_service_date" id="txt_last_service_date" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['lastServiceDate'])) : set_value('txt_last_service_date'); ?>">
									</div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Last Service ODO</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Last Service ODO" name="txt_last_service_odo" id="txt_last_service_odo" value="<?php echo (isset($dataArr)) ? $dataArr['lastServiceODO'] : set_value('txt_last_service_odo'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Next Service Due</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Next Service Due" name="txt_next_service_due" id="txt_next_service_due" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['nextServiceDue'])) : set_value('txt_next_service_due'); ?>">
									</div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Road Duty Due</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Road Due Date" name="txt_road_due_date" id="txt_road_due_date" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['roadDutyDue'])) : set_value('txt_road_due_date'); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Inspection Intervals</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Inspection Intervals" id="txt_inspeaction_intervals" name="txt_inspection_intervals" value="<?php echo (isset($dataArr)) ? $dataArr['inspectionIntervals'] : set_value('txt_inspeaction_intervals'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Last Inspection Date</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Last Inspection Date" name="txt_last_inspection_date" id="txt_last_inspection_date" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['lastInspectionDate'])) : set_value('txt_last_inspection_date'); ?>">
									</div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Last Service ODO</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Last Service ODO" name="txt_last_inspection_odo" id="txt_last_inspection_odo" value="<?php echo (isset($dataArr)) ? $dataArr['lastInspectionODO'] : set_value('txt_last_inspection_odo'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Next Inscpection ODO</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Last Inspection ODO" name="txt_next_inspection_due" id="txt_next_inspection_due" value="<?php echo (isset($dataArr)) ? $dataArr['nextInspectionDue'] : set_value('txt_next_inspection_due'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Insurance Due</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Insurance Due" name="txt_insurance_due" id="txt_insurance_due" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['insuranceDue'])) : set_value('txt_insurance_due'); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-success btn-lg">Submit</button>
				<a href="<?php echo site_url('settings/manage_vehicles'); ?>" class="btn btn-danger btn-lg">Cancel</a>
			</div>
		</div>
	</div>
</form>
<script>
	 var remoteEnURL = site_url + "company_admin/settings/checkUnique_device_id";
    <?php if (isset($dataArr)) { ?>
        var vehicleGUID = '<?php echo $dataArr['deviceGUID'] ?>';
        remoteEnURL = site_url + "company_admin/settings/checkUnique_device_id/" + vehicleGUID;
    <?php } ?>
</script>
<script src="assets/js/custom_pages/company_admin/vehicles.js"></script>
<script>
	$(function(){
	    if (Array.prototype.forEach) {
	        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
	        elems.forEach(function(html) {
	            var switchery = new Switchery(html);
	        });
	    }
	    else {
	        var elems = document.querySelectorAll('.switchery');
	        for (var i = 0; i < elems.length; i++) {
	            var switchery = new Switchery(elems[i]);
	        }
	    }

	    var info = document.querySelector('.switchery-info');
	    var switchery = new Switchery(info, { color: '#00BCD4'});

	    $(".styled, .multiselect-container input").uniform({
	        radioClass: 'choice'
	    }); 

	    $('.pickadate-accessibility').pickadate({
	        labelMonthNext: 'Go to the next month',
	        labelMonthPrev: 'Go to the previous month',
	        labelMonthSelect: 'Pick a month from the dropdown',
	        labelYearSelect: 'Pick a year from the dropdown',
	        selectMonths: true,
	        selectYears: true
	    });
	});
</script>