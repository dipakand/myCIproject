<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <form method="post" name="form1">
            <div class="col-sm-12">
                <div class="col-sm-2 col-sm-offset-3"><b>Date From : </b>
                    <input type="text" name="frm_dt" id="frm_dt" value="<?php //echo $frmdate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><b>Date To : </b>
                    <input type="text" name="to_dt" id="to_dt" value="<?php //echo $todate;?>" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="col-sm-2"><br/>
                    <button class="btn btn-success btn-block" id="select_date" name="select_date" type="button">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8 col-sm-offset-2">
        <div class="table-responsive">
            <form method="POST" action="action.php" class="form-group-sm">&nbsp;
                <table class="table table-bordered" id="example" width="100%">
                    <thead>
                        <tr class="danger">
                            <th>Sr.</th>
                            <th>Date</th>

                            <th>Perticular</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_data">
                    </tbody>
                    <tfoot id="tfoot_data">
                        
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   

<script>

    $(function(){
        //fetch()
    });

    $(document).on('click','#select_date',function(){
        var FromDt = $('#frm_dt').val();
        var ToDt = $('#to_dt').val();

        if(FromDt == '' && ToDt =='')
        {
            $('#div_error').show();
            $('#error').html('Please Select both date.!!!');
        }
        else
        {
            $.ajax({
                type : 'Post',
                url : '<?php echo base_url();?>MonthSummaryController/fetch_data',
                dataType : 'json',
                data : {
                    frm_dt : FromDt,
                    to_dt : ToDt
                },
                success: function(response){
                    //console.log(response)
                    if(response.response == 'success')
                    {
                        //$('#div_success').show();
                        //$('#success').html(response.response.message);

                        var str ='';
                        var str1 ='';
                        var SrNo = 1;
                        var Debit =0;
                        var Credit =0;
                        //console.log(response.message)
                        response.message.forEach((element,index) =>{
                            console.log(element.debit)
                            SrNo = SrNo+index;
                            str +='<tr>';
                            str +='<td>'+SrNo+'</td>';
                            str +='<td>'+element.date+'</td>';
                            str +='<td>'+element.name+'</td>';
                            str +='<td>'+element.debit+'</td>';
                            str +='<td>'+element.credit+'</td>';
                            str +='</tr>';

                            Debit = Debit + parseInt(element.debit);
                            Credit = Credit + parseInt(element.credit);
                        })
                        str1 +='<tr>';
                        str1 +='<tr>';
                        str1 +='<td></td>';
                        str1 +='<td></td>';
                        str1 +='<td></td>';
                        str1 +='<td>'+Debit+'</td>';
                        str1 +='<td>'+Credit+'</td>';
                        str1 +='</tr>';

                        $('#tbody_data').html(str);
                        $('#tfoot_data').html(str1);
                    }
                    else
                    {
                        $('#div_error').show();
                        $('#error').html(response.response.message);
                    }
                }
            });
        }
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
    $(document).ready(function() {
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
    } );
</script> 