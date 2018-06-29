<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<?php
if ($this->isAdmin)
    $section_class = 'home-content padding-none admin-content';
else
    $section_class = 'setting-page';
?>
<section class="<?php echo $section_class ?>">
    <div class="container">
        <div class="row">
            <?php
            if (!$this->isAdmin)
                $this->load->view('company_admin/settings/settings_header')
                ?>
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('regions') ?>">
                                <span>Manage Regions</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('regions/add') ?>">
                                <span>Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>  
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="add_area_form">
                                    <div class="panel panel-body">
                                        <div class="add-form-wrap">
                                            <div class="add-form-l">
                                                <!--<legend class="text-semibold"><i class="icon-truck position-left"></i> Location details</legend>-->
                                                <div class="form-group">
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
                                                <div class="form-group">
                                                    <label class="required">Depot Name</label>
                                                    <input type="text" class="form-control" name="txt_depot_name" id="txt_depot_name" placeholder="Enter Depot Name" value="<?php echo (isset($dataArr)) ? $dataArr['depotName'] : set_value('txt_depot_name'); ?>">
                                                    <?php echo '<label id="txt_depot_name_error2" class="validation-error-label" for="txt_depot_name">' . form_error('txt_depot_name') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Region</label>
                                                    <div class="input-group">
                                                        <select data-placeholder="Select a Region..." class="form-control" id="txt_region_name" name="txt_region_name">
                                                            <option></option>
                                                            <?php
                                                            foreach ($regionArr as $k => $v) {
                                                                if (isset($dataArr)) {
                                                                    if ($dataArr['regionGUID'] == $v['regionGUID']) {
                                                                        $selected = 'selected';
                                                                    } else {
                                                                        $selected = '';
                                                                    }
                                                                } else {
                                                                    $selected = '';
                                                                }
                                                                ?>
                                                                <option value="<?php echo $v['regionGUID']; ?>" <?php echo $selected; ?>><?php echo $v['regionName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn bg-red add_modal add_btn_icn" type="button" id="add_region_modal"><i class="fa fa-plus-circle"></i></button>
                                                        </span>
                                                    </div>
                                                    <?php echo '<label id="txt_region_name_error2" class="validation-error-label" for="txt_region_name">' . form_error('txt_region_name') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Address 1</label>
                                                    <input type="text" class="form-control" placeholder="Enter Address Line1" name="txt_addressLine1" id="txt_addressLine1" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine1'] : set_value('txt_addressLine1'); ?>">
                                                    <?php echo '<label id="txt_addressLine1_error2" class="validation-error-label" for="txt_addressLine1">' . form_error('txt_addressLine1') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address 2</label>
                                                    <input type="text" class="form-control" placeholder="Enter Address Line2" name="txt_addressLine2" id="txt_addressLine2" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine2'] : set_value('txt_addressLine2'); ?>">
                                                    <?php echo '<label id="txt_addressLine2_error2" class="validation-error-label" for="txt_addressLine2">' . form_error('txt_addressLine2') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address 3</label>
                                                    <input type="text" class="form-control" placeholder="Enter Address Line3" name="txt_addressLine3" id="txt_addressLine3" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine3'] : set_value('txt_addressLine3'); ?>">
                                                    <?php echo '<label id="txt_addressLine3_error2" class="validation-error-label" for="txt_addressLine3">' . form_error('txt_addressLine3') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="required">Postal Code</label>
                                                    <input type="text" placeholder="Enter Postal Code" class="form-control" name="txt_postcode" id="txt_postcode" value="<?php echo (isset($dataArr)) ? $dataArr['postcode_zipcode'] : set_value('txt_postcode'); ?>">
                                                    <?php echo '<label id="txt_postcode_error2" class="validation-error-label" for="txt_postcode">' . form_error('txt_postcode') . '</label>'; ?>
                                                </div>

                                                <div class="form-group">
                                                    <label class="required">Office Phone</label>
                                                    <input type="text" placeholder="+99-99-9999-9999" class="form-control" name="txt_office_phone" id="txt_office_phone" value="<?php echo (isset($dataArr)) ? $dataArr['officePhone'] : set_value('txt_office_phone'); ?>">
                                                    <?php echo '<label id="txt_office_phone_error2" class="validation-error-label" for="txt_office_phone">' . form_error('txt_office_phone') . '</label>'; ?>
                                                </div>
                                            </div>
                                            <div class="add-form-r">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            <!--<legend class="text-semibold"><i class="icon-reading position-left"></i> Manager details</legend>-->
                                                        <div class="form-group">
                                                            <label class="required">Manager Name</label>
                                                            <div class="input-group">
                                                                <select data-placeholder="Select a Manager..." class="form-control" id="txt_manager_name1" name="txt_manager_name1">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($managerArr as $k => $v) {
                                                                        if (isset($dataArr)) {
                                                                            if ($dataArr['m1_GUID'] == $v['managerGUID']) {
                                                                                $selected = 'selected';
                                                                            } else {
                                                                                $selected = '';
                                                                            }
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $v['managerGUID']; ?>" <?php echo $selected; ?>><?php echo $v['firstName'] . ' ' . $v['lastName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn">
                                                                    <a href="<?php echo site_url('settings/manage_users/add'); ?>" class="btn bg-red add_modal add_btn_icn" type="button" id="add_region_modal"><i class="fa fa-plus-circle"></i></a>
                                                                </span>
                                                            </div>
                                                            <?php echo '<label id="txt_manager_name1_error2" class="validation-error-label" for="txt_manager_name1">' . form_error('txt_manager_name1') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required">Mobile No</label>
                                                            <input type="text" placeholder="Enter Manager Mobile No." class="form-control" name="txt_manager_mobile1" id="txt_manager_mobile1" value="<?php echo (isset($dataArr)) ? $dataArr['m1_mobile'] : set_value('txt_manager_mobile1'); ?>">
                                                            <?php echo '<label id="txt_manager_mobile1_error2" class="validation-error-label" for="txt_manager_mobile1">' . form_error('txt_manager_mobile1') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="required">Primary Email</label>
                                                            <input type="text" placeholder="Enter Manager Email" class="form-control" name="txt_manager_email1" id="txt_manager_email1" value="<?php echo (isset($dataArr)) ? $dataArr['m1_email'] : set_value('txt_manager_email1'); ?>">
                                                            <?php echo '<label id="txt_manager_email1_error2" class="validation-error-label" for="txt_manager_email1">' . form_error('txt_manager_email1') . '</label>'; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <!--<legend class="text-semibold"><i class="icon-reading position-left"></i> Secondary Manager details</legend>-->
                                                        <div class="form-group">
                                                            <label>Manager Name</label>
                                                            <div class="input-group">
                                                                <select data-placeholder="Select a Manager..." class="form-control" id="txt_manager_name2" name="txt_manager_name2">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($managerArr as $k => $v) {
                                                                        if (isset($dataArr)) {
                                                                            if ($dataArr['secondaryManagerGUID'] == $v['managerGUID']) {
                                                                                $selected = 'selected';
                                                                            } else {
                                                                                $selected = '';
                                                                            }
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $v['managerGUID']; ?>" <?php echo $selected; ?>><?php echo $v['firstName'] . ' ' . $v['lastName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn">
                                                                    <a href="<?php echo site_url('settings/manage_users/add'); ?>" class="btn bg-red add_modal add_btn_icn" type="button" id="add_region_modal"><i class="fa fa-plus-circle"></i></a>
                                                                </span>
                                                            </div>
                                                            <?php echo '<label id="txt_manager_name2_error2" class="validation-error-label" for="txt_manager_name2">' . form_error('txt_manager_name2') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mobile No</label>
                                                            <input type="text" placeholder="Enter Mobile No." class="form-control" name="txt_manager_mobile2" id="txt_manager_mobile2" value="<?php echo (isset($dataArr)) ? $dataArr['m2_mobile'] : set_value('txt_manager_mobile2'); ?>">
                                                            <?php echo '<label id="txt_manager_mobile2_error2" class="validation-error-label" for="txt_manager_mobile2">' . form_error('txt_manager_mobile2') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Primary Email</label>
                                                            <input type="text" placeholder="Enter Manager Email" class="form-control" name="txt_manager_email2" id="txt_manager_email2" value="<?php echo (isset($dataArr)) ? $dataArr['m2_email'] : set_value('txt_manager_email2'); ?>">
                                                            <?php echo '<label id="txt_manager_email2_error2" class="validation-error-label" for="txt_manager_email2">' . form_error('txt_manager_email2') . '</label>'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-form-btn">                                                
                                            <button type="submit" class="btn btn-lg">Submit</button>
                                            <a href="<?php echo site_url('regions'); ?>" class="btn btn-lg">Cancel</a>
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
<!-- Add Region Modal -->
<div id="add_region_form_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-black custom_modal_header">
                <h6 class="modal-title text-center">Add Region Details</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body panel-body" id="add_region_form_body">
                <form method="post" id="add_region_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-material">
                                <label class="required" aria-required="true"><b>Name</b></label>
                                <input type="text" class="form-control" name="txt_modal_region_name" id="txt_modal_region_name" placeholder="Region Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-material">
                                <label class="required" aria-required="true"><b>Description</b></label>
                                <textarea class="form-control" name="txt_modal_region_desc" id="txt_modal_region_desc" placeholder="Region Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="add-form-btn">
                            <button type="submit" class="btn custom_save_button" name="btn_submit_region_data" id="btn_submit_region_data">Save</button>
                            <button type="button" class="btn custom_cancel_button cancel-btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    /****************************************************************************
     This function is used to validate form
     ****************************************************************************/
    var validator = $("#add_area_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
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
            txt_depot_name: {required: true, maxlength: 128},
            txt_region_name: {required: true, maxlength: 80},
            txt_addressLine1: {required: true, maxlength: 80},
            txt_addressLine2: {maxlength: 80},
            txt_addressLine3: {maxlength: 80},
            txt_postcode: {required: true, number: true},
            txt_office_phone: {required: true, number: true},
            txt_manager_name1: {required: true, maxlength: 90},
            txt_manager_mobile1: {required: true, maxlength: 10, minlength: 10, number: true, min: 0},
            txt_manager_email1: {required: true, email: true}
        },
        submitHandler: function (form) {
            form.submit();
            $('.custom_save_button').prop('disabled', true);
        },
        invalidHandler: function () {
            $('.custom_save_button').prop('disabled', false);
        }
    });

    /****************************************************************************
     This function is used to validate region modal form
     ****************************************************************************/
    var validator = $("#add_region_form").validate({
        ignore: '.select2-search__field, #txt_status', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
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
            txt_modal_region_name: {required: true, maxlength: 80},
            txt_modal_region_desc: {maxlength: 1000},
        },
        submitHandler: function (form) {
            var txt_modal_region_name = $('#txt_modal_region_name').val();
            var txt_modal_region_desc = $('#txt_modal_region_desc').val();
            $.ajax({
                url: site_url + 'company_admin/settings/add_region_data_ajax',
                dataType: "json",
                type: "POST",
                data: {txt_modal_region_name: txt_modal_region_name, txt_modal_region_desc: txt_modal_region_desc},
                success: function (response) {
                    if (response.status == 'success') {
                        $('#add_region_form_modal').modal('hide');
                        var options = "";
                        options = '<option value=' + response.regionGUID + '>' + response.regionName + '</option>';
                        $('#txt_region_name').append(options);
                        // $('#txt_region_name').removeAttr('disabled');
                        // $('#txt_region_name .no_regions').remove();
                        $("#txt_region_name").select2("destroy").select2();
                    }
                }
            });
            $('#btn_submit_make_data').prop('disabled', true);
        },
        invalidHandler: function () {
            $('#btn_submit_make_data').prop('disabled', false);
        }
    });
    $('#add_region_modal').on('click', function () {
        $('#add_region_form_modal').modal('show');
    });
</script>