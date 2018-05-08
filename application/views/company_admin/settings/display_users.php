<div class="content-wrapper">
	<div class="row">
        <div class="col-md-12">
            <?php $this->load->view('alert_view'); ?>
            <div class="panel panel-flat">
                <table class="table datatable-basic table-hover">
                    <thead>
                        <tr>
                            <th style="width:2%">#</th>
                            <th style="width:15%">Full Name</th>
                            <th>Email</th>
                            <th>Contact Details</th>
                            <th>Line Manager</th>
                            <th>Multi Site Responsibility</th>
                            <th style="width:10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- View modal -->
<div id="user_view_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">Users Details</h6>
            </div>
            <div class="modal-body panel-body" id="user_view_body"></div>
        </div>
    </div>
</div>
<script src="assets/js/custom_pages/company_admin/users.js"></script>