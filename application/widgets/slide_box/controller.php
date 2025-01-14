<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Slide_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");



        $sliders = $this->MCommon->getAllRow_lang($lang,'slide1','10','orders ASC');
        if($sliders)
            $data['sliders'] = $sliders;


        $news_km = $this->MCommon->getAllRowByWhere_lang($lang,'news',[],7,'is_hot DESC, id DESC');
        if($news_km)
            $data['news_km'] = $news_km;

        $data['a'] = "a";
        $this->load->view('view',$data);
    }


}
