<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Footer_widget extends MY_Widget
{
    
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $list = $this->MCommon->getAllRowByWhere('menu2',['parent_id'=>0],9999,"orders ASC");
        if($list){
            $data['menu_bottom'] = (($list));
        }

        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}