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
        ajax: site_url + 'super_admin/company/get_company_data',
        columns: [
            {
                data: "sr_no",
                visible: true,
                sortable: false,
            },
            {
                data: "companyName",
                visible: true,
            },
            {
                data: "addressLine1",
                visible: true,
            },
            {
                data: "action",
                render: function (data, type, full, meta) {
                    action = '';
                    action += '<a href="' + site_url + 'manage_company/edit/' + btoa(full.companyGUID) + '" id="' + btoa(full.companyGUID) + '" class="btn custom_dt_action_button btn-xs edit" title="Edit">Edit</a>';
                    //action += '&nbsp;&nbsp;<a href="' + site_url + 'manage_company/delete/' + btoa(full.id) + '" class="btn custom_dt_action_button btn-xs" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
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
    var add_button = '<div class="text-right"><a href="' + site_url + 'manage_company/add" class="btn bg-primary btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Company</a></div>';
    $('.datatable-header').append(add_button);
});

/****************************************************************************
                This function is used to validate form
****************************************************************************/
var validator = $("#add_compnay_form").validate({ignore: 'input[type=hidden], .select2-search__field, #txt_status', // ignore hidden fields
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
        name: { required: true },
        address: { required: true },
        txt_fname: { required: true },
        txt_lname: { required: true },
        txt_uname: { required: true },
        txt_email: { required: true, email: true },
        txt_pass : { minlength : 8 },
        txt_cpass : {  minlength : 8, equalTo : "#txt_pass" }
    },
    submitHandler: function (form) {
        form.submit();
        $('.custom_save_button').prop('disabled', true);
    },
    invalidHandler: function () {
        $('.custom_save_button').prop('disabled', false);
    }
});