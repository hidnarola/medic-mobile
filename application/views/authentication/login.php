<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <form action="<?php echo site_url('login'); ?>" class="form-validate" method="post">
                <div class="panel panel-body login-form" style="margin-top:8%">
                    <div class="text-center">
                            <!-- <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div> -->
                            <!--<img src="assets/images/site_img/medic_mobile_logo.png" style="height:10em">-->
                        <img src="assets/images/login-logo.png">
                        <p>Controlling your fleet</p>
                        <h5 class="content-group">Login to your account 
                                <!-- <small class="display-block">Your credentials</small> -->
                        </h5>
                    </div>
                    <?php $this->load->view('alert_view'); ?>
                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" class="form-control" placeholder="Username" name="txt_uname" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" class="form-control" placeholder="Password" name="txt_pass" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <!-- <div class="form-group login-options">
                            <div class="row">
                                    <div class="col-sm-6">
                                            <label class="checkbox-inline">
                                                    <input type="checkbox" class="styled" checked="checked">
                                                    Remember
                                            </label>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                            <a href="login_password_recover.html">Forgot password?</a>
                                    </div>
                            </div>
                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn bg-warning btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6 text-right">
                                <a href="<?php echo site_url('forgot_password') ?>">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.styled').uniform();
</script>
<style>
    .login-form{background-color:#000; color:#fff;}
    .login-form .text-center>img{max-width:190px; margin:0 0 5px;}
    .checker span { color:#fff; border:2px solid #fff;}
    .form-group button[type="submit"]{background:#d52b1f; border:1px solid #d52b1f;}
</style>