<?php
if ($this->isAdmin)
    $section_class = 'home-content padding-none admin-content';
else
    $section_class = 'setting-page';
?>
<section class="<?php echo $section_class ?>">
    <div class="container">
        <div class="row">
            <?php
            if (!$this->isAdmin)
                $this->load->view('company_admin/settings/settings_header')
                ?>
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav active">
                            <a href="<?php echo site_url('manage_company') ?>">
                                <span>Manage Company</span>
                            </a>
                        </li>
                        <li class="trends-nav ">
                            <a href="<?php echo site_url('manage_company/add') ?>">
                                <span>Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="srh-table managecomany_table">
                        <table class="table" id="company_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Parent Company</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zipcode</th>
                                    <th>Country</th>
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
                    data: "parentCompany",
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

    });

</script>
