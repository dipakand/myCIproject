<div class="row">
    <div class="col-md-12">
        <?php
        //        print_r($mainArr);
        ?>
        <form method="POST" class="form-group-sm" action="<?php echo site_url('Slip');?>" >&nbsp;
            <table class="table table-striped table-bordered" id="example" width="100%">
                <thead>
                    <tr >
                        <th><input type="checkbox" id="selectallparty" style="width:100%;" name="chk_boxes" class="case" onchange="checkallclass(this)" ></th>
                        <th>Sr. No.</th>
                        <th>Party Name</th>
                        <th>Cheque No</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Drawer Name</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $srno=1;
                    foreach($mainArr as $kee1=>$vall1)
                    {
                    ?>
                    <tr>
                        <td><input type="checkbox"  id="chkbox" class="case" style="width:100%;" name="chkbox1[<?php echo $srno;?>]" value="<?php echo $kee1;?>"></td>
                        <td><?php echo $srno++; ?></td>
                        <td><?php echo ucwords($vall1['p_name']); ?></td>
                        <td><?php echo $vall1['cno']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($vall1['cdate'])); ?></td>
                        <td><?php echo $vall1['total']; ?></td>
                        <td><?php echo ucwords($vall1['cdrawer']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col-md-4 col-md-offset-4">
                <input type="submit" name="chkBoxSub" class="btn btn-success btn-block"/>
            </div>
        </form>
    </div>
    <div class="col-md-12">&nbsp;</div>
</div>
<script language="javascript">
    function checkallclass(selectall)
    {
        $('input:checkbox:not(:disabled).case').prop('checked', jQuery(selectall).prop('checked'));
    }
</script> 
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [
                {
                    extend: 'excel',className: 'btn-primary',className: 'btn-primary',
                    title: 'Print Cheque Slip',
                    exportOptions: {
                        columns: [ 1, 2, 3,4,5,6]
                    }
                },
                {
                    extend: 'pdf',className: 'btn-primary',orientation:'landscape',
                    title: 'Print Cheque Slip',
                    exportOptions: {
                        columns: [ 1, 2, 3,4,5,6]
                    }
                },
                {
                    extend: 'print',className: 'btn-primary',
                    title: 'Print Cheque Slip',
                    exportOptions: {
                        columns: [ 1, 2, 3,4,5,6]
                    }
                },
            ],
        } );
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>
<style type="text/css">
    div.dataTables_paginate {text-align: left !important;}
</style>