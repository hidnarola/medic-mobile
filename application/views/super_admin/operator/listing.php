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
                            <a href="<?php echo site_url('operators/add') ?>">
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
                                    <th>Qualification</th>
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
<script>
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
                    data: "lic_type",
                    visible: true,
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '<a href="' + site_url + 'operators/edit/' + btoa(full.operativeGUID) + '" class="edit_btn" style="padding:0 10px;" title="Edit">Edit</a>';
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

    });

</script>