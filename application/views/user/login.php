<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login/Logout animation concept</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"> 
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_log.css">

        <style>
            .pad{padding: 20px;}  
            .badge{background: #246963;}
            ::placeholder {
                color: white;
                opacity: 2; 
            }
            .alerts{
                color: #ffa7a7;
                text-align: center;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
        <div class="cont">
            <?php print_r(form_error());?>
            <div class="demo">
                <div class="login">
                    <div class="login__check"></div>


                    <form action="<?php echo site_url('login');?>" method="POST" class="form-signin col-md-8 col-md-offset-2" role="form">
                        <div class="login__form">
                            <?php if($this->session->flashdata('message1')){ ?>
                            <div class="alerts" id="mydiv">
                                <?php echo $this->session->flashdata('message1'); ?>
                            </div>
                            <?php } ?>
                            <div class="login__row">
                                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                    <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                                </svg>
                                <input type="text" name="username" class="login__input name" placeholder="Username" required autofocus value="<?php echo set_value('username'); ?>">
                                <?php //echo form_error('username');?>
                            </div>
                            <?php if(form_error('username')){ ?>
                            <div class="alerts" id="mydiv1">
                                <?php echo form_error('username'); ?>
                            </div>
                            <?php } ?>
                            <div class="login__row">
                                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                    <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                                </svg>
                                <input type="password" name="password" class="login__input pass" placeholder="Password" required >
                                <?php //echo form_error('password');?>
                            </div>
                            <?php if(form_error('password')){ ?>
                            <div class="alerts" id="mydiv2">
                                <?php echo form_error('password'); ?>
                            </div>
                            <?php } ?>
                            <input class="login__submit" type="submit" value="Sign in">
                            <!--          <p class="login__signup">Don't have an account? &nbsp;<a href="signup.php">Sign up</a></p>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                $('#mydiv').fadeOut('fast');
                $('#mydiv1').fadeOut('fast');
                $('#mydiv2').fadeOut('fast');
            }, 10000); // <-- time in milliseconds
        </script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script  src="js/index.js"></script>
    </body>
</html>
