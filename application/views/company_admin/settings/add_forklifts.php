<?php
	if(isset($dataArr)){
		$form_action = 'settings/manage_forklifts/edit/'.base64_encode($dataArr['forkliftGUID']);
	}else{
		$form_action = 'settings/manage_forklifts/add';
	}
?>
<form action="<?php echo site_url($form_action); ?>" method="post" id="add_forklift_form" class="form-horizontal">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Add ForkLifts</h5>
			<div class="heading-elements">
				<div class="form-group">
					<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
						<input type="checkbox" class="switch" name="txt_status" id="txt_status" <?php echo (isset($dataArr) && $dataArr['forkTruckStatus']==1) ? 'checked' : ''; ?>>
						<b>Status :</b>
					</label>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Base Depot</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Enter Base Depot" id="txt_base_depot" name="txt_base_depot" value="<?php echo (isset($dataArr)) ? $dataArr['baseDepotGUID'] : set_value('txt_base_depot'); ?>">
							<?php echo '<label id="txt_base_depot_error2" class="validation-error-label" for="txt_base_depot">' . form_error('txt_base_depot') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">Registration No.</label>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Enter Registration No" name="txt_reg_no" id="txt_reg_no" value="<?php echo (isset($dataArr)) ? $dataArr['registration'] : set_value('txt_reg_no'); ?>">
							<?php echo '<label id="txt_reg_no_error2" class="validation-error-label" for="txt_reg_no">' . form_error('txt_reg_no') . '</label>'; ?>
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
					<div class="form-group has-feedback">
						<label class="control-label required col-md-3">No. of Wheels</label>
						<div class="col-md-9">
							<input type="text" placeholder="Enter no. of wheels" class="form-control" name="txt_wheel_no" id="txt_wheel_no" value="<?php echo (isset($dataArr)) ? $dataArr['numberOfWheels'] : set_value('txt_wheel_no'); ?>">
							<?php echo '<label id="txt_wheel_no_error2" class="validation-error-label" for="txt_wheel_no">' . form_error('txt_wheel_no') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label required col-md-4">Current Hour Reading</label>
						<div class="col-md-8">
							<input type="text" placeholder="Enter Current Hour Reading" class="form-control" name="txt_curr_hrs" id="txt_curr_hrs" value="<?php echo (isset($dataArr)) ? $dataArr['currentHourReading'] : set_value('txt_curr_hrs'); ?>">
							<?php echo '<label id="txt_curr_hrs_error2" class="validation-error-label" for="txt_curr_hrs">' . form_error('txt_curr_hrs') . '</label>'; ?>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label col-md-4">Re-set Counter Service</label>
						<div class="col-md-8">
							<div class="checkbox checkbox-switchery">
								<input type="checkbox" class="switchery-info" name="txt_reset_counter" id="txt_reset_counter" <?php echo (isset($dataArr) && $dataArr['resetServiceCounter']==1) ? 'checked' : ''; ?>>
							</div>
						</div>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label col-md-4">Lock</label>
						<div class="col-md-8">
							<div class="checkbox checkbox-switchery">
								<input type="checkbox" class="switchery-info" name="txt_locked" id="txt_locked" <?php echo (isset($dataArr) && $dataArr['locked']==1) ? 'checked' : ''; ?>>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="form-group has-feedback">
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
								<label class="control-label col-md-4">Last Service Hrs</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Last Service Hrs" name="txt_last_service_hrs" id="txt_last_service_hrs" value="<?php echo (isset($dataArr)) ? $dataArr['lastServiceHrs'] : set_value('txt_last_service_hrs'); ?>"></div>
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
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Road Duty Due" name="txt_road_duty_due" id="txt_road_duty_due" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['roadDutyDue'])) : set_value('txt_road_duty_due'); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Inspection Intervals</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Inspection Intervals" id="txt_inspection_intervals" name="txt_inspection_intervals" value="<?php echo (isset($dataArr)) ? $dataArr['inspectionIntervals'] : set_value('txt_inspection_intervals'); ?>"></div>
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
								<label class="control-label col-md-4">Last Inspection Hrs</label>
								<div class="col-md-8"><input type="text" class="form-control" placeholder="Enter Last Inspection Hrs" name="txt_last_inspection_hrs" id="txt_last_inspection_hrs" value="<?php echo (isset($dataArr)) ? $dataArr['lastInspectionHrs'] : set_value('txt_last_inspection_hrs'); ?>"></div>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label col-md-4">Next Inscpection Due</label>
								<div class="col-md-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar2"></i></span>
										<input type="text" class="form-control pickadate-accessibility" placeholder="Enter Next Inspection Due" name="txt_next_inspection_due" id="txt_next_inspection_due" value="<?php echo (isset($dataArr)) ? date('d F, Y',strtotime($dataArr['nextInspectionDue'])) : set_value('txt_next_inspection_due'); ?>">
									</div>
								</div>
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
			<div class="row">
                <div class="col-lg-12">
					<div class="text-right">
						<button type="submit" class="btn btn-success btn-lg">Submit</button>
						<a href="<?php echo site_url('settings/manage_forklifts'); ?>" class="btn btn-danger btn-lg">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	remoteEnURL = site_url + "company_admin/settings/forklift_Name";
    <?php if (isset($dataArr)) { ?>
        var forkliftGUID = '<?php echo $dataArr['forkliftGUID'] ?>';
        remoteEnURL = site_url + "company_admin/settings/forklift_Name/" + forkliftGUID;
    <?php } ?>
	$(function(){
	    var elems = document.querySelectorAll('.switchery-info');
		for (var i = 0; i < elems.length; i++) {
		    var switchery = new Switchery(elems[i], {color: '#00BCD4'});
    	}

    	var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
	    switches.forEach(function(html) {
	        var switchery = new Switchery(html, {color: '#4CAF50'});
	    });

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
<script src="assets/js/custom_pages/company_admin/forklift.js"></script>