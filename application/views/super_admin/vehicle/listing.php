<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
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
<script>
    var remoteEnURL = '';
</script>
<script src="assets/js/custom_pages/company_admin/vehicles.js"></script>