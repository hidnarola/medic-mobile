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
<script src="assets/js/custom_pages/super_admin/company.js"></script>