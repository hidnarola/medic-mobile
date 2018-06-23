<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('operators') ?>">
                                <span>Manage Operators</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('operators/add') ?>">
                                <span>
                                    <?php
                                    if (isset($dataArr))
                                        echo "Edit";
                                    else
                                        echo "Add";
                                    ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 div_add_operators">
                                <form method="post" id="add_operators_form">
                                    <div class="panel-body login-form">
                                        <div class="add-form-wrap">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">Company</label>
                                                                <select data-placeholder="Select a Company..." class="form-control select-control" id="company_name" name="company_name">
                                                                    <option value="">Select a Company</option>
                                                                    <?php
                                                                    foreach ($companies as $k => $v) {
                                                                        $selected = '';
                                                                        if (isset($dataArr) && $dataArr['companyGUID'] == $v['companyGUID'])
                                                                            $selected = 'selected';
                                                                        ?>
                                                                        <option value="<?php echo $v['companyGUID']; ?>" <?php echo $selected ?>><?php echo $v['companyName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <?php echo '<label id="company_name-error" class="validation-error-label" for="company_name">' . form_error('company') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">Location</label>
                                                                <select data-placeholder="Select a Location..." class="form-control select-control" id="txt_base_depot" name="txt_base_depot">
                                                                    <option value="">Select a location</option>
                                                                    <?php
                                                                    foreach ($locationArr as $k => $v) {
                                                                        $selected = '';
                                                                        if (isset($dataArr) && $dataArr['baseDepotGUID'] == $v['depotGUID'])
                                                                            $selected = 'selected';
                                                                        ?>
                                                                        <option value="<?php echo $v['depotGUID']; ?>" <?php echo $selected ?>><?php echo $v['depotName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <?php echo '<label id="txt_base_depot-error" class="validation-error-label" for="txt_base_depot">' . form_error('txt_base_depot') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group has-feedback">
                                                                <label>Is Employee ?</label>
                                                                <div class="checkbox checkbox-switchery">
                                                                    <input type="checkbox" class="switchery-info" name="txt_is_employee" id="txt_is_employee" <?php if (isset($dataArr) && $dataArr['employee'] == 1) echo "checked" ?>>
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
                                                                <?php echo '<label id="txt_surname-error" class="validation-error-label" for="txt_surname">' . form_error('txt_surname') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">Forename</label>
                                                                <input type="text" placeholder="Enter Forename" class="form-control" name="txt_forename" id="txt_forename" value="<?php echo (isset($dataArr)) ? $dataArr['firstName'] : set_value('txt_forename'); ?>">
                                                                <?php echo '<label id="txt_forename-error" class="validation-error-label" for="txt_forename">' . form_error('txt_forename') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">DOB</label>
                                                                <input type="text" placeholder="Enter DOB (DD/MM/YYYY)" class="form-control format-date dateofbirth" name="txt_dob" id="txt_dob" value="<?php echo (isset($dataArr)) ? date('d-m-Y', strtotime($dataArr['DOB'])) : set_value('txt_dob'); ?>">
                                                                <?php echo '<label id="txt_dob-error" class="validation-error-label" for="txt_dob">' . form_error('txt_dob') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">Email</label>
                                                                <input type="text" placeholder="Enter Email" class="form-control" name="txt_email" id="txt_email" value="<?php echo (isset($dataArr)) ? $dataArr['email'] : set_value('txt_email'); ?>">
                                                                <?php echo '<label id="txt_email-error" class="validation-error-label" for="txt_email">' . form_error('txt_email') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">                                    
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="required">Username</label>
                                                                <input type="text" placeholder="Enter Username" class="form-control" name="txt_username" id="txt_username" required value="<?php echo (isset($dataArr)) ? $dataArr['username'] : set_value('txt_username'); ?>">
                                                                <?php echo '<label id="txt_username-error" class="validation-error-label" for="txt_username">' . form_error('txt_username') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="<?php echo (!isset($dataArr)) ? 'required' : ''; ?>">Password</label>
                                                                <input type="password" placeholder="Enter Password" class="form-control" name="txt_pass" id="txt_pass" value="<?php echo set_value('txt_pass'); ?>" <?php echo (!isset($dataArr)) ? 'required' : ''; ?>>
                                                                <?php echo '<label id="txt_pass-error" class="validation-error-label" for="txt_pass">' . form_error('txt_pass') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-feedback">
                                                                <label class="<?php echo (!isset($dataArr)) ? 'required' : ''; ?>">Confirm Password</label>
                                                                <input type="password" placeholder="Re-enter Password" class="form-control" name="txt_cpass" id="txt_cpass" value="<?php echo set_value('txt_cpass'); ?>" <?php echo (!isset($dataArr)) ? 'required' : ''; ?>>
                                                                <?php echo '<label id="txt_cpass-error" class="validation-error-label" for="txt_cpass">' . form_error('txt_cpass') . '</label>'; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="table-responsive operator-license-tbl">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>License/Vehicle Type</th>
                                                                            <th>Licence No</th>
                                                                            <th>Expiry Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value="<?php if (isset($lic_type[0])) echo $lic_type[0] ?>"></td>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value="<?php if (isset($lic_no[0])) echo $lic_no[0] ?>"></td>
                                                                            <td><input type="text" class="form-control format-date dateselect" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value="<?php if (isset($exp_date[0])) echo date('d-m-Y', strtotime($exp_date[0])); ?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value="<?php if (isset($lic_type[1])) echo $lic_type[1] ?>"></td>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value="<?php if (isset($lic_no[1])) echo $lic_no[1] ?>"></td>
                                                                            <td><input type="text" class="form-control format-date dateselect" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value="<?php if (isset($exp_date[1])) echo date('d-m-Y', strtotime($exp_date[1])); ?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value="<?php if (isset($lic_type[2])) echo $lic_type[2] ?>"></td>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value="<?php if (isset($lic_no[2])) echo $lic_no[2] ?>"></td>
                                                                            <td><input type="text" class="form-control format-date dateselect" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value="<?php if (isset($exp_date[2])) echo date('d-m-Y', strtotime($exp_date[2])); ?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence Type" name="txt_licence_type[]" value="<?php if (isset($lic_type[3])) echo $lic_type[3] ?>"></td>
                                                                            <td><input type="text" class="form-control" placeholder="Enter Licence No." name="txt_licence_no[]" value="<?php if (isset($lic_no[3])) echo $lic_no[3] ?>"></td>
                                                                            <td><input type="text" class="form-control format-date dateselect" placeholder="Enter Expiry Date (DD/MM/YYYY)" name="txt_expiry_date[]" value="<?php if (isset($exp_date[3])) echo date('d-m-Y', strtotime($exp_date[3])); ?>"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-form-btn">
                                            <button type="submit" class="btn btn-lg">Submit</button>
                                            <a href="<?php echo site_url('operators'); ?>" class="btn btn-lg">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$edit = 0;
$operativeGUID = '';
if (isset($dataArr)) {
    $edit = 1;
    $operativeGUID = $dataArr['operativeGUID'];
}
?>
<script type="text/javascript">
    var edit = <?php echo $edit ?>;
    var remoteURL = site_url + "super_admin/operators/is_unique_operator_email";
    var remoteURL2 = site_url + "super_admin/operators/is_unique_operator_uname";
    if (edit == 1) {
        remoteURL += '/<?php echo base64_encode($operativeGUID) ?>';
        remoteURL2 += '/<?php echo base64_encode($operativeGUID) ?>';
    }

    $(document).on('change', '#company_name', function () {
        company = $(this).val();
        $('#txt_base_depot')
                .find('option')
                .remove();

        //-- Get all depots based on company ID
        $.ajax({
            url: site_url + 'super_admin/operators/get_basedepot',
            type: "POST",
            data: {company: company},
            success: function (response) {
                $('#txt_base_depot')
                        .find('option')
                        .remove()
                        .end()
                        .append(response);
            }
        });
    });
    // Datepicker initialization
    $('.dateselect').datepicker({
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    // Dateof birth initialization
    $('.dateofbirth').datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
        endDate: new Date()
    });


    /****************************************************************************
     This function is used to validate form
     ****************************************************************************/
    var validator = $("#add_operators_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
        errorClass: 'validation-error-label', successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {
            $(element).parent().find('.form_success_vert_icon').remove();
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            } else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            } else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            } else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            } else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function (element) {
            if ($(element).parent('div').hasClass('media-body')) {
                $(element).parent().find('.form_success_vert_icon').remove();
                $(element).remove();
            } else {
                $(element).parent().find('.form_success_vert_icon').remove();
                $(element).parent().append('<div class="form_success_vert_icon form-control-feedback"><i class="icon-checkmark-circle"></i></div>');
                $(element).remove();
            }
        },
        rules: {
            txt_base_depot: {required: true},
            txt_surname: {required: true, maxlength: 45},
            txt_forename: {required: true, maxlength: 45},
            txt_dob: {required: true},
            txt_email: {required: true, email: true, remote: remoteURL},
            txt_username: {required: true, remote: remoteURL2},
            txt_pass: {maxlength: 8},
            txt_cpass: {maxlength: 8, equalTo: '#txt_pass'}
        },
        messages: {
            txt_email: {
                remote: $.validator.format("Email already exist!")
            },
            txt_username: {
                remote: $.validator.format("Username already exist!")
            },
            txt_cpass: {
                equalTo: $.validator.format("Password does not match!")
            }
        },
        submitHandler: function (form) {
            form.submit();
            $('.custom_save_button').prop('disabled', true);
        },
        invalidHandler: function () {
            $('.custom_save_button').prop('disabled', false);
        }
    });
</script>