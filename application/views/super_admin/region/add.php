<?php
if (isset($dataArr)) {
    $form_action = "settings/manage_areas/edit/" . base64_encode($dataArr['depotGUID']);
} else {
    $form_action = "settings/manage_areas/add";
}
?>
<section class="home-content padding-none admin-content">
    <div class="container">
        <div class="row">
            <div class="panel-content d-flex">
                <div class="left-nav">
                    <ul>
                        <li class="current-nav">
                            <a href="<?php echo site_url('regions') ?>">
                                <span>Manage Regions</span>
                            </a>
                        </li>
                        <li class="trends-nav active">
                            <a href="<?php echo site_url('regions/add') ?>">
                                <span>Add New</span>
                            </a>
                        </li>
                    </ul>
                </div>  
                <div class="right-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?php echo site_url($form_action); ?>" method="post" id="add_area_form">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Add Area</h5>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <fieldset>
                                                        <legend class="text-semibold"><i class="icon-truck position-left"></i> Location details</legend>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label class="required">Depot Name</label>
                                                                    <input type="text" class="form-control" name="txt_depot_name" id="txt_depot_name" placeholder="Enter Depot Name" value="<?php echo (isset($dataArr)) ? $dataArr['depotName'] : set_value('txt_depot_name'); ?>">
                                                                    <?php echo '<label id="txt_depot_name_error2" class="validation-error-label" for="txt_depot_name">' . form_error('txt_depot_name') . '</label>'; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="required">Region</label>
                                                                    <div class="input-group">
                                                                        <select data-placeholder="Select a Region..." class="select-search" id="txt_region_name" name="txt_region_name">
                                                                            <option></option>
                                                                            <?php
                                                                            foreach ($regionArr as $k => $v) {
                                                                                if (isset($dataArr)) {
                                                                                    if ($dataArr['regionGUID'] == $v['regionGUID']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                } else {
                                                                                    $selected = '';
                                                                                }
                                                                                ?>
                                                                                <option value="<?php echo $v['regionGUID']; ?>" <?php echo $selected; ?>><?php echo $v['regionName']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn bg-warning add_modal" type="button" id="add_region_modal" style="border-top-right-radius:5px;border-bottom-right-radius:5px"><i class="icon-plus-circle2"></i></button>
                                                                        </span>
                                                                    </div>
                                                                    <?php echo '<label id="txt_region_name_error2" class="validation-error-label" for="txt_region_name">' . form_error('txt_region_name') . '</label>'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label class="required">Address 1</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address Line1" name="txt_addressLine1" id="txt_addressLine1" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine1'] : set_value('txt_addressLine1'); ?>">
                                                            <?php echo '<label id="txt_addressLine1_error2" class="validation-error-label" for="txt_addressLine1">' . form_error('txt_addressLine1') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label>Address 2</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address Line2" name="txt_addressLine2" id="txt_addressLine2" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine2'] : set_value('txt_addressLine2'); ?>">
                                                            <?php echo '<label id="txt_addressLine2_error2" class="validation-error-label" for="txt_addressLine2">' . form_error('txt_addressLine2') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address 3</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address Line3" name="txt_addressLine3" id="txt_addressLine3" value="<?php echo (isset($dataArr)) ? $dataArr['addressLine3'] : set_value('txt_addressLine3'); ?>">
                                                            <?php echo '<label id="txt_addressLine3_error2" class="validation-error-label" for="txt_addressLine3">' . form_error('txt_addressLine3') . '</label>'; ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label class="required">Postal Code</label>
                                                                    <input type="text" placeholder="Enter Postal Code" class="form-control" name="txt_postcode" id="txt_postcode" value="<?php echo (isset($dataArr)) ? $dataArr['postcode_zipcode'] : set_value('txt_postcode'); ?>">
                                                                    <?php echo '<label id="txt_postcode_error2" class="validation-error-label" for="txt_postcode">' . form_error('txt_postcode') . '</label>'; ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <label class="required">Office Phone</label>
                                                                    <input type="text" placeholder="+99-99-9999-9999" class="form-control" name="txt_office_phone" id="txt_office_phone" value="<?php echo (isset($dataArr)) ? $dataArr['officePhone'] : set_value('txt_office_phone'); ?>">
                                                                    <?php echo '<label id="txt_office_phone_error2" class="validation-error-label" for="txt_office_phone">' . form_error('txt_office_phone') . '</label>'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-3">
                                                    <fieldset>
                                                        <legend class="text-semibold"><i class="icon-reading position-left"></i> Manager details</legend>
                                                        <div class="form-group has-feedback">
                                                            <label class="required">Manger Name</label>
                                                            <div class="input-group">
                                                                <select data-placeholder="Select a Manager..." class="select-search" id="txt_manager_name1" name="txt_manager_name1">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($managerArr as $k => $v) {
                                                                        if (isset($dataArr)) {
                                                                            if ($dataArr['m1_GUID'] == $v['managerGUID']) {
                                                                                $selected = 'selected';
                                                                            } else {
                                                                                $selected = '';
                                                                            }
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $v['managerGUID']; ?>" <?php echo $selected; ?>><?php echo $v['firstName'] . ' ' . $v['lastName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn">
                                                                    <a href="<?php echo site_url('settings/manage_users/add'); ?>" class="btn bg-warning add_modal" type="button" id="add_region_modal" style="border-top-right-radius:5px;border-bottom-right-radius:5px"><i class="icon-plus-circle2"></i></a>
                                                                </span>
                                                            </div>
                                                            <?php echo '<label id="txt_manager_name1_error2" class="validation-error-label" for="txt_manager_name1">' . form_error('txt_manager_name1') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label class="required">Mobile No</label>
                                                            <input type="text" placeholder="Enter Manager Mobile No." class="form-control" name="txt_manager_mobile1" id="txt_manager_mobile1" value="<?php echo (isset($dataArr)) ? $dataArr['m1_mobile'] : set_value('txt_manager_mobile1'); ?>">
                                                            <?php echo '<label id="txt_manager_mobile1_error2" class="validation-error-label" for="txt_manager_mobile1">' . form_error('txt_manager_mobile1') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label class="required">Primary Email</label>
                                                            <input type="text" placeholder="Enter Manager Email" class="form-control" name="txt_manager_email1" id="txt_manager_email1" value="<?php echo (isset($dataArr)) ? $dataArr['m1_email'] : set_value('txt_manager_email1'); ?>">
                                                            <?php echo '<label id="txt_manager_email1_error2" class="validation-error-label" for="txt_manager_email1">' . form_error('txt_manager_email1') . '</label>'; ?>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-3">
                                                    <fieldset>
                                                        <legend class="text-semibold"><i class="icon-reading position-left"></i> Secondary Manager details</legend>
                                                        <div class="form-group has-feedback">
                                                            <label>Manger Name</label>
                                                            <div class="input-group">
                                                                <select data-placeholder="Select a Manager..." class="select-search" id="txt_manager_name2" name="txt_manager_name2">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($managerArr as $k => $v) {
                                                                        if (isset($dataArr)) {
                                                                            if ($dataArr['secondaryManagerGUID'] == $v['managerGUID']) {
                                                                                $selected = 'selected';
                                                                            } else {
                                                                                $selected = '';
                                                                            }
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $v['managerGUID']; ?>" <?php echo $selected; ?>><?php echo $v['firstName'] . ' ' . $v['lastName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn">
                                                                    <a href="<?php echo site_url('settings/manage_users/add'); ?>" class="btn bg-warning add_modal" type="button" id="add_region_modal" style="border-top-right-radius:5px;border-bottom-right-radius:5px"><i class="icon-plus-circle2"></i></a>
                                                                </span>
                                                            </div>
                                                            <?php echo '<label id="txt_manager_name2_error2" class="validation-error-label" for="txt_manager_name2">' . form_error('txt_manager_name2') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label>Mobile No</label>
                                                            <input type="text" placeholder="Enter Mobile No." class="form-control" name="txt_manager_mobile2" id="txt_manager_mobile2" value="<?php echo (isset($dataArr)) ? $dataArr['m2_mobile'] : set_value('txt_manager_mobile2'); ?>">
                                                            <?php echo '<label id="txt_manager_mobile2_error2" class="validation-error-label" for="txt_manager_mobile2">' . form_error('txt_manager_mobile2') . '</label>'; ?>
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label>Primary Email</label>
                                                            <input type="text" placeholder="Enter Manager Email" class="form-control" name="txt_manager_email2" id="txt_manager_email2" value="<?php echo (isset($dataArr)) ? $dataArr['m2_email'] : set_value('txt_manager_email2'); ?>">
                                                            <?php echo '<label id="txt_manager_email2_error2" class="validation-error-label" for="txt_manager_email2">' . form_error('txt_manager_email2') . '</label>'; ?>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-success btn-lg">Submit</button>
                                                <a href="<?php echo site_url('settings/manage_areas'); ?>" class="btn btn-danger btn-lg">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Add Region Modal -->
<div id="add_region_form_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header custom_modal_header bg-primary-400">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="modal-title text-center">Add Region Details</h6>
            </div>
            <div class="modal-body panel-body" id="add_region_form_body">
                <form method="post" id="add_region_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required" aria-required="true"><b>Name</b></label>
                                <input type="text" class="form-control" name="txt_modal_region_name" id="txt_modal_region_name" placeholder="Region Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required" aria-required="true"><b>Description</b></label>
                                <textarea class="form-control" name="txt_modal_region_desc" id="txt_modal_region_desc" placeholder="Region Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn bg-success custom_save_button" name="btn_submit_region_data" id="btn_submit_region_data">Save</button>
                            <button type="button" class="btn bg-danger custom_cancel_button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/custom_pages/company_admin/areas.js"></script>