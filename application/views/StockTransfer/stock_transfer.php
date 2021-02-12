<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-pills nav-justified">
            <li class="active" ><a href="index.php">New Request</a></li>
            <li><a href="issue_request.php">Issue Request</a></li>
            <li><a href="receive_request.php">Received Request</a></li>
        </ul>

        <form method="post">
            <div class="col-md-12">
                <div class="col-md-3 col-md-offset-3">
                    <br><br>
                    <?php
                    $location = explode(",",$company_row->location);
                    //print_r($location);
                    ?>
                    <select name="sel_location" id="" class="form-control">
                        <option value="">Select Location</option>
                        <?php
                        $val1 = 'xlit1';
                        foreach($location as $kee => $val)
                        {
                            $query = $this->db->query("select * from ".$val1.".company_master");
                            if($query->num_rows() > 0)
                            {
                                $loc_comp = $query->row();
                                if($loc_comp->company_name!='')
                                {
                        ?>
                        <option value="<?php echo $val; ?>"><?php echo $loc_comp->company_name; ?></option>
                        <?php 
                                }
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="col-md-3">
                    <br><br>
                    <input type="submit" name="submit_location" class="btn btn-success btn-block">
                </div>
            </div>
        </form>

        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />   


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