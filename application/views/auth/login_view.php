<body class="login-page">
<!--Page Container Start Here-->
<section class="login-container">
    <div class="container">
        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
            <div class="login-form-container">
                <?php echo form_open('','class="j-forms" id="forms-login" ');?>
                    <div class="login-form-header">
                        <div class="logo">
                            <a href="#" title="KMS official Logo <?php echo ''.date('Y');?>"><img src="<?php echo base_url('assets/images/upload/kms_logo.gif'); ?>" alt="logo"></a>
                        </div>
                    </div>
                    <div class="login-form-content">
                        <!-- start login -->
                            <div class="unit">
                                <div class="input login-input">
                                    <label class="icon-left" for="login">
                                        <i class="zmdi zmdi-account"></i>
                                    </label>
                                    <input class="form-control login-frm-input"  type="text" id="username" name="username" placeholder="Username / Email">
                                </div>
                            </div>
                        <!-- end login -->

                        <!-- start password -->
                            <div class="unit">
                                <div class="input login-input">
                                    <label class="icon-left" for="password">
                                        <i class="zmdi zmdi-key"></i>
                                    </label>
                                    <input class="form-control login-frm-input"  type="password" id="password" name="password" placeholder="Password">
                                        <span class="hint">
                                            <a href="<?php echo base_url('auth/admin_functions');?>" class="link">Forgot password?</a>
                                        </span>
                                </div>
                            </div>
                        <!-- end password -->

                        <!-- start response from server -->
                            <div class="response">
                                <?php  
                                    if(!empty($success_msg)):
                                        echo '<div class="success-message unit"><i class="fa fa-check"></i>'.$success_message.'</div>';                                        
                                    elseif(!empty($error_msg)):
                                        echo '<div class="error-message unit"><i class="fa fa-times"></i>'.$error_msg.'</div>';
                                    endif;
                                ?>
                            </div>
                        <!-- end response from server -->
                    </div>
                    <div class="login-form-footer">
                        <?php 
                            $button_array = array(
                                                    'type'=>'submit',
                                                    'class'=>'btn-block btn btn-primary',
                                                    'name'=>'loginSubmit', 
                                                    'value'=>'Log in'
                                                );
                            echo form_submit($button_array);
                        ?>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
<!-- Section is closed in footer -->

