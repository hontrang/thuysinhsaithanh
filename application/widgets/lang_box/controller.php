<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Lang_box_widget extends MY_Widget
{
    function index(){
        $langs = $this->MCommon->getAllRowByWhere('language_list');
        if($langs)
            $data['langs'] = $langs;

        $this->load->view('view',$data);
    }
}