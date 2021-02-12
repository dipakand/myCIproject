<!DOCTYPE html>
<html lang="en" class="html_new">
    <head>
        <!--        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login/Logout animation concept</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"> 
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <!--        <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!--        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
        <!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/float-label-css/1.0.2/float-label.css"> -->
        <style>
            .field-icon {
                float: right;
                color:#fff;
                margin-top: 15px;
                position: relative;
                z-index: 2;
            }
            .pad{padding: 20px;}  
            .badge{background: #246963;}
        </style>
        <style>
            .demo{
                width: 45rem;
                height: 63rem;
                margin-left: -21rem;
            }
            /*.login_1 {
            position: relative;
            height: 100%;
            background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
            }*/
            .login_1 {

                position: relative;
                height: 80%;
                background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);

                transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25), -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
                -webkit-transform: scale(1);
                transform: scale(1);
            }
            .login__form1 {
                position: absolute;
                /*              top: 50%;*/
                left: 0;
                /*              width: 100%;*/
                /*              height: 50%;*/
                padding: 1.5rem 2.5rem;
                text-align: center;
                top: -2%;
            }
            .html_new, .neww {
                font-size: 80.5%;
            }
            .login__input1 {
                font-size: 1.2rem;
                width: 38rem;
                display: inline-block;
                /*                width: 22rem;*/
                height: 100%;
                padding-left: 1.5rem;
                /*                font-size: 1.5rem;*/
                background: transparent;
                color: #FDFCFD;
            }
            .login__row {
                height: 4rem;
            }
            .login__submit_brows{
                /*    position: relative;*/
                width: 36%;
                height: 2.1rem;
                margin: 0rem 0 -0.8rem;
                color: rgba(255, 255, 255, 0.8);
                background: #0073e6;
                /*                background: #FF3366;*/
                font-size: 1.2rem;
                border-radius: 3rem;
                float:left;
            }
            .login__submit1 {
                position: relative;
                width: 100%;
                height: 3.5rem;
                margin: 3rem 0 0.5rem;
                color: rgba(255, 255, 255, 0.8);
                background: #b30000;
                /*                background: #FF3366;*/
                font-size: 1.5rem;
                border-radius: 3rem;
                cursor: pointer;
                overflow: hidden;
                transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
            }
            .login__icon{
                /*            color:#000;*/
                margin-bottom: 0.1rem;
                padding-top:5px;
            }
            ::placeholder {
                color: white;
            }
            .pass{
                padding-left: 2.2rem;
            }
            .select__input{
                width:100%;
                height:100%;
                font-size: 1.2rem;
                background: transparent;
                color: #FDFCFD;
            }
            .opt {
                background-color:#888888 ;
            }
            .sty_btn{
                width:38%;
            }
        </style>
    </head>
    <body class="neww">
        <div class="cont">
            <div class="demo">
                <div style="background-color:#554271; color: rgba(255, 255, 255, 0.8);  font-size: 22px; text-align:center;">
                    Sign up with your credentials 
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20" style="margin-bottom:10px;">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                </div>
                <div class="login_1">
                    <form method="post" action="" role="form" enctype="multipart/form-data" class="" role="form">
                        <div class="login__form1">
                            <div id="mess" align="center" style="margin-top:20px;" class="alert alert-success"><strong>Success!</strong>User Has Been Successfully Registered!</div>
                            <div style=" ">&nbsp;</div>
                            <div class="login__row" >
                                <input type="text"  name="first_name" id="first_name" class="login__input1" placeholder="First Name"  required autofocus>
                            </div>
                            <div class="login__row" >
                                <input type="text"  name="last_name" id="last_name" class="login__input1" placeholder="Last Name"   required>
                            </div>
                            <div class="login__row">
                                <!--
<svg class="login__icon name svg-icon" viewBox="0 0 20 20">
<path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
</svg>
-->
                                <input type="text" name="user_name" id="user_name" class="login__input1" placeholder="User Name" tabindex="3" required>
                                <!--            <input type="text" name="username" class="login__input name" placeholder="Username" required >-->
                                <!--             <input type="hidden"  name="screen" id="screen" >-->
                            </div>
                            <div class="login__row">
                                <!--
<svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
<path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
</svg>
-->
                                <input type="password" name="password" id="password"  class="login__input1 pass" placeholder="Password"  required>
                                <span toggle="#password" style="font-size:17px;" class="fa fa-fw fa-eye-slash fa-1x field-icon toggle-password "></span>
                            </div>
                            <div class="login__row">
                                <input type="date" name="dob" id="dob" class="login__input1 " placeholder="Dob" autocomplete="off" tabindex="5" >
                            </div>
                            <div class="login__row">
                                <select id="class" name="urole" class="select__input " required>
                                    <option value="">--Select User Role--</option>
                                    <option value="PDI_Incharge" class="opt">PDI_Incharge</option>
                                    <option value="Acc_supervisor" class="opt">Acc_supervisor</option>
                                    <option value="Pdi_supervisor" class="opt">Pdi_supervisor</option>
                                    <option value="Sales-Executive" class="opt">Sales-Executive</option>
                                    <option value="Sales-Manager" class="opt">Sales-Manager</option>
                                    <option value="Accountant" class="opt">Accountant</option>
                                    <option value="DM" class="opt">DM</option>
                                    <option value="Coupon" class="opt">Coupon</option>
                                    <option value="accessory_manager" class="opt">Accessory Manager</option>
                                    <option value="showroom_manager" class="opt">Showroom Manager</option>
                                    <option value="billing" class="opt">Billing</option>
                                    <option value="Cashier" class="opt">Cashier</option>
                                    <option value="Reception" class="opt">Reception</option>
                                    <option value="RTO" class="opt">RTO</option>
                                    <option value="rto_clerk" class="opt">RTO Clerk</option>
                                    <option value="HSRP" class="opt">HSRP</option>
                                </select>
                            </div>
                            <div class="login__row">
                                <input type="email" name="email" id="email" class="login__input1" placeholder="Email Address" tabindex="6" >
                            </div>
                            <div class="login__row">
                                <!--                               <div  class="login__input1" style="">-->
                                <textarea name="address" id="address" class="login__input1" placeholder="Address" tabindex="7" ></textarea>
                                <!--                            </div>-->
                            </div>
                            <div class="login__row">
                                <input pattern="^\d{10}$" type="text" name="contact_no" maxlength=10 id="contact_no" class="login__input1" placeholder="Contact 1: format: xxxxxxxxxx"  tabindex="8" required>
                            </div>
                            <div class="login__row">
                                <input pattern="^\d{10}$" type="text" name="contact_no2" maxlength=10 id="contact_no2" class="login__input1" placeholder="Contact 2: format: xxxxxxxxxx"  tabindex="9" >
                            </div>
                            <button name="submitform"  type="submit" value="Register" class="login__submit1">Register</button>
                            <a href="login.php" type="submit" class=""  style="float:left; padding-bottom:20px;"><b>Already have an account?</b></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
        <script  src="js/index.js"></script>
        <script>
            //            $(function() {
            //
            //                $( ".datepicker" ).datepicker({
            //                    dateFormat: 'yy-mm-dd',
            //                    changeMonth: true,
            //                    changeYear: true,
            //                    showButtonPanel: true,
            //                    yearRange: "-100:+10",
            //                });
            //            });
        </script>
        <script>
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
        <script>
            $(document).ready(function () {
                <?php
                if(isset($_REQUEST['success']))
                {
                ?>
                $("#mess").delay(3000).fadeOut(2000);
                <?php
                }
                ?>
            });
        </script>    
    </body>
</html>
