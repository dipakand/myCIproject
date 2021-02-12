<div class="row">

    <div class="col-lg-12 col-sm-12 col-md-12">

        <ul class="nav nav-pills nav-justified">
            <li class=""><a href="<?php echo site_url('PartySMS');?>">Party</a></li>
            <li class="active"><a >Vendors</a></li>
        </ul>
    </div>  

    <div class="col-md-8 col-md-offset-2">&nbsp;

        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('BroadcastController/vendor_send');?>">
            <table  class="table ">
                <tr>
                    <td>Type Message</td>
                </tr>
                <tr>
                    <td><textarea rows="4" id="txtEnglish"  type="text" name="vendor_sms" class="form-control" maxlength="160" required autofocus></textarea></td>
                </tr>
                <tr><td colspan="1"><button class="btn btn-warning glyphicon glyphicon-send pull-right" type="submit" name="sendbroadcast"> Send SMS</button></td></tr>
            </table>
            <table id="demo_pag1" class="table table-striped text-center">

                <tr>
                    <td style="width:10%;"><b></b></td>
                    <td style="padding-top:2.5%;"><b>Sr. No.</b></td>
                    <td style="padding-top:2.5%;"><b>Name</b></td>
                    <td style="padding-top:2.5%;"><b>Contact No.</b></td>
                    <td style="padding-top:2.5%;"><b>Email Id</b></td>
                </tr>
                <?php 
                $i = 0;
                foreach($vendor_details as $vendor)
                {
                    //print_r($vendor); echo nl2br("\n");
                    $i++;
                ?>
                <tr>
                    <td><input type="checkbox" name="selectallvendor1[<?php echo $vendor->id;?>]" class="checkbox1 form- " value="<?php echo $vendor->id;?>"></td>
                    <td style="padding-top:2.5%;"><?php echo $i;?></td>
                    <td style="text-transform:capitalize; padding-top:2.5%;" ><?php echo $vendor->name;?></td>
                    <td style="padding-top:2.5%;"><?php echo $vendor->contact;?></td>
                    <td style="padding-top:2.5%;"><?php echo $vendor->email;?></td>

                </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
    <div class="col-sm-12">&nbsp;</div>
    <div class="col-sm-12">&nbsp;</div>
</div> 
<script type="text/javascript">
    $(function () {
        $("#selectpage").change(function () {

            var selectedValue = $(this).val();
            alert( selectedValue);
        });
    });
</script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
    google.load("elements", "1", {packages: "transliteration"});
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    function OnLoad() {                
        var options = {
            sourceLanguage:
            google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
            [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        var control = new google.elements.transliteration.TransliterationControl(options);
        control.makeTransliteratable(["txtHindi"]);
        var keyVal = 32; // Space key
        $("#txtEnglish").on('keydown', function(event) {
            if(event.keyCode === 32) {
                var engText = $("#txtEnglish").val() + " ";
                var engTextArray = engText.split(" ");
                $("#txtHindi").val($("#txtHindi").val() + engTextArray[engTextArray.length-2]);

                document.getElementById("txtHindi").focus();
                $("#txtHindi").trigger ( {
                    type: 'keypress', keyCode: keyVal, which: keyVal, charCode: keyVal
                } );
            }
        });
        $("#txtHindi").bind ("keyup",  function (event) {
            setTimeout(function(){ $("#txtEnglish").val($("#txtEnglish").val() + " "); document.getElementById("txtEnglish").focus()},0);
        });
    } //end onLoad function

    google.setOnLoadCallback(OnLoad);
</script>
<script>    
    $(document).ready(function(){
        $("#selectallparty").change(function(){
            $(".checkbox1").prop('checked', $(this).prop("checked"));
            $("#showme").fadeIn(300);
        });
        $(".checkbox1").change(function(){
            $("#showme").fadeIn(300);
        })        
    });
</script>
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-50:+10",
        });
    });
</script>
<script> 
    /*$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            // buttons: [ 'copy', 'excel', 'pdf', 'csvHtml5','print' ]
            buttons: [
                {
                    extend: 'excel',footer: true,className: 'btn-primary', 
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'pdfHtml5',footer: true,className: 'btn-primary',
                    customize: function (doc) { doc.defaultStyle.alignment = 'center'; doc.styles.tableFooter.alignment = 'center'; },
                    exportOptions: {         
                        columns: ':visible'         
                    }
                },
                {
                    extend: 'print',footer: true,className: 'btn-primary',
                    exportOptions: {         
                        columns: ':visible'         
                    }
                    //							customize: function ( win ) {
                    //							$(win.document.body).find( 'table' ).addClass( 'display' ).css( 'text-align', 'right' );
                    //							}
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );*/
</script>    