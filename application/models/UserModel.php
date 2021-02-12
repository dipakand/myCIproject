<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{

    public function login_check($username, $password)
    {
        //echo $username; echo nl2br("\n");
        //echo $password; echo nl2br("\n");
        $this->db->where('username',$username);
        //$this->db->where('status','Active');
        $query = $this->db->get('tbl_reg');
        if($query->num_rows() > 0)
        {
            //echo $this->db->last_query();
            $rows = $query->row();

            if (password_verify($password, $rows->password))
            {
                if($rows->status == 'Active')
                {
                    //print_r($rows);exit;
                    return $rows;
                }
                else
                {
                    return '3';
                }
            }
            else
            {
                return '2';
            }

        }
        else
        {
            return '1';
        }
    }
}
?>