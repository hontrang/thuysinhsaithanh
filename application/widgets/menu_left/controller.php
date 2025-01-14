<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu_left_widget extends MY_Widget
{
    
    function index(){

        $list_cats = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>0]);
        if($list_cats){
            $i = 0;
            $cats = new stdClass();
            foreach ($list_cats as $item){
                $cats->{$i} = new stdClass();
                $cats->{$i} = $item;
                $sub = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$item->id]);
                if($sub){
                    $cats->{$i}->sub = new stdClass();
                    $cats->{$i}->sub = $sub;
                }
                $i++;
            }
            $data['cats'] = $cats;
        }


        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}