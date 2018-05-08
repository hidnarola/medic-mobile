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
        ajax: site_url + 'company_admin/settings/get_areas_data',
        columns: [
            {
                data: "sr_no",
                visible: true,
                sortable: false,
            },
            {
                data: "depotName",
                visible: true,
            },
            {
                data: "addressLine1",
                visible: true,
                render: function (data, type, full, meta) {
                    action = '';
                    action+=full.addressLine1;
                    if(full.addressLine2!=null){
                        action+=', '+full.addressLine2;    
                    }
                    if(full.addressLine3!=null){
                        action+=', '+full.addressLine3;    
                    }
                    action+=' - '+full.postcode_zipcode;
                    return action;
                }
            },
            {
                data: "m1_fname",
                visible: true,
                render: function (data, type, full, meta) {
                    action = '';
                    action+='<b>Name : </b>'+full.m1_fname+' '+full.m1_lname;
                    action+='<br><b>Email : </b>'+full.m1_email;
                    action+='<br><b>Mobile No : </b>'+full.m1_mobile;
                    return action;
                }
            },
            {
                data: "m1_lname",
                visible: true,
                render: function (data, type, full, meta) {
                    action = '';
                    if(full.m2_fname!=null && full.m2_lname!=null && full.m2_email!=null && full.m2_mobile!=null){
                        action+='<b>Name : </b>'+full.m2_fname+' '+full.m2_lname;
                        action+='<br><b>Email : </b>'+full.m2_email;
                        action+='<br><b>Mobile No : </b>'+full.m2_mobile;
                    }else{
                        action = 'N/A';
                    }
                    return action;
                }
            },
            {
                data: "action",
                render: function (data, type, full, meta) {
                    action = '';
                    action += '<a href="javascript:void(0);" style="padding-right: 10px;border-right:2px solid #455A64" title="View" id="\'' + btoa(full.depotGUID) + '\'" class="area_view_btn">View</a>';
                    action += '<a href="' + site_url + 'settings/manage_areas/edit/' + btoa(full.depotGUID) + '" id="' + btoa(full.depotGUID) + '" style="padding: 0 10px;" title="Edit">Edit</a>';
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
    var add_button = '<div class="text-right"><a href="' + site_url + 'settings/manage_areas/add" class="btn bg-warning btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Areas</a></div>';
    $('.datatable-header').append(add_button);
});

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
        txt_depot_name: { required: true, maxlength: 128 },
        txt_region_name: { required: true, maxlength: 80 },
        txt_addressLine1: { required: true, maxlength: 80 },
        txt_addressLine2: { maxlength: 80 },
        txt_addressLine3: { maxlength: 80 },
        txt_postcode: { required: true, number: true },
        txt_office_phone: { required: true, number: true },
        txt_manager_name1: { required: true, maxlength: 90 },
        txt_manager_mobile1: { required: true, maxlength: 10, minlength: 10, number: true, min:0 },
        txt_manager_email1: { required: true,email: true }
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
            data: {txt_modal_region_name : txt_modal_region_name, txt_modal_region_desc : txt_modal_region_desc},
            success: function (response) {
                if(response.status=='success'){
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

/********************************************************
            View button in areaslisting
********************************************************/
$(document).on('click', '.area_view_btn', function () {
    $.ajax({
        url: site_url + 'company_admin/settings/view_area_ajax',
        type: "POST",
        data: {id: this.id},
        success: function (response) {
            $('#area_view_body').html(response);
            $('#area_view_modal').modal('show');
        }
    });
});

$('#add_region_modal').on('click',function(){
    $('#add_region_form_modal').modal('show');
});