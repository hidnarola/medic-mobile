<?php $success_msg = $this->session->flashdata('success'); ?>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
<section class="setting-page">
    <div class="container">
        <div class="row">
            <div class="setting-nav">
                <ul class="d-flex">
                    <li><a href="<?php echo site_url('settings') ?>">General</a></li>
                    <li><a href="<?php echo site_url('settings/manage_vehicles') ?>">Machines</a></li>
                    <li><a href="<?php echo site_url('settings/manage_operators') ?>">Operators</a></li>
                    <li><a href="">Work lists</a></li>
                    <li><a href="">Reports</a></li>
                    <li><a href="<?php echo site_url('settings/manage_users') ?>">Customers</a></li>
                </ul>
            </div>
            <div class="general-info d-flex">
                <div class="general-info-l">
                    <div class="general-info-l-head d-flex">
                        <h2>General Information</h2>
                        <a href="javascript:void(0)" class="edit_profile_btn">EDIT</a>
                    </div>
                    <form id="edit-profile-form" method="post">
                        <div class="general-info-l-body">
                            <table>
                                <tr>
                                    <td>Company Name</td>
                                    <td><input type="text" name="company_name" placeholder="Company Name" class="input-edit" value="<?php echo $company['companyName'] ?>"/></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="name" placeholder="Firstname Lastname" class="input-edit" value="<?php echo $user['firstName'] . ' ' . $user['lastName'] ?>"/></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input type="text" name="username" placeholder="FirLas" class="input-edit" value="<?php echo $user['username']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td><input type="text" name="email" placeholder="firstname.lastname@companyname.com" class="input-edit" value="<?php echo $user['emailAddress']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td><input type="text" name="phone_number" placeholder="+358 40 123 1234" class="input-edit" value="<?php echo $company['phoneNumber']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>SMS notifications</td>
                                    <td><input type="text" name="sms_notifications" placeholder="+358 40 123 1234" class="input-edit" value="<?php echo $company['smsNotification']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="text" name="sms_notifications1" placeholder="+358 50 498 4248" class="input-edit" value="<?php echo $company['smsNotification1']; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" placeholder="Address line 1, 123 ABC, 012345 Place" class="input-edit" value="<?php echo $company['addressLine1']; ?>"/></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="general-info-r">
                    <div class="general-info-r-head d-flex">
                        <div class="general-info-r-l">
                            <h2>Picture</h2>	
                            <a href="">Upload</a> <br/>
                            <a href="">Delete</a>
                        </div>	
                        <div class="general-info-r-r">
                            <span></span>
                            <!--                            <label class="btn btn-default btn-file">
                                                            <input type="file" style="display: none;">
                                                        </label>-->
                        </div>
                    </div>
                    <div class="password_div" style="display: none">
                        <form method="post" id="change_pwd_frm" action="<?php echo site_url('company_admin/settings/updatepassword') ?>">
                            <div class="password-input">
                                <label>New Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter new password" class="input-edit"/>
                                <label id="password-error" class="error" for="password"><?php echo form_error('password') ?></label>
                            </div>    
                            <div class="password-input">
                                <label>Confirm Password</label>
                                <input type="password" name="con_password" id="con_password" placeholder="Confirm your password" class="input-edit"/>
                                <label id="con_password-error" class="error" for="con_password"><?php echo form_error('con_password') ?></label>
                            </div>
                            <button type="button" id="update_pwd_btn">UPDATE PASSWORD</button>
                        </form>
                    </div>
                    <button type="button" id="change_pwd_btn">CHANGE PASSWORD</button>
                </div>
            </div>

            <div class="notification-setting">
                <h2 class="d-flex">Notification settings</h2>
                <div class="notification-table d-flex">
                    <div class="notification-setting-l">
                        <table>
                            <thead>
                                <tr>
                                    <th>LOADER CRANES</th>
                                    <th>Visibility</th>
                                    <th>Send SMS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-red"></i>
                                            <h5>Driving with boom up</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-red"></i>
                                            <h5>Driving with stabilizer legs out</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Unstable operation</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Emergency stop not used</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Bumpy crane operation</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Slow operation</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Overload protection overridden</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Long idling time</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Pressing boom system to the ground</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Unoptimal crane use</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>	
                        </table>
                    </div>
                    <div class="notification-setting-r">
                        <table>
                            <thead>
                                <tr>
                                    <th>DEMOUNTABLES</th>
                                    <th>Visibility</th>
                                    <th>Send SMS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-red"></i>
                                            <h5>Driving with hook back</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-red"></i>
                                            <h5>Driving in tipping mode</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Driving without body locks activated</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>Emergency mode activated</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="operation-td">
                                            <i class="question-yellow"></i>
                                            <h5>D-code error limit exceeded</h5>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>	
                                    </td>
                                    <td>
                                        <div class="switch-wrap">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>	
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>
<script type="text/javascript">
    var success_msg = "<?php echo $success_msg ?>";
    $(document).on('click', '#change_pwd_btn', function () {
        $('.password_div').show();
        $('#change_pwd_btn').hide();
    });
    $(document).on('click', '#update_pwd_btn', function () {
        if ($('#change_pwd_frm').valid()) {
            $('#change_pwd_frm').submit();
        }
    });
    // Edit profile form validation
    $("#change_pwd_frm").validate({
        rules: {
            password: {
                required: true,
                minlength: 5,
            },
            con_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
        },
    });
    $(document).ready(function () {
        if (success_msg != '') {
            new PNotify({
                title: 'Success',
                text: success_msg,
                buttons: {
                    sticker: false
                },
            });
        }
    });

    // Edit profile form validation
    $("#edit-profile-form").validate({
        rules: {
            company_name: {
                required: true,
            },
            name: {
                required: true,
            },
            username: {
                required: true,
                remote: '<?php echo site_url('company_admin/settings/check_username') ?>'
            },
            email: {
                required: true,
                email: true,
                remote: '<?php echo site_url('company_admin/settings/check_useremail') ?>'
            },
        },
        messages: {
            company_name: {
                required: "Please enter Company name",
            },
            name: {
                required: "Please enter firstanme lastname",
            },
            username: {
                required: "Please enter username",
                remote: jQuery.validator.format("Username already exist!")
            },
            email: {
                required: "Please enter email",
                email: "Email is not in valid format",
                remote: jQuery.validator.format("Email already exist!")
            },
        },
    });
    //-- Validate edit profile form
    $(document).on('click', '.edit_profile_btn', function () {
        if ($("#edit-profile-form").valid()) {
            $("#edit-profile-form").submit();
        }
    });
    $(function () {
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                if (input.length) {
                    input.val(log);
                } else {
                    if (log)
                        alert(log);
                }
            });
        });

    });
</script>