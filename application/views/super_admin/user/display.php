<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                    <th>Access Level</th>
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
                    data: "tier",
                    render: function (data, type, full, meta) {
                        if (data == 1) {
                            return 'Super User';
                        } else if (data == 2) {
                            return 'Master User';
                        } else if (data == 3) {
                            return 'Standard User';
                        } else if (data == 4) {
                            return 'Service User';
                        } else {
                            return '';
                        }

                    },
                    sortable: false,
                },
                {
                    data: "companyName",
                    visible: true,
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '';
                        action += '<a href="' + site_url + 'users/edit/' + btoa(full.userGUID) + '" id="' + btoa(full.companyGUID) + '" class="edit_btn right_bar" title="Edit">Edit</a>';
                        action += '<a href="' + site_url + 'users/delete/' + btoa(full.userGUID) + '" class="edit_btn last_btn" onclick="return confirm_alert(this)" title="Delete">Delete</a>';
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
    function confirm_alert(e) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = $(e).attr('href');
                return true;
            }
        });
        return false;
    }
</script>
