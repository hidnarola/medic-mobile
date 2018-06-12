<?php
if (isset($dataArr)) {
    $form_action = 'users/edit/' . base64_encode($dataArr['companyGUID']);
} else {
    $form_action = 'users/add';
}
?>
<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('users') ?>">
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('users/add') ?>">
                                <span><?php echo (isset($user)) ? "Edit" : "Add New"; ?></span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="add_user_form" enctype="multipart/form-data">
                                    <div class="panel panel-body login-form">
                                        <?php
                                        if (!isset($LoginDetailsArr)) {
                                            $field_attribute = $label_attribute = 'required';
                                        } else {
                                            $field_attribute = 'readonly';
                                            $label_attribute = '';
                                        }
                                        ?>
                                        <div class="add-form-wrap add-usr-div">
                                            <div class="add-form-l">
                                                <div class="form-group">
                                                    <label class="control-label required">Company Name</label>
                                                    <select name="company_name" class="form-control select-control" id="company_name" required>
                                                        <?php
                                                        foreach ($companies as $company) {
                                                            $selected = '';
                                                            if (isset($user) && $user['companyGUID'] == $company['companyGUID'])
                                                                $selected = 'selected';
                                                            ?>
                                                            <option value="<?php echo $company['companyGUID'] ?>" <?php echo $selected ?>><?php echo $company['companyName'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo '<label id="company_name-error" class="validation-error-label" for="company_name">' . form_error('company_name') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">First Name</label>
                                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo (isset($user)) ? $user['firstName'] : set_value('txt_fname'); ?>" required>
                                                    <?php echo '<label id="firstname-error" class="validation-error-label" for="firstname">' . form_error('firstname') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Last Name</label>
                                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo (isset($user)) ? $user['lastName'] : set_value('lastname'); ?>" required>
                                                    <?php echo '<label id="lastname-error" class="validation-error-label" for="lastname">' . form_error('lastname') . '</label>'; ?>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="control-label required">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="<?php echo (isset($user)) ? $user['username'] : set_value('username'); ?>" required>
                                                    <?php echo '<label id="username-error" class="validation-error-label" for="username">' . form_error('username') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo (isset($user)) ? $user['emailAddress'] : set_value('email'); ?>" required>
                                                    <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('txt_pass'); ?>" <?php if (!isset($user)) echo "required" ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label required">Confirm Password</label>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('txt_cpass'); ?>" <?php if (!isset($user)) echo "required" ?>>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="add-form-btn">
                                            <button type="submit" class="custom_save_button">Save</button>
                                            <a class="custom_cancel_button" href="<?php echo site_url('users'); ?>">Cancel</a>
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
$unique_id = '';
$company_id = '';
if (isset($user)) {
    $edit = 1;
    $unique_id = $user['userGUID'];
}
?>
<script type="text/javascript">
    uname_ajax = '<?php echo site_url('super_admin/company/check_username') ?>';
    email_ajax = '<?php echo site_url('super_admin/company/check_useremail') ?>';

    edit = <?php echo $edit ?>;
    if (edit == 1) {
        uname_ajax += '/<?php echo $unique_id ?>';
        email_ajax += '/<?php echo $unique_id ?>';
    }

    /****************************************************************************
     This function is used to validate form
     ****************************************************************************/
    var validator = $("#add_user_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
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
            company_name: {required: true},
            firstname: {required: true},
            lastname: {required: true},
            username: {required: true, remote: uname_ajax},
            email: {required: true, email: true, remote: email_ajax},
            txt_pass: {minlength: 8},
            txt_cpass: {minlength: 8, equalTo: "#txt_pass"}
        },
        messages: {
            username: {
                remote: jQuery.validator.format("Username already exist!"),
            },
            email: {
                remote: jQuery.validator.format("Email already exist!"),
            },
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