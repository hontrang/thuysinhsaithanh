<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_left_menu_widget extends MY_Widget
{
    function index(){
        $this->load->model('MCommon');
        $lang = 'vi';
        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['product_cats'] = $list_new;
        }

        $data['a'] = 'a';
        $this->load->view('view',$data);
    }



}