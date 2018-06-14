/****************************************************************************
 This function is used to display list of records in datatable
 ****************************************************************************/
$(function () {
    $('#company_table').dataTable({
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
                data: "town_city",
                visible: true,
            },
            {
                data: "country_state",
                visible: true,
            },
            {
                data: "postcode_zipcode",
                visible: true,
            },
            {
                data: "country",
                visible: true,
            },
            {
                data: "action",
                render: function (data, type, full, meta) {
                    action = '';
                    action += '<a href="' + site_url + 'manage_company/edit/' + btoa(full.companyGUID) + '" id="' + btoa(full.companyGUID) + '" class="btn btn-xs edit_btn" title="Edit">Edit</a>';
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
//    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');
//    var add_button = '<div class="text-right"><a href="' + site_url + 'manage_company/add" class="btn bg-primary btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Company</a></div>';
//    $('.datatable-header').append(add_button);
});
