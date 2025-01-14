<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class News_cat_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $news_cats = $this->MCommon->getAllRow_lang($lang,'news_cat','1000','orders ASC');
        if($news_cats)
            $data['news_cats'] = $news_cats;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}