<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/29/17 4:25 PM
 * Date: 9/5/17 11:56 PM
 *
 */

class Menu_left_home_widget extends MY_Widget
{
    
    function index(){
        $this->load->model('post/MPost');
        $list = $this->MPost->getListCat("0");
        $data['list'] = $list;
        $this->load->view('view',$data);
    }
}