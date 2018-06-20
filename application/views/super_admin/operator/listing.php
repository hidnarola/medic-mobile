<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav active">
                            <a href="<?php echo site_url('operators') ?>">
                                <span>Manage Operators</span>
                            </a>
                        </li>
                        <li class="trends-nav ">
                            <a href="javascript:void(0)" class="custom_add_operators_btn">
                                <span>Add Operators</span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="srh-table managecomany_table">
                        <table class="table datatable-basic" id="users_table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Company Name</th>
                                    <th>Base Depot</th>
                                    <th>Full Name</th>
                                    <th>Birthdate</th>
                                    <th>Is Employee?</th>
                                    <th>Qualification Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($dataArr)) {
    $form_action = "settings/manage_operators/edit/" . base64_encode($dataArr['operativeGUID']);
} else {
    $form_action = "settings/manage_operators/add";
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 div_add_operators hide" style="display: none">
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
                                                <?php foreach ($locationArr as $k => $v) { ?>
                                                    <option value="<?php echo $v['depotGUID']; ?>"><?php echo $v['depotName']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo '<label id="txt_base_depot_error2" class="validation-error-label" for="txt_base_depot">' . form_error('txt_base_depot') . '</label>'; ?>
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
                                            <?php echo '<label id="txt_surname_error2" class="validation-error-label" for="txt_surname">' . form_error('txt_surname') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Forename</label>
                                            <input type="text" placeholder="Enter Forename" class="form-control" name="txt_forename" id="txt_forename" value="<?php echo (isset($dataArr)) ? $dataArr['firstName'] : set_value('txt_forename'); ?>">
                                            <?php echo '<label id="txt_forename_error2" class="validation-error-label" for="txt_forename">' . form_error('txt_forename') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">DOB</label>
                                            <input type="text" placeholder="Enter DOB (DD/MM/YYYY)" class="form-control format-date" name="txt_dob" id="txt_dob" value="<?php echo (isset($dataArr)) ? date('dd/mm/Y', strtotime($dataArr['DOB'])) : set_value('txt_dob'); ?>">
                                            <?php echo '<label id="txt_dob_error2" class="validation-error-label" for="txt_dob">' . form_error('txt_dob') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Email</label>
                                            <input type="text" placeholder="Enter Email" class="form-control" name="txt_email" id="txt_email" value="<?php echo (isset($dataArr)) ? $dataArr['email'] : set_value('txt_email'); ?>">
                                            <?php echo '<label id="txt_email_error2" class="validation-error-label" for="txt_email">' . form_error('txt_email') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Username</label>
                                            <input type="text" placeholder="Enter Username" class="form-control" name="txt_username" id="txt_username" required value="<?php echo (isset($dataArr)) ? $dataArr['username'] : set_value('txt_username'); ?>">
                                            <?php echo '<label id="txt_username_error2" class="validation-error-label" for="txt_username">' . form_error('txt_username') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Password</label>
                                            <input type="text" placeholder="Enter Password" class="form-control" name="txt_pass" id="txt_pass" value="<?php echo set_value('txt_pass'); ?>" required>
                                            <?php echo '<label id="txt_pass_error2" class="validation-error-label" for="txt_pass">' . form_error('txt_pass') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            <label class="required">Confirm Password</label>
                                            <input type="text" placeholder="Re-enter Password" class="form-control" name="txt_cpass" id="txt_cpass" value="<?php echo set_value('txt_cpass'); ?>" required>
                                            <?php echo '<label id="txt_cpass_error2" class="validation-error-label" for="txt_cpass">' . form_error('txt_cpass') . '</label>'; ?>
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
    $(function () {
        var elems = document.querySelectorAll('.switchery-info');
        for (var i = 0; i < elems.length; i++) {
            var switchery = new Switchery(elems[i], {color: '#00BCD4'});
        }

        var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
        switches.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#4CAF50'});
        });

        $('.format-date').formatter({
            pattern: '{{99}}/{{99}}/{{9999}}'
        });
    });

    /****************************************************************************
     This function is used to display list of records in datatable
     ****************************************************************************/
    $(function () {
        $('.datatable-basic').dataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'},
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            order: [[0, "desc"]],
            ajax: site_url + 'super_admin/operators/get_operators_data',
            columns: [
                {
                    data: "sr_no",
                    visible: true
                },
                {
                    data: "companyName",
                    visible: true
                },
                {
                    data: "depotName",
                    visible: true
                },
                {
                    data: "fullName",
                    visible: true,
                    render: function (data, type, full, meta) {
                        return full.firstName + ' ' + full.lastName;
                    }
                },
                {
                    data: "DOB",
                    visible: true
                },
                {
                    data: "employee",
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return '<span class="label bg-success">Yes</span>';
                        } else {
                            return '<span class="label bg-danger">No</span>';
                        }
                    }
                },
                {
                    data: "qualification_detials",
                    visible: true,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '<a href="javascript:void(0);" id="' + btoa(full.operativeGUID) + '" class="edit_operator edit_btn" style="padding:0 10px;" title="Edit">Edit</a>';
                        return action;
                    },
                    sortable: false,
                },
            ]
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
        $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');
