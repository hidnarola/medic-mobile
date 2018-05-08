<?php
	if(isset($dataArr)){
		$form_action = 'settings/manage_users/edit/'.base64_encode($dataArr['managerGUID']);
	}else{
		$form_action = 'settings/manage_users/add';
	}
?>
<form action="<?php echo site_url($form_action); ?>" method="post" id="add_users_form">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Add User</h5>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<fieldset>
						<legend class="text-semibold"> Basic details</legend>
						<div class="form-group has-feedback">
							<label class="required">Base Depot</label>
							<input type="text" class="form-control" placeholder="Enter Base Depot" id="txt_base_depot" name="txt_base_depot" value="<?php echo (isset($dataArr)) ? $dataArr['baseDepotGUID'] : set_value('txt_base_depot'); ?>">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="required">Forename</label>
									<input type="text" class="form-control" placeholder="Enter Forename" name="txt_forename" id="txt_forename" value="<?php echo (isset($dataArr)) ? $dataArr['firstName'] : set_value('txt_forename'); ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="required">Surname</label>
									<input type="text" class="form-control" placeholder="Enter Surname" name="txt_surname" id="txt_surname" value="<?php echo (isset($dataArr)) ? $dataArr['lastName'] : set_value('txt_surname'); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="required">Email</label>
									<input type="text" class="form-control" placeholder="Enter Email" name="txt_email" id="txt_email" value="<?php echo (isset($dataArr)) ? $dataArr['email'] : set_value('txt_email'); ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="required">Office No.</label>
									<input type="text" placeholder="+99-99-9999-9999" class="form-control" name="txt_office_number" id="txt_office_number" value="<?php echo (isset($dataArr)) ? $dataArr['officeNumber'] : set_value('txt_office_number'); ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label class="required">Mobile No.</label>
										<input type="text" placeholder="+99-99-9999-9999" class="form-control" name="txt_mobile_number" id="txt_mobile_number" value="<?php echo (isset($dataArr)) ? $dataArr['mobileNumber'] : set_value('txt_mobile_number'); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label>Multi-site Responsibility ?</label>
										<div class="checkbox checkbox-switchery">
											<input type="checkbox" class="switchery-info" name="txt_multi_site" id="txt_multi_site" <?php echo (isset($dataArr) && $dataArr['multi-siteResponsibility']==1) ? 'checked' : ''; ?>>
										</div>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="col-md-4">
					<fieldset>
						<legend class="text-semibold"> Alert Notification</legend>
						<div class="form-group">
							<div class="table-responsive">
								<table class="table table-xs table-bordered">
									<thead>
										<tr>
											<th style="padding:21px"></th>
											<th class="text-center">Email</th>
											<th class="text-center">SMS</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Daily Log Issues</td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_email_notfy[0]" <?php echo (isset($dataArr) && $dataArr['dailyLogIssuesEmail']==1) ? 'checked' : ''; ?>></td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_sms_notfy[0]" <?php echo (isset($dataArr) && $dataArr['dailyLogIssuesSMS']==1) ? 'checked' : ''; ?>></td>
										</tr>
										<tr>
											<td>Fault</td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_email_notfy[1]" <?php echo (isset($dataArr) && $dataArr['faultsEmail']==1) ? 'checked' : ''; ?>></td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_sms_notfy[1]" <?php echo (isset($dataArr) && $dataArr['faultsSMS']==1) ? 'checked' : ''; ?>></td>
										</tr>
										<tr>
											<td>Speed</td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_email_notfy[2]" <?php echo (isset($dataArr) && $dataArr['speedEmail']==1) ? 'checked' : ''; ?>></td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_sms_notfy[2]" <?php echo (isset($dataArr) && $dataArr['speedSMS']==1) ? 'checked' : ''; ?>></td>
										</tr>
										<tr>
											<td>Incidents</td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_email_notfy[3]" <?php echo (isset($dataArr) && $dataArr['incidentsEmails']==1) ? 'checked' : ''; ?>></td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_sms_notfy[3]" <?php echo (isset($dataArr) && $dataArr['incidentsSMS']==1) ? 'checked' : ''; ?>></td>
										</tr>
										<tr>
											<td>Notify Line Manager</td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_email_notfy[4]" <?php echo (isset($dataArr) && $dataArr['notifyLineManagerEmail']==1) ? 'checked' : ''; ?>></td>
											<td class="text-center"><input type="checkbox" class="styled" name="txt_sms_notfy[4]" <?php echo (isset($dataArr) && $dataArr['notifyLineManagerSMS']==1) ? 'checked' : ''; ?>></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label>Line Manager</label>
							<select data-placeholder="Select a manager..." class="select-search" id="txt_line_manager" name="txt_line_manager">
								<option></option>
								<?php foreach($managerArr as $k => $v){ ?>
									<option value="<?php echo $v['managerGUID']; ?>"><?php echo $v['firstName'].' '.$v['lastName']; ?></option>	
								<?php } ?>
							</select>
						</div>
					</fieldset>
				</div>

				<div class="col-md-4">
					<fieldset>
						<legend class="text-semibold"> Permissions</legend>
						<div class="form-group">
							<div class="table-responsive">
								<table class="table table-xxs">
									<tbody>
										<tr>
											<td style="border-top:none"><div class="checkbox"><label>Clear Fault<input type="checkbox" class="styled" name="txt_permission[0]" <?php echo (isset($dataArr) && $dataArr['clearFaults']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Lock/Unlock<input type="checkbox" class="styled" name="txt_permission[1]" <?php echo (isset($dataArr) && $dataArr['lockUnLock']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Set/Reset Service<input type="checkbox" class="styled" name="txt_permission[2]" <?php echo (isset($dataArr) && $dataArr['setResetService']) ? 'checked' : ''; ?>></label></div></td>
										</tr>
										<tr>
											<td style="border-top:none"><div class="checkbox"><label>Add User<input type="checkbox" class="styled" name="txt_permission[3]" <?php echo (isset($dataArr) && $dataArr['addUsers']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Add Operatives<input type="checkbox" class="styled" name="txt_permission[4]" <?php echo (isset($dataArr) && $dataArr['addOperatives']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Add Location<input type="checkbox" class="styled" name="txt_permission[5]" <?php echo (isset($dataArr) && $dataArr['addLocations']) ? 'checked' : ''; ?>></label></div></td>
										</tr>
										<tr>
											<td style="border-top:none"><div class="checkbox"><label>Add Vehicles<input type="checkbox" class="styled" name="txt_permission[6]" <?php echo (isset($dataArr) && $dataArr['addVehicles']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Add Forklifts<input type="checkbox" class="styled" name="txt_permission[7]" <?php echo (isset($dataArr) && $dataArr['addFortklifts']) ? 'checked' : ''; ?>></label></div></td>
											<td style="border-top:none"><div class="checkbox"><label>Edit Subscription<input type="checkbox" class="styled" name="txt_permission[8]" <?php echo (isset($dataArr) && $dataArr['editSubscriptions']) ? 'checked' : ''; ?>></label></div></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="text-right form-group">
						<button type="submit" class="btn btn-success btn-lg">Submit</button>
						<a href="<?php echo site_url('settings/manage_users'); ?>" class="btn btn-danger btn-lg">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script src="assets/js/custom_pages/company_admin/users.js"></script>
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
	});
</script>