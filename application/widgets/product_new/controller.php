<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_new_widget extends MY_Widget
{
    function index(){
        $this->load->model('MCommon');

        $product_news = $this->MCommon->getAllRowByWhere_lang('vi','product',['hide'=>0],5,"id DESC");
        if($product_news)
            $data['product_news'] = $product_news;
        $data['a'] = 'a';
        $this->load->view('view',$data);
    }



}