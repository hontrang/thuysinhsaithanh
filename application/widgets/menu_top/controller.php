<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_top_widget extends MY_Widget
{

    function index(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $list_parent = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>0],9999,"orders ASC");

        if($list_parent){
            $list = new stdClass();
            $i = 0;
            foreach ($list_parent as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$parent->id],999,"orders ASC");
                if($sub){
                    $j = 0;
                    $list->{$i}->sub = new stdClass();
                    foreach ($sub as $sub_item){
                        $list->{$i}->sub->{$j} = new stdClass();
                        $list->{$i}->sub->{$j} = $sub_item;
                        $sub2 = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$sub_item->id],999,"orders ASC");
                        if($sub2){
                            $list->{$i}->sub->{$j}->sub = new stdClass();
                            $list->{$i}->sub->{$j}->sub = $sub2;
                        }
                        $j++;
                    }

                }
                $i++;
            }
            $data['menu_tops'] = (($list));
        }

        $product_cat_list = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>0],null,'orders ASC, id ASC');
        if($product_cat_list){
            $data['product_cats'] = $product_cat_list;
        }

        

        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}
