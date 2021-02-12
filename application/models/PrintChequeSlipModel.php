<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrintChequeSlipModel extends CI_Model
{
    function fetch_data()
    {
        //$sel_saleslog = mysqli_query($conn,"SELECT sales_log.*,sales.party_id as partyId from sales_log join sales on sales_log.sales_id=sales.id");
        //$select_party = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from manage_party where id='".$vall1['cparty']."' "));
        $this->db->select('sales_log.*,sales.party_id as partyId');
        $this->db->join('sales','sales_log.sales_id = sales.id');
        $query = $this->db->get('sales_log');
        
        return $query->result();
    }
}
?>