<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/12/17 11:08 AM
 * Date: 8/4/17 9:16 AM
 *
 */

class Product_cat_box_widget extends MY_Widget
{
    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $cat_dongphucs = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>181749],null,"orders ASC");
        if($cat_dongphucs){
			$cats = new stdClass();
			$i = 0;
			foreach($cat_dongphucs as $cat_dongphuc){
				$cats->{$i} = $cat_dongphuc;
				$sub  = $this->getCatSub($cat_dongphuc->id);
				if($sub)
					$cats->{$i}->sub = $sub;
				
				$i++;
			}
			$data['product_cats'] = $cats;
		}

        $data['a'] = "a";
        $this->load->view('view',$data);
    }
	
	
	function getCatSub($parent_id){
		$subs = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$parent_id],null,"orders ASC");
		if($subs){
			$cats = new stdClass();
			$i = 0;
			foreach($subs as $cat){
				$cats->{$i} = $cat;
				$sub  = $this->getCatSub($cat->id);
				if($sub)
					$cats->{$i}->sub = $sub;
				$i++;
			}
			return $cats;;
		}
		else{
			return false;
		}
	}


}