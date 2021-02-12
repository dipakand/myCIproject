<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartyModel extends CI_Model{
    public function save_party($prod_arr)
    {
        $this->db->insert('manage_party',$prod_arr);

        if($this->db->affected_rows() > 0) 
        {
            return true;
        }
        return false;
    }

    public function getParty()
    {
        $query = $this->db->get('manage_party');

        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
        return false;
    }

    public function delete_party($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('manage_party');
        //        echo $this->db->last_query(); exit;
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function fetch_party($party_id)
    {

        $this->db->select('manage_party.*, state.state_name');
        $this->db->where('id',$party_id);
        $this->db->join('state','manage_party.state_id = state.state_id');
        $query = $this->db->get('manage_party');
        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }

    public function update_party($array, $party_id)
    {
        $this->db->where('id', $party_id);
        $this->db->update('manage_party', $array);

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
}
?>