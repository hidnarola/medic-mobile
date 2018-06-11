<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav active">
                            <a href="<?php echo site_url('users') ?>">
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="trends-nav ">
                            <a href="<?php echo site_url('users/add') ?>">
                                <span>Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="srh-table managecomany_table">
                        <table class="table" id="users_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User name</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Company</th>
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
<script type="text/javascript">
    /****************************************************************************
     This function is used to display list of records in datatable
     ****************************************************************************/
    $(function () {
        $('#users_table').dataTable({
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
            ajax: site_url + 'super_admin/users/get_users',
            columns: [
                {
                    data: "sr_no",
                    visible: true,
                },
                {
                    data: "username",
                    visible: true,
                },
                {
                    data: "firstName",
                    visible: true,
                },
                {
                    data: "lastName",
                    visible: true,
                },
                {
                    data: "emailAddress",
                    visible: true,
                },
                {
                    data: "companyName",
                    visible: true,
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '';
                        action += '<a href="' + site_url + 'users/edit/' + btoa(full.userGUID) + '" id="' + btoa(full.companyGUID) + '" class="btn btn-xs edit_btn" title="Edit">Edit</a>';
                        action += '<a href="' + site_url + 'users/delete/' + btoa(full.userGUID) + '" class="btn btn-xs edit_btn" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
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
    });
</script>
