<div class="content-wrapper">
	<div class="row">
        <div class="col-md-12">
            <?php $this->load->view('alert_view'); ?>
            <div class="panel panel-flat">
                <table class="table datatable-basic table-hover">
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th style="width:15%">Name</th>
                            <th>Address</th>
                            <th>Manager Details</th>
                            <th>Secondary Manager</th>
                            <th style="width:10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
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