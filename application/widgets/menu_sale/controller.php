<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/25/17 11:13 PM
 * Date: 8/21/17 2:14 PM
 *
 */

class Menu_admin_widget extends MY_Widget
{

    function index(){

        $location = $this->MCommon->getAllRow('location');
        $data['location_menu'] = $location;

        $this->load->view('view',$data);
    }
}