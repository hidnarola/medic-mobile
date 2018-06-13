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
            <div class="modal-header bg-primary custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">Area Details</h6>
            </div>
            <div class="modal-body panel-body" id="area_view_body"></div>         
        </div>
    </div>
</div>
<script src="assets/js/custom_pages/company_admin/areas.js"></script>