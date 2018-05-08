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
        order: [[1, "desc"]],
        ajax: site_url + 'company_admin/settings/get_users_data',
        columns: [
            {
                data: "sr_no",
                visible: true,
                sortable: false,
            },
            {
                data: "firstName",
                visible: true,
                render: function (data, type, full, meta) {
                    action = full.firstName;
                    if(full.lastName!=null || full.lastName!=''){
                        action+= ' '+full.lastName;
                    }
                    return action;
                }
            },
            {
                data: "email",
                visible: true,
                render: function (data, type, full, meta) {
                    action = "<a href='mailto:"+full.email+"' target='_blank'>"+full.email+"</a>";
                    return action;
                }
            },
            {
                data: "officeNumber",
                visible: true,
                render: function (data, type, full, meta) {
                    action = '<b>Office No.: </b>'+full.officeNumber;
                    action+= '<br><b>Mobile No.: </b>'+full.mobileNumber;
                    return action;
                }
            },
            {
                data: "m2_fname",
                visible: true,
                render: function (data, type, full, meta) {
                    if(full.m2_fname==null && full.m2_lname==null && full.m2_email==null){
                        return 'N/A';
                    }else{
                        action = '<b>Full Name : </b>'+full.m2_fname;
                        if(full.m2_lname!=null || full.m2_lname!=''){
                            action+= ' '+full.m2_lname;
                        }
                        action+='<br><b>Email : </b>'+full.m2_email;
                        return action;    
                    }
                    
                }
            },
            {
                data: "multi-siteResponsibility",
                visible: true,
                render: function (data, type, full, meta) {
                    if(full.multi_site==1){
                        return '<span class="label bg-success">Active</span>';
                    }else{
                        return '<span class="label bg-danger">Block</span>';
                    }
                }
            },
            {
                data: "action",
                render: function (data, type, full, meta) {
                    action = '';
                    action += '<a href="javascript:void(0);" style="padding-right: 10px;border-right:2px solid #bbbbbb" title="View" id="\'' + btoa(full.managerGUID) + '\'" class="user_view_btn">View</a>';
                    action += '&nbsp;&nbsp;<a href="' + site_url + 'settings/manage_users/edit/' + btoa(full.managerGUID) + '" id="' + btoa(full.managerGUID) + '" style="padding:0 10px" title="Edit">Edit</a>';
                    //action += '&nbsp;&nbsp;<a href="' + site_url + 'manage_company/delete/' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
                    return action;
                },
                className: "action dt-head-center",
                sortable: false,
            },
        ]
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');
    var add_button = '<div class="text-right"><a href="' + site_url + 'settings/manage_users/add" class="btn bg-warning btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Users</a></div>';
    $('.datatable-header').append(add_button);
});

/****************************************************************************
                This function is used to validate form
****************************************************************************/
var validator = $("#add_users_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
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
        txt_base_depot: { required: true, maxlength: 45 },
        txt_surname: { required: true, maxlength: 45 },
        txt_forename: { required: true, maxlength: 45 },
        txt_email: { required: true, maxlength: 50, email: true },
        txt_office_number: { required: true, maxlength: 10, minlength: 10, number: true, min:0 },
        txt_mobile_number: { required: true, maxlength: 10, minlength: 10, number: true, min:0 }
    },
    submitHandler: function (form) {
        form.submit();
        $('.custom_save_button').prop('disabled', true);
    },
    invalidHandler: function () {
        $('.custom_save_button').prop('disabled', false);
    }
});

/********************************************************
            View button in users listing
********************************************************/
$(document).on('click', '.user_view_btn', function () {
    $.ajax({
        url: site_url + 'company_admin/settings/view_user_ajax',
        type: "POST",
        data: {id: this.id},
        success: function (response) {
            $('#user_view_body').html(response);
            $('#user_view_modal').modal('show');
        }
    });
});