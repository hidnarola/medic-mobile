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
        <link href="assets/css/pnotify.custom.min.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <?php
        $class = $this->router->fetch_class();
        $action = $this->router->fetch_method();
        ?>
        <script type="text/javascript">
            var site_url = "<?php echo site_url() ?>";
            var base_url = "<?php echo base_url() ?>";
            var s_msg = "<?php echo $this->session->flashdata('success') ?>";
            var e_msg = "<?php echo $this->session->flashdata('error') ?>";
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


        <script type="text/javascript" src="assets/js/custom_pages/custom_pav.js"></script>
        <script type="text/javascript" src="assets/js/pnotify.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>

        <!-- /theme JS files -->
    </head>
    <body>
        <header class="header">
            <div class="container admin-container">
                <div class="row">
                    <div class="logo"><a href="<?php echo site_url('/'); ?>"><img src="assets/images/logo.png" alt=""/></a></div>
                    <div class="nav admin-nav">
                        <ul>
                            <li>
                                <?php
                                if (isset($heading))
                                    echo $heading;
                                else
                                    echo "Manage Company";
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="header-r">
                        <p class="user-txt"><?php echo get_AdminLogin('F') . ' ' . get_AdminLogin('L'); ?></p>
                        <div class="search-icon">
                            <a href="javascript:void(0)" class="<?php echo ($class == 'settings') ? 'active' : '' ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path fill="#FFF" fill-rule="nonzero" d="M13.801 6.036l-.404-.96s.94-2.12.857-2.201L13.01 1.66c-.086-.084-2.207.884-2.207.884l-.979-.395S8.96 0 8.842 0H7.086c-.122 0-.922 2.154-.922 2.154l-.977.396s-2.165-.92-2.248-.838L1.696 2.928C1.61 3.012 2.6 5.09 2.6 5.09l-.404.959S0 6.893 0 7.008v1.72c0 .12 2.2.904 2.2.904l.404.956s-.94 2.12-.857 2.2l1.243 1.218c.085.083 2.207-.885 2.207-.885l.979.396s.864 2.148.983 2.148h1.756c.121 0 .922-2.154.922-2.154l.98-.396s2.16.92 2.244.84l1.244-1.217c.087-.085-.904-2.16-.904-2.16l.403-.959S16 8.772 16 8.656v-1.72c0-.118-2.199-.9-2.199-.9zm-3.236 1.796c0 1.384-1.15 2.51-2.565 2.51-1.412 0-2.565-1.126-2.565-2.51S6.588 5.323 8 5.323c1.415.001 2.565 1.125 2.565 2.51z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="logout-icon">
                            <a href="<?php echo site_url('logout') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.888 489.888" style="enable-background:new 0 0 489.888 489.888;" xml:space="preserve" width="16px" height="16px">
                                <path d="M25.383,290.5c-7.2-77.5,25.9-147.7,80.8-192.3c21.4-17.4,53.4-2.5,53.4,25l0,0c0,10.1-4.8,19.4-12.6,25.7    c-38.9,31.7-62.3,81.7-56.6,136.9c7.4,71.9,65,130.1,136.8,138.1c93.7,10.5,173.3-62.9,173.3-154.5c0-48.6-22.5-92.1-57.6-120.6    c-7.8-6.3-12.5-15.6-12.5-25.6l0,0c0-27.2,31.5-42.6,52.7-25.6c50.2,40.5,82.4,102.4,82.4,171.8c0,126.9-107.8,229.2-236.7,219.9    C122.183,481.8,35.283,396.9,25.383,290.5z M244.883,0c-18,0-32.5,14.6-32.5,32.5v149.7c0,18,14.6,32.5,32.5,32.5    s32.5-14.6,32.5-32.5V32.5C277.383,14.6,262.883,0,244.883,0z" fill="#FFFFFF"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>	
            </div>
        </header>
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
        <section class="select-services admin-topheader">
            <div class="container">
                <div class="row">
                    <div class="setting-nav">
                        <ul class="d-flex">
                            <li class="<?php echo ($class == 'company') ? 'active' : '' ?>"><a href="<?php echo site_url('manage_company') ?>">Manage Company</a></li>
                            <li class="<?php echo ($class == 'users') ? 'active' : '' ?>"><a href="<?php echo site_url('users') ?>">Manage System Users</a></li>
                            <li class="<?php echo ($class == 'vehicles') ? 'active' : '' ?>"><a href="<?php echo site_url('vehicles') ?>">Manage Vehicles</a></li>
                            <li class="<?php echo ($class == 'operators') ? 'active' : '' ?>"><a href="<?php echo site_url('operators') ?>">Manage Operators</a></li>
                            <li class="<?php echo ($class == 'regions') ? 'active' : '' ?>"><a href="<?php echo site_url('regions') ?>">Manage Regions</a></li>
                        </ul>
                    </div>  
                </div>
            </div>
        </section>
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


