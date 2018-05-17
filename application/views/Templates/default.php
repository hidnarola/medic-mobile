<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/favicon.ico') ?>">

        <base href="<?php echo base_url(); ?>">

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="assets/css/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/responsive.css" rel="stylesheet" />
        <link href="assets/css/custom_ku.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <?php
        $class = $this->router->fetch_class();
        $action = $this->router->fetch_method();
        ?>
        <script type="text/javascript">
            var site_url = "<?php echo site_url() ?>";
            var base_url = "<?php echo base_url() ?>";
        </script>

        <title>Mobile Medic</title>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="assets/js/custom.js"></script>

        <!-- Core JS files -->        
<!--        <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>-->


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

<!--        <script type="text/javascript" src="assets/js/core/app.js"></script>-->

        <script type="text/javascript" src="assets/js/custom_pages/custom_pav.js"></script>
        <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
        <!-- <script type="text/javascript" src="assets/js/pages/form_multiselect.js"></script> -->
        <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
        <!--<script type="text/javascript" src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Smooth-Mouse-Scrolling-scrollSpeed/jQuery.scrollSpeed.js"></script>-->


        <!-- /theme JS files -->
        <script>
            $(".selectbox").selectBoxIt({
                autoWidth: false,
                theme: "bootstrap"
            });
        </script>
    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="logo"><a href="<?php echo site_url('/'); ?>"><img src="assets/images/logo.png" alt=""/></a></div>
                    <div class="nav">
                        <ul>
                            <li class="<?php echo($class == "service") ? 'active' : ''; ?>"><a href="<?php echo site_url('service'); ?>">Service</a></li>
                            <li class="<?php echo ($class == "notifications") ? 'active' : ''; ?>"><a href="<?php echo site_url('notifications'); ?>">Notifications</a></li>
                            <!--<li class="<?php echo($class == "dashboard" && $action == "index") ? 'active' : ''; ?>"><a href="<?php echo site_url('dashboard'); ?>">Operation</a></li>-->
                            <li class="<?php echo ($class == "operation" || ($class == "dashboard" && $action == "index")) ? 'active' : ''; ?>">><a href="<?php echo site_url('operation'); ?>">Operation</a></li>
                        </ul>
                    </div>
                    <div class="header-r">
                        <div class="service-icon">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17">
                                <path fill="#FFF" fill-rule="nonzero" stroke="#FFF" d="M10.719 10.618a5.476 5.476 0 0 0 1.464-3.723A5.492 5.492 0 0 0 6.698 1.41a5.492 5.492 0 0 0-5.485 5.485 5.492 5.492 0 0 0 5.485 5.485 5.458 5.458 0 0 0 3.284-1.092l4.08 4.079a.476.476 0 0 0 .695 0 .504.504 0 0 0 0-.703l-4.038-4.046zM2.205 6.895a4.497 4.497 0 0 1 4.493-4.492 4.491 4.491 0 1 1-4.492 4.492z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="search-icon">
                            <a href="<?php echo site_url('settings') ?>" class="<?php echo ($class == 'settings') ? 'active' : '' ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path fill="#FFF" fill-rule="nonzero" d="M13.801 6.036l-.404-.96s.94-2.12.857-2.201L13.01 1.66c-.086-.084-2.207.884-2.207.884l-.979-.395S8.96 0 8.842 0H7.086c-.122 0-.922 2.154-.922 2.154l-.977.396s-2.165-.92-2.248-.838L1.696 2.928C1.61 3.012 2.6 5.09 2.6 5.09l-.404.959S0 6.893 0 7.008v1.72c0 .12 2.2.904 2.2.904l.404.956s-.94 2.12-.857 2.2l1.243 1.218c.085.083 2.207-.885 2.207-.885l.979.396s.864 2.148.983 2.148h1.756c.121 0 .922-2.154.922-2.154l.98-.396s2.16.92 2.244.84l1.244-1.217c.087-.085-.904-2.16-.904-2.16l.403-.959S16 8.772 16 8.656v-1.72c0-.118-2.199-.9-2.199-.9zm-3.236 1.796c0 1.384-1.15 2.51-2.565 2.51-1.412 0-2.565-1.126-2.565-2.51S6.588 5.323 8 5.323c1.415.001 2.565 1.125 2.565 2.51z"/>
                                </svg>
                            </a>
                        </div>
<!--                        <span><?php echo get_AdminLogin('F') . ' ' . get_AdminLogin('L'); ?></span>
                        <a href="<?php echo site_url('logout'); ?>"><i class="icon-switch2"></i> Logout</a>-->
                    </div>
                </div>	
            </div>
        </header>
        <section class="mobile-nav">
            <div class="nav">
                <ul>
                    <li class="dropdown">
                        <a href="" id="dropdownMenuButton-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Service</a>
                        <div class="dropdown-menu left-nav" aria-labelledby="dropdownMenuButton-1">
                            <ul>
                                <li class="current-nav active"><a href=""><i></i> <span>STATS</span></a></li>
                                <li class="trends-nav"> <a href=""> <i></i> <span>TRENDS</span> </a> </li>
                                <li class="map-nav"> <a href=""> <i></i> <span>MAP</span> </a> </li>
                                <li class="operators-nav"> <a href=""> <i></i> <span>operators</span> </a> </li>
                                <li class="machines-nav"> <a href=""> <i></i> <span>Machines</span> </a> </li>
                                <li class="visits-nav"> <a href=""> <i></i> <span>VISITS</span> </a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="" id="dropdownMenuButton-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications</a>
                        <div class="dropdown-menu left-nav" aria-labelledby="dropdownMenuButton-2">
                            <ul>
                                <li class="current-nav active"><a href=""><i></i> <span>STATS</span></a></li>
                                <li class="trends-nav"> <a href=""> <i></i> <span>TRENDS</span> </a> </li>
                                <li class="map-nav"> <a href=""> <i></i> <span>MAP</span> </a> </li>
                                <li class="operators-nav"> <a href=""> <i></i> <span>operators</span> </a> </li>
                                <li class="machines-nav"> <a href=""> <i></i> <span>Machines</span> </a> </li>
                                <li class="visits-nav"> <a href=""> <i></i> <span>VISITS</span> </a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operation</a>
                        <div class="dropdown-menu dropdown-menu-right left-nav" aria-labelledby="dropdownMenuButton">
                            <ul>
                                <li class="current-nav active"><a href=""><i></i> <span>STATS</span></a></li>
                                <li class="trends-nav"> <a href=""> <i></i> <span>TRENDS</span> </a> </li>
                                <li class="map-nav"> <a href=""> <i></i> <span>MAP</span> </a> </li>
                                <li class="operators-nav"> <a href=""> <i></i> <span>operators</span> </a> </li>
                                <li class="machines-nav"> <a href=""> <i></i> <span>Machines</span> </a> </li>
                                <li class="visits-nav"> <a href=""> <i></i> <span>VISITS</span> </a> </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <div id="custom_loading" style="display: none;">
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
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <p>Send feedback about HiConnect »</p>
                </div>
            </div>
        </footer>
    </body>
</html>


