<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Bds_cat_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $listcat = $this->MCommon->getAllRowByWhere('bds_cat',[],null,'orders ASC');
        if($listcat)
            $data['listcat'] = $listcat;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}