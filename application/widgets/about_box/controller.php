<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class About_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        //list
        $about_list = $this->MCommon->getAllRow_lang($lang,'about',null,'orders ASC');
        if($about_list)
            $data['about_list'] = $about_list;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}