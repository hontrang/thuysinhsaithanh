<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class News_hot_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $news_hots = $this->MCommon->getAllRow_lang($lang,'news',5,'view DESC');
        if($news_hots)
            $data['news_hots'] = $news_hots;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}