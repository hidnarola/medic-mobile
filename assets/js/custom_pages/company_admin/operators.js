$(function(){
    var elems = document.querySelectorAll('.switchery-info');
    for (var i = 0; i < elems.length; i++) {
        var switchery = new Switchery(elems[i], {color: '#00BCD4'});
    }

    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
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
        ajax: site_url + 'company_admin/settings/get_operators_data',
        columns: [
            {
                data: "sr_no",
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
                    return full.firstName+' '+full.lastName;                      
                }
            },
            {
                data: "DOB",
                visible: true
            },
            {
                data: "employee",
                visible: true,
                className: "dt-head-center",
                render: function (data, type, full, meta) {
                    if(data){
                        return '<span class="label bg-success">Yes</span>';
                    }else{
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
                    //action = '<a href="javascript:void(0);" id="' + btoa(full.operativeGUID) + '" class="view_operator" style="font-size: 14px;font-weight: 500;padding-right: 10px;border-right:2px solid #bbbbbb" title="View">View</a>';
                    action = '<a href="javascript:void(0);" id="' + btoa(full.operativeGUID) + '" class="edit_operator" style="padding:0 10px;" title="Edit">Edit</a>';
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
//    var add_button = '<div class="text-right"><a href="javascript:void(0)" class="btn bg-warning btn-labeled custom_add_operators_btn"><b><i class="icon-plus-circle2"></i></b> Add Operators</a></div>';
//    $('.datatable-header').append(add_button);
});

$(document).on('click', '.custom_add_operators_btn', function () {
    $('#txt_pass').attr('required','required');
    $('#txt_cpass').attr('required','required');
    $('.div_add_operators').removeClass('hide');
    $('html,body').animate({scrollTop: $(".div_add_operators").offset().top},'slow');
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
            remoteURL = site_url + "company_admin/settings/is_unique_operator_email/"+id;
            remoteURL2 = site_url + "company_admin/settings/is_unique_operator_uname/"+id;
            $("#add_operators_form").validate();
            $('#txt_email').rules('add',{ 
                remote: remoteURL,
                messages: {
                    remote: "Email already exists"
                }
            });
            $('#txt_username').rules('add',{ 
                remote: remoteURL2,
                messages: {
                    remote: "Username already exists"
                }
            });
            $('#txt_pass').removeAttr('required');
            $('#txt_cpass').removeAttr('required');
            $('.div_add_operators').removeClass('hide');
            $('html,body').animate({scrollTop: $(".div_add_operators").offset().top},'slow');
            $('#add_operators_form').attr('action','settings/manage_operators/edit/'+id);
            $('#txt_surname').val(response.lastName);
            $('#txt_forename').val(response.firstName);
            $('#txt_dob').val(moment(userDate, "YYYY-MM-DD").format("DD/MM/YYYY"));
            $('#txt_email').val(response.email);
            $('#txt_username').val(response.username);

            $("#txt_base_depot").val(response.baseDepotGUID);
            $("#txt_base_depot").select2();

            if(response.lic_type!=null && response.lic_no!=null && response.exp_date!=null){
                var lic_type_Arr = (response.lic_type).split(':-:');
                var lic_no_Arr = (response.lic_no).split(':-:');
                var expire_date_Arr = (response.exp_date).split(':-:');

                $.each(lic_type_Arr , function(index, val) {
                    $('input[name="txt_licence_type[]"]:eq('+index+')').val(val);
                    $('input[name="txt_licence_no[]"]:eq('+index+')').val(lic_no_Arr[index]);
                    $('input[name="txt_expiry_date[]"]:eq('+index+')').val(moment(expire_date_Arr[index], "YYYY-MM-DD").format("DD/MM/YYYY"));
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
        txt_base_depot: { required: true },
        txt_surname: { required: true, maxlength: 45 },
        txt_forename: { required: true, maxlength: 45},
        txt_dob: { required: true },
        txt_email: { required: true, email: true, remote: remoteURL },
        txt_pass:{ maxlength:8 },
        txt_cpass:{ maxlength:8, equalTo: '#txt_pass' }
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

$(document).on('click','.btn_close_add_op',function(){
    $('.div_add_operators').addClass('hide');
});