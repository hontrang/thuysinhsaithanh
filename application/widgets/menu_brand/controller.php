<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu_brand_widget extends MY_Widget
{
    
    function index(){

        $brands = $this->MCommon->getAllRowByWhere("product_brand",null,null,"name ASC");
        if($brands)
            $data['brands'] = $brands;


        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}