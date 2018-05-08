<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?php echo base_url(); ?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Authentication</title>

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
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
		<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

		<script type="text/javascript" src="assets/js/core/app.js"></script>
		<!-- <script type="text/javascript" src="assets/js/pages/login_validation.js"></script> -->
		<!-- /theme JS files -->

	</head>

	<body class="login-container login-cover">
		<?php echo $body; ?>
	</body>
	<style>
		body.login-cover::before {
		    background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
		    bottom: 0;
		    content: "";
		    left: 0;
		    position: absolute;
		    right: 0;
		    top: 0;
		}
		.login-cover{ background-image:url("assets/images/login_bg/1.jpg"); }
	</style>
	<script src="assets/js/custom_pages/jQuery.backstretch.js"></script>
	<script>
		setTimeout(
  			function(){
    			$.backstretch([
			      "assets/images/login_bg/2.jpg",
			      "assets/images/login_bg/3.jpg",
			      "assets/images/login_bg/4.jpg",
			      "assets/images/login_bg/5.jpg",
			      "assets/images/login_bg/6.jpg",
			      "assets/images/login_bg/7.jpg",
			      "assets/images/login_bg/8.jpg",
			      "assets/images/login_bg/9.jpg",
			      "assets/images/login_bg/10.jpg",
			      "assets/images/login_bg/11.jpg",
			      "assets/images/login_bg/12.jpg",
			      "assets/images/login_bg/13.jpg",
			      "assets/images/login_bg/14.jpg",
			      "assets/images/login_bg/15.jpg",
			      "assets/images/login_bg/16.jpg",
			      "assets/images/login_bg/17.jpg",
				  "assets/images/login_bg/18.jpg",
			      "assets/images/login_bg/19.jpg",
			      "assets/images/login_bg/20.jpg",
			      "assets/images/login_bg/21.jpg",
			      "assets/images/login_bg/22.jpg",
			      "assets/images/login_bg/23.jpg",
			      "assets/images/login_bg/24.jpg",
			      "assets/images/login_bg/25.jpg",
			      "assets/images/login_bg/26.jpg",
			      "assets/images/login_bg/27.jpg",
			      "assets/images/login_bg/28.jpg",
			      "assets/images/login_bg/29.jpg",
			      "assets/images/login_bg/30.jpg",
			      "assets/images/login_bg/31.jpg",
			      "assets/images/login_bg/32.jpg",
			      "assets/images/login_bg/33.jpg"
			      ], {
			        fade: 750,
			        duration: 5000
			    });
  			}, 5000);
	   
	</script>
</html>