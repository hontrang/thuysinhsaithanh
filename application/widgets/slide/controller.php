<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Slide_widget extends MY_Widget
{
    function index(){

        $data['a'] = "a";
        $this->load->view('view',$data);
    }



}