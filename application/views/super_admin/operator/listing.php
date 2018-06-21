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
                                    <th>Qualification Details</th>
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
                    data: "qualification_detials",
                    visible: true,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    data: "action",
                    render: function (data, type, full, meta) {
                        action = '<a href="javascript:void(0);" id="' + btoa(full.operativeGUID) + '" class="edit_operator edit_btn" style="padding:0 10px;" title="Edit">Edit</a>';
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

    $(document).on('click', '.edit_operator', function () {
        var id = this.id;
        $.ajax({
            url: site_url + 'company_admin/settings/get_operators_data_ajax',
            type: "POST",
            dataType: "json",
            data: {id: this.id},
            success: function (response) {
                var userDate = response.DOB;
                remoteURL = site_url + "company_admin/settings/is_unique_operator_email/" + id;
                remoteURL2 = site_url + "company_admin/settings/is_unique_operator_uname/" + id;
                $("#add_operators_form").validate();
                $('#txt_email').rules('add', {
                    remote: remoteURL,
                    messages: {
                        remote: "Email already exists"
                    }
                });
                $('#txt_username').rules('add', {
                    remote: remoteURL2,
                    messages: {
                        remote: "Username already exists"
                    }
                });
                $('#txt_pass').removeAttr('required');
                $('#txt_cpass').removeAttr('required');
                $('.div_add_operators').removeClass('hide');
                $('html,body').animate({scrollTop: $(".div_add_operators").offset().top}, 'slow');
                $('#add_operators_form').attr('action', 'settings/manage_operators/edit/' + id);
                $('#txt_surname').val(response.lastName);
                $('#txt_forename').val(response.firstName);
                $('#txt_dob').val(moment(userDate, "YYYY-MM-DD").format("DD/MM/YYYY"));
                $('#txt_email').val(response.email);
                $('#txt_username').val(response.username);

                $("#txt_base_depot").val(response.baseDepotGUID);
                $("#txt_base_depot").select2();

                if (response.lic_type != null && response.lic_no != null && response.exp_date != null) {
                    var lic_type_Arr = (response.lic_type).split(':-:');
                    var lic_no_Arr = (response.lic_no).split(':-:');
                    var expire_date_Arr = (response.exp_date).split(':-:');

                    $.each(lic_type_Arr, function (index, val) {
                        $('input[name="txt_licence_type[]"]:eq(' + index + ')').val(val);
                        $('input[name="txt_licence_no[]"]:eq(' + index + ')').val(lic_no_Arr[index]);
                        $('input[name="txt_expiry_date[]"]:eq(' + index + ')').val(moment(expire_date_Arr[index], "YYYY-MM-DD").format("DD/MM/YYYY"));
                    });
                }
            }
        });
    });

</script>