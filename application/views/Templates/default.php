<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mobile Medic</title>
	<?php
        $class = $this->router->fetch_class();
        $action = $this->router->fetch_method();
    ?>
    <script type="text/javascript">
        var site_url = "<?php echo site_url() ?>";
        var base_url = "<?php echo base_url() ?>";
    </script>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/custom_pav.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>	
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pagination/bs_pagination.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>
	
	<script type="text/javascript" src="assets/js/core/app.js"></script>

	<script type="text/javascript" src="assets/js/custom_pages/custom_pav.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
	<!-- <script type="text/javascript" src="assets/js/pages/form_multiselect.js"></script> -->
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Smooth-Mouse-Scrolling-scrollSpeed/jQuery.scrollSpeed.js"></script>
	
	<script>
		$(function(){
			//$('#custom_loading').removeClass('hide');
            // Pace.on('start', function() {
            //     $('#custom_loading').removeClass('hide');
            // });
            Pace.on('done', function() {
                //$('#custom_loading').addClass('hide');
            });
        })
	</script>
	<!-- <script type="text/javascript" src="assets/js/pages/form_select2.js"></script> -->
	<!-- /theme JS files -->
	<style type="text/css" media="print">
  		@page { size: landscape; }
	</style>

</head>

<body>
	<div id="mySidenav" class="sidenav">
		<ul class="nav navbar-nav navbar-nav-material">
			<li style="right: -5px;border-bottom: none;position:sticky !important">
				<div class="navbar-header bg-warning">
					<a class="navbar-brand" href="<?php echo site_url('/'); ?>" style="text-transform: uppercase;font-weight: bold;letter-spacing: 2px;font-size: 15px;padding:14px 20px 0px;">
						Medic-Mobile
					</a>
					<ul class="nav navbar-nav visible-xs-block">
		                <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="font-size:25px">&times;</a></li>
		            </ul>
				</div>	
			</li>
			<?php if($class!='settings'){ ?>
				<li class="<?php echo($class=="dashboard" && $action=="index") ? 'active' : ''; ?>"><a href="<?php echo site_url('dashboard'); ?>">Operations</a></li>
				<li class="<?php echo($action=="notifications") ? 'active' : ''; ?>"><a href="<?php echo site_url('notifications'); ?>">Notifications</a></li>
				<li class=""><a href="javascript:void(0)">Service</a></li>
			<?php }else{ ?>
				<li class="<?php echo($class=="settings" && ($action=="display_areas" || $action=="add_areas" || $action=="edit_areas")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_areas'); ?>">Manage Areas</a></li>
				<li class="<?php echo($class=="settings" && ($action=="display_users" || $action=="add_users" || $action=="edit_users")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_users'); ?>">Manage Users</a></li>
				<li class="<?php echo($class=="settings" && ($action=="display_vehicles" || $action=="add_vehicles" || $action=="edit_vehicles")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_vehicles'); ?>">Manage Vehicles</a></li>
				<li class="<?php echo($class=="settings" && ($action=="display_forklifts" || $action=="add_forklifts" || $action=="edit_forklifts")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_forklifts'); ?>">Manage Forklifts</a></li>
				<li class="<?php echo($class=="settings" && ($action=="display_operators" || $action=="add_operators" || $action=="edit_operators")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_operators'); ?>">Manage Operators</a></li>
				<li class=""><a href="<?php echo site_url('notifications'); ?>">Manage Subscription</a></li>
			<?php } ?>
		</ul>
		<?php if($class!='settings'){ ?>
			<ul class="nav navbar-nav navbar-nav-material navbar-right">
				<li><a href="<?php echo site_url('settings'); ?>"><i class="icon-cog3"></i>&nbsp;&nbsp;&nbsp;Settings</a></li>
			</ul>
		<?php }else{ ?>
			<ul class="nav navbar-nav navbar-nav-material navbar-right">
        		<li class="dropdown">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo site_url('dashboard'); ?>">Operations</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('notifications'); ?>">Notifications</a></li>
						<li class="divider"></li>
						<li><a href="javascript:void(0)">Service</a></li>
					</ul>
        		</li>
        	</ul>
		<?php } ?>
	</div>
	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-warning">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url('/'); ?>" style="padding:7px 20px;">
				<img src="assets/images/site_img/logo_light.png" style="height:30px">
			</a>
			<ul class="nav navbar-nav visible-xs-block">
                <li><a class="" onclick="openNav()"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/placeholder.jpg" alt="">
						<span><?php echo get_AdminLogin('F').' '.get_AdminLogin('L'); ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo site_url('logout'); ?>"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<?php if(get_AdminLogin('A')!=1){ ?>
		<div class="navbar navbar-default hidden-xs" id="navbar-second" style="padding:0px">
			<ul class="nav navbar-nav no-border visible-xs-block">
				<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
			</ul>
			<div class="navbar-header">
				<ul class="nav navbar-nav navbar-nav-material">
					<?php if($class!='settings'){ ?>
						<li class="<?php echo($class=="dashboard" && $action=="index") ? 'active' : ''; ?>"><a href="<?php echo site_url('dashboard'); ?>">Operations</a></li>
						<li class="<?php echo($action=="notifications") ? 'active' : ''; ?>"><a href="<?php echo site_url('notifications'); ?>">Notifications</a></li>
						<li class=""><a href="javascript:void(0)">Service</a></li>
					<?php }else{ ?>
						<li class="<?php echo($class=="settings" && ($action=="display_areas" || $action=="add_areas" || $action=="edit_areas")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_areas'); ?>">Manage Areas</a></li>
						<li class="<?php echo($class=="settings" && ($action=="display_users" || $action=="add_users" || $action=="edit_users")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_users'); ?>">Manage Users</a></li>
						<li class="<?php echo($class=="settings" && ($action=="display_vehicles" || $action=="add_vehicles" || $action=="edit_vehicles")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_vehicles'); ?>">Manage Vehicles</a></li>
						<!-- <li class="<?php echo($class=="settings" && ($action=="display_forklifts" || $action=="add_forklifts" || $action=="edit_forklifts")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_forklifts'); ?>">Manage Forklifts</a></li> -->
						<li class="<?php echo($class=="settings" && ($action=="display_operators" || $action=="add_operators" || $action=="edit_operators")) ? 'active' : ''; ?>"><a href="<?php echo site_url('settings/manage_operators'); ?>">Manage Operators</a></li>
						<li class=""><a href="<?php echo site_url('notifications'); ?>">Manage Subscription</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="navbar-collapse collapse" id="navbar-second-toggle">
				<?php if($class!='settings'){ ?>
					<script>
						$(function(){
							$('.pickadate-accessibility').pickadate({
						        labelMonthNext: 'Go to the next month',
						        labelMonthPrev: 'Go to the previous month',
						        labelMonthSelect: 'Pick a month from the dropdown',
						        labelYearSelect: 'Pick a year from the dropdown',
						        selectMonths: true,
						        selectYears: true
						    });
						});
					</script>
					<?php 
						if($this->input->get('txt_report_type')=='overview')
							$report_type = 'overview';
						else if($this->input->get('txt_report_type')=='dailycheck')
							$report_type = 'dailycheck';
						else if($this->input->get('txt_report_type')=='dailyalerts')
							$report_type = 'dailyalerts';
						else if($this->input->get('txt_report_type')=='faults')
							$report_type = 'faults';
						else if($this->input->get('txt_report_type')=='service_due')
							$report_type = 'service_due';
						else if($this->input->get('txt_report_type')=='proof_of_delivery')
							$report_type = 'proof_of_delivery';
						else if($this->input->get('txt_report_type')=='incidents')
							$report_type = 'incidents';
						else if($this->input->get('txt_report_type')=='operators')
							$report_type = 'operators';
						else
							$report_type = 'overview';
					?>
					<form class="navbar-form navbar-left" method="get" action="<?php echo site_url('dashboard'); ?>" id="operations_report_form" style="border-left:3px solid #ff5722">
						<div class="form-group">
	                        <div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate-accessibility" placeholder="Select a date&hellip;" id="txt_date" name="txt_date" value="<?php if(isset($dataArr)){ if($dataArr['end_date_data']==''){ echo ''; } else{echo date('d F, Y',strtotime($dataArr['end_date_data'])); }}else{ echo ''; } ?>">
							</div>
	                    </div>
						<div class="form-group">
							<select data-placeholder="Select a report..." class="select-size-sm border-warning text-warning btn-flat" name="txt_report_type">
								<option value="overview" <?php if($report_type=='overview'){ echo 'selected'; } ?> >Overview</option>
								<option value="dailycheck" <?php if($report_type=='dailycheck'){ echo 'selected'; } ?> >Daily Check</option>
								<option value="dailyalerts" <?php if($report_type=='dailyalerts'){ echo 'selected'; } ?> >Daily Alerts</option>
								<option value="faults" <?php if($report_type=='faults'){ echo 'selected'; } ?> >Faults</option>
								<option value="service_due" <?php if($report_type=='service_due'){ echo 'selected'; } ?> >Service Due</option>
								<option value="proof_of_delivery" <?php if($report_type=='proof_of_delivery'){ echo 'selected'; } ?> >Proof Of Delivery</option>
								<option value="incidents" <?php if($report_type=='incidents'){ echo 'selected'; } ?> >Incidents</option>
								<option value="operators" <?php if($report_type=='operators'){ echo 'selected'; } ?> >Operators</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-block btn-sm btn-warning" style="border-width:2px;letter-spacing: 1px">SEARCH</button>
						</div>
					</form>
				<?php } ?>
				<?php if($class!='settings'){ ?>
					<ul class="nav navbar-nav navbar-nav-material navbar-right">
						<li><a href="<?php echo site_url('settings'); ?>" style="box-shadow: 0px 6px 50px 0px #9ca0a4;"><i class="icon-cog3" style="font-size:22px"></i></a></li>
					</ul>
				<?php }else{ ?>
					<ul class="nav navbar-nav navbar-nav-material navbar-right">
	            		<li class="dropdown">
	            			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?php echo site_url('dashboard'); ?>">Operations</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo site_url('notifications'); ?>">Notifications</a></li>
								<li class="divider"></li>
								<li><a href="javascript:void(0)">Service</a></li>
							</ul>
	            		</li>
	            	</ul>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<!-- /second navbar -->


	<!-- Page header -->
	<?php if(get_AdminLogin('A')){ ?>
		<div class="page-header">
			<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
				<ul class="breadcrumb">
					<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ul>
			</div>
			<div class="page-header-content">
				<div class="page-title" style="padding:15px 36px 15px 0">
						<!-- <h4>
							<i class="icon-arrow-left52 position-left"></i>
							<span class="text-semibold">Home</span> - Dashboard
						</h4> -->
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- /page header -->

	<div class="page-container">
		<div class="page-content">
			<?php if(get_AdminLogin('A')==1){ ?>
				<script type="text/javascript" src="assets/js/pages/layout_sidebar_sticky_custom.js"></script>
				<div class="sidebar sidebar-main sidebar-default">
					<div class="sidebar-fixed">
						<div class="sidebar-content">
							<div class="sidebar-category sidebar-category-visible">
								<div class="category-content sidebar-user">
									<div class="media">
										<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
										<div class="media-body">
											<span class="media-heading text-semibold"><?php echo get_AdminLogin('F').' '.get_AdminLogin('L'); ?></span>
											<div class="text-size-mini text-muted">
												<i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
											</div>
										</div>

										<div class="media-right media-middle">
											<ul class="icons-list">
												<li>
													<a href="#"><i class="icon-cog3"></i></a>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div class="category-content no-padding">
									<ul class="navigation navigation-main navigation-accordion">
										<!-- <li class="<?php echo($class=="dashboard" && $action=="index") ? 'active' : ''; ?>"><a href=""><i class="icon-home4"></i> <span>Dashboard</span></a></li> -->
										<li class="<?php echo($class=="company" && ($action=="display_company" || $action=='add_company' || $action=='edit_company')) ? 'active' : ''; ?>"><a href="<?php echo site_url('manage_company'); ?>"><i class="icon-home4"></i> <span>Manage Company</span></a></li>
										<li><a href="javascript:void(0);"><i class="icon-home4"></i> <span>Manage Subscription Plan</span></a></li>
										<li><a href="javascript:void(0);"><i class="icon-home4"></i> <span>Manage Payments</span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<div id="custom_loading" class="hide">
                <div id="loading-center">
	        		<svg version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
	 					<path fill="#009688" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
	      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
	  					</path>
	 					<path fill="#26A69A" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
	      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="-360 50 50" repeatCount="indefinite" />
	  					</path>
	 					<path fill="#74afa9" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5L82,35.7z">
	      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
	  					</path>
					</svg>
	            </div>
            </div>
			<?php echo $body; ?>
		</div>
	</div>
		
	<!-- Footer -->
	<!-- <div class="footer text-muted">
		&copy; <?php echo date('Y').' Medic-Mobile'; ?>
	</div> -->
	<!-- /footer -->

</body>
</html>
<script>
	$(".selectbox").selectBoxIt({
        autoWidth: false,
        theme: "bootstrap"
    });
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<style>
	.navbar-nav-material .active{ border-bottom:2px solid #ff5722; }
	.navbar-nav-material .active > a{ background-color: #ff57221f; }

	#operations_report_form .select2-container,
	#operations_report_form .multiselect.dropdown-toggle{ width:150px !important; }
</style>
