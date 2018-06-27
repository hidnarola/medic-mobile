<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!--<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.min.css" />-->
<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('vehicles') ?>">
                                <span>Manage Vehicles</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('vehicles/add') ?>" class="custom_add_operators_btn">
                                <span>Add Vehicle</span>
                            </a>
                        </li>
                    </ul>
                </div> 
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="add_vehicle_form" class="form-horizontal">
                                    <div class="panel panel-body login-form">
                                        <div class="add-form-wrap">
                                            <div class="add-form-l">
                                                <div class="form-group">
                                                    <label class="control-label required">Company Name</label>
                                                    <select name="company_name" class="form-control select-control" id="company_name" required>
                                                        <option value="">Select Company</option>
                                                        <?php
                                                        foreach ($companies as $company) {
                                                            $selected = '';
                                                            if (isset($dataArr) && $dataArr['companyGUID'] == $company['companyGUID'])
                                                                $selected = 'selected';
                                                            ?>
                                                            <option value="<?php echo $company['companyGUID'] ?>" <?php echo $selected ?>><?php echo $company['companyName'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo '<label id="company_name-error" class="validation-error-label" for="company_name">' . form_error('company_name') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Base Depot</label>
                                                    <select class="form-control select-control" name="txt_base_depot" id="txt_base_depot">
                                                        <option value="">Select&hellip;</option>
                                                        <?php foreach ($depotArray as $k => $v) { ?>
                                                            <?php
                                                            if (in_array($v['depotGUID'], $used_depotGUID)) {
                                                                if (isset($dataArr) && $dataArr['baseDepotGUID'] == $v['depotGUID']) {
                                                                    $disabled = '';
                                                                } else {
                                                                    $disabled = 'disabled';
                                                                }
                                                            } else {
                                                                $disabled = '';
                                                            }
                                                            ?>
                                                            <option value="<?php echo $v['depotGUID']; ?>" <?php
                                                            if (isset($dataArr) && $dataArr['baseDepotGUID'] == $v['depotGUID']) {
                                                                echo 'selected';
                                                            }
                                                            ?> <?php echo $disabled; ?>><?php echo $v['depotName']; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                    <?php echo '<label id="txt_base_depot-error" class="validation-error-label" for="txt_base_depot">' . form_error('txt_base_depot') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Registration No.</label>
                                                    <input type="text" class="form-control" placeholder="Enter Registration No" name="txt_reg_no" id="txt_reg_no" value="<?php echo (isset($dataArr)) ? $dataArr['registration'] : set_value('txt_reg_no'); ?>">
                                                    <?php echo '<label id="txt_reg_no-error" class="validation-error-label" for="txt_reg_no">' . form_error('txt_reg_no') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Telematics ID</label>
                                                    <input type="text" class="form-control" placeholder="Enter Device ID" id="txt_device_id" name="txt_device_id" value="<?php echo (isset($dataArr)) ? $dataArr['deviceGUID'] : set_value('txt_device_id'); ?>">
                                                    <?php echo '<label id="txt_device_id-error" class="validation-error-label" for="txt_device_id">' . form_error('txt_device_id') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Vehicle Description</label>
                                                    <textarea class="form-control" placeholder="Enter Short Description" name="txt_vehicle_desc" id="txt_vehicle_desc"><?php echo (isset($dataArr)) ? $dataArr['description'] : set_value('txt_vehicle_desc'); ?></textarea>
                                                    <?php echo '<label id="txt_vehicle_desc-error" class="validation-error-label" for="txt_vehicle_desc">' . form_error('txt_vehicle_desc') . '</label>'; ?>
                                                </div>
                                                <div class="form-group"></div>
                                                <div class="form-group">
                                                    <label class="control-label">VIN No.</label>
                                                    <input type="text" class="form-control" placeholder="Enter VIN No." name="txt_vin_no" id="txt_vin_no" value="<?php echo (isset($dataArr)) ? $dataArr['vin'] : set_value('txt_vin_no'); ?>">
                                                    <?php echo '<label id="txt_vin_no-error" class="validation-error-label" for="txt_vin_no">' . form_error('txt_vin_no') . '</label>'; ?>
                                                </div>
                                                <div class="form-group select_form_group">
                                                    <label class="control-label required">Fuel Type</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-gas"></i>
                                                        </div>
                                                        <select class="form-control select-control" name="txt_fuel_type" id="txt_fuel_type">
                                                            <option value="">Select&hellip;</option>
                                                            <option value="Petrol" <?php
                                                            if (isset($dataArr) && $dataArr['fuelType'] == 'Petrol') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Petrol</option>
                                                            <option value="Diesel" <?php
                                                            if (isset($dataArr) && $dataArr['fuelType'] == 'Diesel') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Diesel</option>
                                                            <option value="Gasoline" <?php
                                                            if (isset($dataArr) && $dataArr['fuelType'] == 'Gasoline') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Gasoline</option>
                                                        </select>
                                                    </div>
                                                    <?php echo '<label id="txt_fuel_type-error" class="validation-error-label" for="txt_fuel_type">' . form_error('txt_fuel_type') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Current ODO Reading</label>
                                                    <input type="text" placeholder="Enter Current ODO" class="form-control" name="txt_curr_odo" id="txt_curr_odo" value="<?php echo (isset($dataArr)) ? $dataArr['odoReading'] : set_value('txt_curr_odo'); ?>">
                                                    <?php echo '<label id="txt_curr_odo-error" class="validation-error-label" for="txt_curr_odo">' . form_error('txt_curr_odo') . '</label>'; ?>
                                                </div>

                                                <div class="form-group select_form_group">
                                                    <label class="control-label required">Licence Type</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-credit-card"></i>
                                                        </div>
                                                        <select class="form-control select-control" name="txt_licence_type" id="txt_licence_type">
                                                            <option value="">Select&hellip;</option>
                                                            <option value="MC 50CC" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'MC 50CC') {
                                                                echo 'selected';
                                                            }
                                                            ?>>MC 50CC</option>
                                                            <option value="MC EX50CC" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'MC EX50CC') {
                                                                echo 'selected';
                                                            }
                                                            ?>>MC EX50CC</option>
                                                            <option value="FVG" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'FVG—Motorcycles') {
                                                                echo 'selected';
                                                            }
                                                            ?>>FVG—Motorcycles</option>
                                                            <option value="LMV" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'LMV') {
                                                                echo 'selected';
                                                            }
                                                            ?>>LMV</option>
                                                            <option value="LMV-NT" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'LMV-NT') {
                                                                echo 'selected';
                                                            }
                                                            ?>>LMV-NT</option>
                                                            <option value="LMV-TR" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'LMV-TR') {
                                                                echo 'selected';
                                                            }
                                                            ?>>LMV-TR</option>
                                                            <option value="HMV" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'HMV') {
                                                                echo 'selected';
                                                            }
                                                            ?>>HMV</option>
                                                            <option value="HPMV" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'HPMV') {
                                                                echo 'selected';
                                                            }
                                                            ?>>HPMV</option>
                                                            <option value="HTV" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'HTV') {
                                                                echo 'selected';
                                                            }
                                                            ?>>HTV</option>
                                                            <option value="TRAILER" <?php
                                                            if (isset($dataArr) && $dataArr['licenceType'] == 'TRAILER') {
                                                                echo 'selected';
                                                            }
                                                            ?>>TRAILER</option>
                                                        </select>
                                                    </div>
                                                    <?php echo '<label id="txt_licence_type-error" class="validation-error-label" for="txt_licence_type">' . form_error('txt_licence_type') . '</label>'; ?>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="txt_reset_counter" id="txt_reset_counter" <?php echo (isset($dataArr) && $dataArr['resetServiceCounter'] == 1) ? 'checked' : ''; ?>>Re-set Counter Service</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="txt_google_route" id="txt_google_route" <?php echo (isset($dataArr) && $dataArr['is_google_route'] == 1) ? 'checked' : ''; ?>>Google Route</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Specify Vehicle Type</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vehicle_type" value="car" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['type'] == 'car') {
                                                                echo 'checked';
                                                            }
                                                        } else {
                                                            echo 'checked';
                                                        }
                                                        ?>>Car
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vehicle_type" value="van" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['type'] == 'van') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Van
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vehicle_type" value="flatbed_lorry" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['type'] == 'flatbed_lorry') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Flatbed Lorry
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vehicle_type" value="articulated_lorry" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['type'] == 'articulated_lorry') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Articulated Lorry
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="vehicle_type" value="forklift_truck" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['type'] == 'forklift_truck') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Fork Lift Truck
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">ODO Measurment</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="odo_measurment" value="km" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['odo_measurment'] == 'km') {
                                                                echo 'checked';
                                                            }
                                                        } else {
                                                            echo 'checked';
                                                        }
                                                        ?>>Km
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="odo_measurment" value="miles" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['odo_measurment'] == 'miles') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Miles
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="odo_measurment" value="hours" <?php
                                                        if (isset($dataArr)) {
                                                            if ($dataArr['odo_measurment'] == 'hours') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>>Hours
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="add-form-r">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Service Intervals</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Intervals" id="txt_service_intervals" name="txt_service_intervals" value="<?php echo (isset($dataArr)) ? $dataArr['serviceIntervals'] : set_value('txt_service_intervals'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Last Service Date</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icon-calendar2"></i></span>
                                                                <input type="text" class="form-control pickadate-accessibility dateselect" placeholder="Enter Last Service Date" name="txt_last_service_date" id="txt_last_service_date" value="<?php echo (isset($dataArr)) ? date('d/m/Y', strtotime($dataArr['lastServiceDate'])) : set_value('txt_last_service_date'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Last Service ODO</label>
                                                            <input type="text" class="form-control" placeholder="Enter Last Service ODO" name="txt_last_service_odo" id="txt_last_service_odo" value="<?php echo (isset($dataArr)) ? $dataArr['lastServiceODO'] : set_value('txt_last_service_odo'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Next Service Due</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icon-calendar2"></i></span>
                                                                <input type="text" class="form-control pickadate-accessibility dateselect" placeholder="Enter Next Service Due" name="txt_next_service_due" id="txt_next_service_due" value="<?php echo (isset($dataArr)) ? date('d/m/Y', strtotime($dataArr['nextServiceDue'])) : set_value('txt_next_service_due'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Road Duty Due</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icon-calendar2"></i></span>
                                                                <input type="text" class="form-control pickadate-accessibility dateselect" placeholder="Enter Road Due Date" name="txt_road_due_date" id="txt_road_due_date" value="<?php echo (isset($dataArr)) ? date('d/m/Y', strtotime($dataArr['roadDutyDue'])) : set_value('txt_road_due_date'); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Inspection Intervals</label>
                                                            <input type="text" class="form-control" placeholder="Enter Inspection Intervals" id="txt_inspeaction_intervals" name="txt_inspection_intervals" value="<?php echo (isset($dataArr)) ? $dataArr['inspectionIntervals'] : set_value('txt_inspeaction_intervals'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Last Inspection Date</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icon-calendar2"></i></span>
                                                                <input type="text" class="form-control pickadate-accessibility dateselect" placeholder="Enter Last Inspection Date" name="txt_last_inspection_date" id="txt_last_inspection_date" value="<?php echo (isset($dataArr)) ? date('d/m/Y', strtotime($dataArr['lastInspectionDate'])) : set_value('txt_last_inspection_date'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Last Inspection ODO</label>
                                                            <input type="text" class="form-control" placeholder="Enter Last Inspection ODO" name="txt_last_inspection_odo" id="txt_last_inspection_odo" value="<?php echo (isset($dataArr)) ? $dataArr['lastInspectionODO'] : set_value('txt_last_inspection_odo'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Next Inspection Due</label>
                                                            <input type="text" class="form-control" placeholder="Enter Last Inspection ODO" name="txt_next_inspection_due" id="txt_next_inspection_due" value="<?php echo (isset($dataArr)) ? $dataArr['nextInspectionDue'] : set_value('txt_next_inspection_due'); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Insurance Due</label>
                                                            <div class="input-group date">
                                                                <span class="input-group-addon"><i class="icon-calendar2"></i></span>
                                                                <input type="text" class="form-control pickadate-accessibility dateselect" placeholder="Enter Insurance Due" name="txt_insurance_due" id="txt_insurance_due" value="<?php echo (isset($dataArr)) ? date('d/m/Y', strtotime($dataArr['insuranceDue'])) : set_value('txt_insurance_due'); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-form-btn">
                                            <button type="submit" class="custom_save_button">Submit</button>
                                            <a class="custom_cancel_button" href="<?php echo site_url('vehicles'); ?>">Cancel</a>
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
$baseDepot = '';
if (isset($dataArr)) {
    $baseDepot = $dataArr['baseDepotGUID'];
}
?>
<script>
    var remoteEnURL = site_url + "super_admin/vehicles/checkUnique_device_id";
<?php if (isset($dataArr)) { ?>
        var vehicleGUID = '<?php echo $dataArr['vehicleGUID'] ?>';
        remoteEnURL = site_url + "super_admin/vehicles/checkUnique_device_id/" + vehicleGUID;
<?php } ?>
</script>
<script>
    $(function () {

        $('#txt_fuel_type,#txt_licence_type').on('change', function () {
            $($(this)).valid();
        });

        $('#company_name').change(function () {
            company = $(this).val();
            baseDepot = '<?php echo $baseDepot ?>';
            $('#txt_base_depot')
                    .find('option')
                    .remove()
            //-- Get all depots based on company ID
            $.ajax({
                url: site_url + 'super_admin/vehicles/get_basedepot',
                type: "POST",
                data: {company: company, baseDepot: baseDepot},
                success: function (response) {
                    $('#txt_base_depot')
                            .find('option')
                            .remove()
                            .end()
                            .append(response);
                }
            });
        });
        $('.dateselect').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        /*
         $('.pickadate-accessibility').pickadate({
         labelMonthNext: 'Go to the next month',
         labelMonthPrev: 'Go to the previous month',
         labelMonthSelect: 'Pick a month from the dropdown',
         labelYearSelect: 'Pick a year from the dropdown',
         selectMonths: true,
         selectYears: true
         });*/
    });
    /****************************************************************************
     This function is used to validate form
     ****************************************************************************/
    var validator = $("#add_vehicle_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
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
            txt_device_id: {required: true, remote: remoteEnURL},
            txt_base_depot: {required: true, maxlength: 45},
            txt_reg_no: {required: true, maxlength: 10},
            txt_vin_no: {required: true, maxlength: 17},
            txt_fuel_type: {required: true},
            txt_licence_type: {required: true},
            txt_curr_odo: {required: true, number: true, min: 0}
        },
        messages: {
            txt_device_id: {
                remote: $.validator.format("This Device ID already exist!")
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