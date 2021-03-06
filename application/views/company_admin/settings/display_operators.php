<?php
    if(isset($dataArr)){
        $form_action = "settings/manage_operators/edit/".base64_encode($dataArr['operativeGUID']);
    }else{
        $form_action = "settings/manage_operators/add";
    }
?>
<div class="content-wrapper">
	<div class="row">
        <div class="col-md-12">
            <?php $this->load->view('alert_view'); ?>
            <div class="panel panel-flat">
                <table class="table datatable-basic table-hover">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Base Depot</th>
                            <th>Full Name</th>
                            <th>Birthdate</th>
                            <th>Is Employee ?</th>
                            <th>Qualification Details</th>
                            <th style="width:10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-12 div_add_operators hide">
            <form action="<?php echo $form_action; ?>" method="post" id="add_operators_form">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Add Operators</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a class="icon-cross2 btn_close_add_op"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="required">Location</label>
                                            <select data-placeholder="Select a Location..." class="select-search" id="txt_base_depot" name="txt_base_depot">
                                                <option></option>
                                                <?php foreach($locationArr as $k => $v){ ?>
                                                    <option value="<?php echo $v['depotGUID']; ?>"><?php echo $v['depotName']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo '<label id="txt_base_depot_error2" class="validation-error-label" for="txt_base_depot">'.form_error('txt_base_depot').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label>Is Employee ?</label>
                                            <div class="checkbox checkbox-switchery">
                                                <input type="checkbox" class="switchery-info" name="txt_is_employee" id="txt_is_employee" checked>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Surname</label>
                                            <input type="text" placeholder="Enter Surname" class="form-control" name="txt_surname" id="txt_surname" value="<?php echo (isset($dataArr)) ? $dataArr['lastName'] : set_value('txt_surname'); ?>">
                                            <?php echo '<label id="txt_surname_error2" class="validation-error-label" for="txt_surname">'.form_error('txt_surname').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Forename</label>
                                            <input type="text" placeholder="Enter Forename" class="form-control" name="txt_forename" id="txt_forename" value="<?php echo (isset($dataArr)) ? $dataArr['firstName'] : set_value('txt_forename'); ?>">
                                            <?php echo '<label id="txt_forename_error2" class="validation-error-label" for="txt_forename">'.form_error('txt_forename').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">DOB</label>
                                            <input type="text" placeholder="Enter DOB (DD/MM/YYYY)" class="form-control format-date" name="txt_dob" id="txt_dob" value="<?php echo (isset($dataArr)) ? date('dd/mm/Y',strtotime($dataArr['DOB'])) : set_value('txt_dob'); ?>">
                                            <?php echo '<label id="txt_dob_error2" class="validation-error-label" for="txt_dob">'.form_error('txt_dob').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Email</label>
                                            <input type="text" placeholder="Enter Email" class="form-control" name="txt_email" id="txt_email" value="<?php echo (isset($dataArr)) ? $dataArr['email'] : set_value('txt_email'); ?>">
                                            <?php echo '<label id="txt_email_error2" class="validation-error-label" for="txt_email">'.form_error('txt_email').'</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Username</label>
                                            <input type="text" placeholder="Enter Username" class="form-control" name="txt_username" id="txt_username" required value="<?php echo (isset($dataArr)) ? $dataArr['username'] : set_value('txt_username'); ?>">
                                            <?php echo '<label id="txt_username_error2" class="validation-error-label" for="txt_username">'.form_error('txt_username').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Password</label>
                                            <input type="text" placeholder="Enter Password" class="form-control" name="txt_pass" id="txt_pass" value="<?php echo set_value('txt_pass'); ?>" required>
                                            <?php echo '<label id="txt_pass_error2" class="validation-error-label" for="txt_pass">'.form_error('txt_pass').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Confirm Password</label>
                                            <input type="text" placeholder="Re-enter Password" class="form-control" name="txt_cpass" id="txt_cpass" value="<?php echo set_value('txt_cpass'); ?>" required>
                                            <?php echo '<label id="txt_cpass_error2" class="validation-error-label" for="txt_cpass">'.form_error('txt_cpass').'</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="33%">License/Vehicle Type</th>
                                                        <th width="33%">Licence No</th>
                                                        <th width="33%">Expiry Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value=""></td>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value=""></td>
                                                        <td><input type="text" class="form-control format-date" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value=""></td>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value=""></td>
                                                        <td><input type="text" class="form-control format-date" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value=""></td>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value=""></td>
                                                        <td><input type="text" class="form-control format-date" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value=""></td>
                                                        <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value=""></td>
                                                        <td><input type="text" class="form-control format-date" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value=""></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                            <a href="<?php echo site_url('settings/manage_operators'); ?>" class="btn btn-danger btn-lg">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var remoteURL = site_url + "company_admin/settings/is_unique_operator_email";
    var remoteURL2 = site_url + "company_admin/settings/is_unique_operator_uname";
</script>
<script src="assets/js/custom_pages/company_admin/operators.js"></script>
<script>
    $(document).ready(function(){
        validation_errors = '<?php echo str_replace(array("\r","\n"),"",validation_errors()); ?>';
        if(validation_errors!=''){
            $('.custom_add_operators_btn').trigger('click');
        }    
    });
</script>