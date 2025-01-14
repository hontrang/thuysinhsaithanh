<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_box_widget extends MY_Widget
{
    function index(){
        if($this->session->userdata("userid") != "")
        {
            $this->load->model('MCommon');
            $this->load->model('user/MUser');

            $user = $this->MCommon->getRow('users',['id'=>$this->session->userdata("userid")]);
            $data['user'] = $user;

            $this->load->view('view',$data);
        }

    }



}