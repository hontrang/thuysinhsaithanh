<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Supervip_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");



        $supervip = $this->MCommon->getAllRowByWhere('bds',['vip_type >'=>1],5,"id DESC");
		if($supervip)
			$data['supervip'] = $supervip;


        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}