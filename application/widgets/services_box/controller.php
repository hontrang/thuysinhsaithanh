<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Services_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        //list
        $services_list = $this->MCommon->getAllRow_lang($lang,'services',null,'orders ASC');
        if($services_list)
            $data['services_list'] = $services_list;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}