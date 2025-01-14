<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumb_widget extends MY_Widget
{

    function index($list=''){
        if($list != "")
            $data['list'] = $list;


        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}