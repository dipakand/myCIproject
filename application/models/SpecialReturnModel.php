<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SpecialReturnModel extends CI_Model
{
     function save_creditor($inser_arr)
    {
         $this->db->insert('creditor', $inser_arr);
         return true;
    }
}
?>