//    var add_button = '<div class="text-right"><a href="javascript:void(0)" class="btn bg-warning btn-labeled custom_add_operators_btn"><b><i class="icon-plus-circle2"></i></b> Add Operators</a></div>';
//    $('.datatable-header').append(add_button);
    });

    $(document).on('click', '.custom_add_operators_btn', function () {
        $('#txt_pass').attr('required', 'required');
        $('#txt_cpass').attr('required', 'required');
        $('.div_add_operators').removeClass('hide');
        $('html,body').animate({scrollTop: $(".div_add_operators").offset().top}, 'slow');
    });

    $(document).on('click', '.edit_operator', function () {
        var id = this.id;
        $.ajax({
            url: site_url + 'company_admin/settings/get_operators_data_ajax',
            type: "POST",
            dataType: "json",
            data: {id: this.id},
            success: function (response) {
                var userDate = response.DOB;
                remoteURL = site_url + "company_admin/settings/is_unique_operator_email/" + id;
                remoteURL2 = site_url + "company_admin/settings/is_unique_operator_uname/" + id;
                $("#add_operators_form").validate();
                $('#txt_email').rules('add', {
                    remote: remoteURL,
                    messages: {
                        remote: "Email already exists"
                    }
                });
                $('#txt_username').rules('add', {
                    remote: remoteURL2,
                    messages: {
                        remote: "Username already exists"
                    }
                });
                $('#txt_pass').removeAttr('required');
                $('#txt_cpass').removeAttr('required');
                $('.div_add_operators').removeClass('hide');
                $('html,body').animate({scrollTop: $(".div_add_operators").offset().top}, 'slow');
                $('#add_operators_form').attr('action', 'settings/manage_operators/edit/' + id);
                $('#txt_surname').val(response.lastName);
                $('#txt_forename').val(response.firstName);
                $('#txt_dob').val(moment(userDate, "YYYY-MM-DD").format("DD/MM/YYYY"));
                $('#txt_email').val(response.email);
                $('#txt_username').val(response.username);

                $("#txt_base_depot").val(response.baseDepotGUID);
                $("#txt_base_depot").select2();

                if (response.lic_type != null && response.lic_no != null && response.exp_date != null) {
                    var lic_type_Arr = (response.lic_type).split(':-:');
                    var lic_no_Arr = (response.lic_no).split(':-:');
                    var expire_date_Arr = (response.exp_date).split(':-:');

                    $.each(lic_type_Arr, function (index, val) {
                        $('input[name="txt_licence_type[]"]:eq(' + index + ')').val(val);
                        $('input[name="txt_licence_no[]"]:eq(' + index + ')').val(lic_no_Arr[index]);
                        $('input[name="txt_expiry_date[]"]:eq(' + index + ')').val(moment(expire_date_Arr[index], "YYYY-MM-DD").format("DD/MM/YYYY"));
                    });
                }
            }
        });
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
            txt_pass: {maxlength: 8},
            txt_cpass: {maxlength: 8, equalTo: '#txt_pass'}
        },
        messages: {
            txt_email: {
                remote: $.validator.format("Email already exist!")
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

    $(document).on('click', '.btn_close_add_op', function () {
        $('.div_add_operators').addClass('hide');
    });

    $(document).ready(function () {
        validation_errors = '<?php echo str_replace(array("\r", "\n"), "", validation_errors()); ?>';
        if (validation_errors != '') {
            $('.custom_add_operators_btn').trigger('click');
        }
    });
</script>