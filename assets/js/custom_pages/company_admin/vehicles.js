$(function () {
    $('.txt_tyre_details').each(function () {
        $(this).rules("add", {required: true});
    });

    $('#txt_fuel_type,#txt_licence_type').on('change', function () {
        $($(this)).valid();
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
        ajax: site_url + 'super_admin/vehicles/get_vehicles_data',
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
                data: "registration",
                visible: true
            },
            {
                data: "vin",
                visible: true
            },
            {
                data: "fuelType",
                visible: true
            },
            {
                data: "licenceType",
                visible: true
            },
            {
                data: "resetServiceCounter",
                visible: true
            },
            {
                data: "action",
                render: function (data, type, full, meta) {
                    action = '<a href="javascript:void(0);" style="padding-right: 10px;border-right:2px solid #bbbbbb" title="View" id="\'' + btoa(full.depotGUID) + '\'" class="edit_btn">View</a>';
                    action += '<a href="' + site_url + 'vehicles/edit/' + btoa(full.vehicleGUID) + '" id="' + btoa(full.vehicleGUID) + '" style="padding:0 10px;" title="Edit" class="edit_btn">Edit</a>';
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
//    var add_button = '<div class="text-right"><a href="' + site_url + 'settings/manage_vehicles/add" class="btn bg-warning btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Vehicles</a></div>';
//    $('.datatable-header').append(add_button);
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