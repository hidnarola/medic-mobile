<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav active">
                            <a href="<?php echo site_url('regions') ?>">
                                <span>Manage Regions</span>
                            </a>
                        </li>
                        <li class="trends-nav ">
                            <a href="<?php echo site_url('regions/add') ?>">
                                <span>Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="srh-table managecomany_table">
                        <table class="table datatable-basic" id="users_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Manager Details</th>
                                    <th>Secondary Manager</th>
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
<!-- View modal -->
<div id="area_view_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-black custom_modal_header">
                <h6 class="modal-title text-center">Area Details</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body panel-body view-modal-body" id="area_view_body"></div>         
        </div>
    </div>
</div>
<script type="text/javascript">
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
            ajax: site_url + 'super_admin/regions/get_areas_data',
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
                    data: "depotName",
                    visible: true,
                },
                {
                    data: "addressLine1",
                    visible: true,
                    render: function (data, type, full, meta) {
                        action = '';
                        action += full.addressLine1;
                        if (full.addressLine2 != null) {
                            action += ', ' + full.addressLine2;
                        }
                        if (full.addressLine3 != null) {
                            action += ', ' + full.addressLine3;
                        }
                        action += ' - ' + full.postcode_zipcode;
                        return action;
                    }
                },
                {
                    data: "m1_fname",
                    visible: true,
                    render: function (data, type, full, meta) {
                        action = '';
                        action += '<b>Name : </b>' + full.m1_fname + ' ' + full.m1_lname;
                        action += '<br><b>Email : </b>' + full.m1_email;
                        action += '<br><b>Mobile No : </b>' + full.m1_mobile;
                        return action;
                    }
                },
                {
                    data: "m1_lname",
                    visible: true,
                    render: function (data, type, full, meta) {
                        action = '';
                        if (full.m2_fname != null && full.m2_lname != null && full.m2_email != null && full.m2_mobile != null) {
                            action += '<b>Name : </b>' + full.m2_fname + ' ' + full.m2_lname;
                            action += '<br><b>Email : </b>' + full.m2_email;
                            action += '<br><b>Mobile No : </b>' + full.m2_mobile;
                        } else {
                            action = 'N/A';
                        }
                        return action;
                    }
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '';
                        action += '<a href="javascript:void(0);" title="View" id="\'' + btoa(full.depotGUID) + '\'" class="area_view_btn edit_btn right_bar">View</a>';
                        action += '<a href="' + site_url + 'regions/edit/' + btoa(full.depotGUID) + '" id="' + btoa(full.depotGUID) + '" class="edit_btn last_btn" title="Edit">Edit</a>';
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
//    var add_button = '<div class="text-right"><a href="' + site_url + 'settings/manage_areas/add" class="btn bg-warning btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Areas</a></div>';
//    $('.datatable-header').append(add_button);
    });
    /********************************************************
     View button in areaslisting
     ********************************************************/
    $(document).on('click', '.area_view_btn', function () {
        $.ajax({
            url: site_url + 'super_admin/regions/view_area_ajax',
            type: "POST",
            data: {id: this.id},
            success: function (response) {
                $('#area_view_body').html(response);
                $('#area_view_modal').modal('show');
            }
        });
    });

    $('#add_region_modal').on('click', function () {
        $('#add_region_form_modal').modal('show');
    });
</script>
