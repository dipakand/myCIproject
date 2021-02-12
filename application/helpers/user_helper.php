<?php

function getBrand()
{
    $CI =& get_instance();
    $mod = $CI->load->model('Productmodel');
    $conditions = array('users.id'=>$userId);
    $result = $CI->Productmodel->getBrand();
    if($result->num_rows()>0) {
        $data = $result->row();
        $res = $data->$field;
    } else {
        $res = '';
    }
    return $res;
}
/*function getUserDetails($userId=NULL,$field='')
{
    $CI =& get_instance();
    $mod = $CI->load->model('user_model');
    $conditions = array('users.id'=>$userId);
    $result = $CI->user_model->getUsers($conditions);
    if($result->num_rows()>0) {
        $data = $result->row();
        $res = $data->$field;
    } else {
        $res = '';
    }
    return $res;
}*/
?>