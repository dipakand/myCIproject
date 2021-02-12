</div>
</div>
</div>
</div>
</div>
</div>
</div>

<style>
    .footer {
        position: fixed;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #15224f;
        color:antiquewhite;
        text-align: center;
    }
    @media all and (max-width: 699px) and (min-width: 300px) {
        .footer {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 0rem;
            background-color: #15224f;
            color: antiquewhite;
            text-align: center;
            font-size: 10px;
        }
    }
</style>
<style>
    .size{
        font-size: 20px !important;
        margin-top: 9px !important;
        margin-left: -5px !important;
        padding-right: 6px !important;

    }
    .glyphicon-zoom-in {
        color:initial !important;
    }
    .role{
        /*color:dodgerblue;*/
    }
    .margin_tp_btm
    {
        margin: 5% 0px !important;
    }
</style>
<!--<footer>
Website : <a style="color:antiquewhite;" href=""</a>       
</footer>  -->   

<div class="footer navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="copyright">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="design">                   
                    Website : <a style="color:antiquewhite;" href=""</a>                  
                </div>
            </div>
        </div>
    </div>
</div>  
<!--<script src="<?php echo site_url();?>/assets/js/jquery-ui.js"></script>-->
<script src="<?php echo site_url();?>/assets/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />  

<script>
    setTimeout(function(){
        $('#success').fadeOut('slow');
        $('#error').fadeOut('slow');
    },5000);
</script>
<script>
    function active(a){
        var value = a;
        $.ajax({
            type:'get',
            url :"<?php echo site_url('/session_menu');?>",
            data : { 
                'set_value' : value
            },
            success: function(data) {
                console.log(data);
            }   
        });
    }
</script>
<script>
    /* $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });   function initMenu() {
        $('#menu ul').hide();
        $('#menu ul').children('.current').parent().show();
        $('#menu ul:first').show();
        $('#menu li a').click(
            function() {
                var checkElement = $(this).next();
                if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                    return false;
                }
                if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                    $('#menu ul:visible').slideUp('normal');
                    checkElement.slideDown('normal');
                    return false;
                }
            }
        );
    }
    $(document).ready(function() {initMenu();});  
    $(window).load(function () {
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });*/
</script> 
<style>
    @media only screen and (min-width: 600px) {
        #sidebar-wrapper {
            border-right: 1px solid #15224f;
        }
    }
</style>


<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");

        $(".showhide100").css("display",'block'); 
        $('.namewidth100').css("width","100%");
        if($('.toggled').length > 0)
        {
            $('#sidebar-wrapper').css('border-right','1px solid #15224f');
        }

        else if($('.toggled-2').length > 0)
        {
            $('#sidebar-wrapper').css('border-right','0px solid #15224f');
        }

    });
    $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
        if($('.toggled-2').length <= 0)
        {
            $(".showhide100").css("display",'block'); 
            $('.namewidth100').css("width","100%");
            $('#sidebar-wrapper').hover(
                function(){
                    $(".showhide100").css("display",'block'); 
                    $('.namewidth100').css("width","100%");
                }
            )
        }
        else{
            $(".showhide100").css("display",'none');
            $('.namewidth100').css("width","");
            $('#sidebar-wrapper').hover(
                function(){
                    $(".showhide100").css("display",'block'); 
                    $('.namewidth100').css("width","100%")
                },
                function(){ 
                    $(".showhide100").css("display",'none');
                    $('.namewidth100').css("width","")
                }
            )
        }
    });
    //            function initMenu() {
    //                $('#menu ul').hide();
    //                $('#menu ul').children('.current').parent().show();
    //                //$('#menu ul:first').show();
    //                $('#menu li a').click(
    //                    function() {
    //                        var checkElement = $(this).next();
    //                        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    //                            return false;
    //                        }
    //                        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    //                            $('#menu ul:visible').slideUp('normal');
    //                            checkElement.slideDown('normal');
    //                            return false;
    //                        }
    //                    }
    //                );
    //            }
    //    $(document).ready(function() {initMenu();});  
    $(window).load(function () {
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();

    });
</script>
<script>
    $(document).ready(function(){
        $('#sidebar-wrapper').hover(
            function(){
                $(".showhide100").css("display",'block'); 
                $('.namewidth100').css("width","100%")
            },
            function(){ 
                $(".showhide100").css("display",'none');
                $('.namewidth100').css("width","")
            }
        )
    });
</script>
</body>
</html>