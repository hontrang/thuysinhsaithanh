<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Album_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $albums = $this->MCommon->getAllRow_lang($lang,'album','4','orders DESC');
        if($albums)
            $data['albums'] = $albums;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}