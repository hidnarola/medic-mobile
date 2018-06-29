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
                            <a href="<?php echo site_url('vehicles') ?>">
                                <span>Manage Vehicles</span>
                            </a>
                        </li>
                        <li class="trends-nav ">
                            <a href="<?php echo site_url('vehicles/add') ?>">
                                <span>Add Vehicle</span>
                            </a>
                        </li>
                    </ul>
                </div>                
                <div class="right-panel">
                    <div class="srh-table managecomany_table">
                        <table class="table datatable-basic table-hover" id="users_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company</th>
                                    <th>Reg No.</th>
                                    <th>VIN No.</th>
                                    <th>Fuel type</th>
                                    <th>License Type</th>
                                    <th>Reset Service Counter</th>
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
<div id="vehicle_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-black custom_modal_header">
                <h6 class="modal-title text-center">Vehicle Details</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body panel-body view-modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-semibold">Time Frame Selection:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" placeholder="Select a daterange" id="timeframe" name="timeframe">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var remoteEnURL = '';
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
                        action = '<a href="javascript:void(0);" title="View" id="' + btoa(full.vehicleGUID) + '" class="edit_btn view_btn right_bar">View</a>';
                        action += '<a href="' + site_url + 'vehicles/edit/' + btoa(full.vehicleGUID) + '" id="' + btoa(full.vehicleGUID) + '" style="padding:0 10px;" title="Edit" class="edit_btn last_btn">Edit</a>';
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
    $(document).on('click', '.view_btn', function () {
        $('#vehicle_body').html('');
        var id = $(this).attr('id');
        $.ajax({
            url: site_url + 'super_admin/vehicles/view/' + id,
            success: function (response) {
                $('#vehicle_modal').modal();
                $('#vehicle_body').html(response);
            }
        });
    });
</script>
