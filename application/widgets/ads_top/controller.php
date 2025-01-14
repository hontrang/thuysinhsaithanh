<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ads_top_widget extends MY_Widget
{
    
    function index(){
        $this->load->model('MCommon');
        $data['a'] = '';
        $ads_tops = $this->MCommon->getAllRowByWhere('ads',['hide'=>0,'position'=>'top'],null,"orders DESC");
        if($ads_tops)
            $data['ads_tops'] = $ads_tops;

        $this->load->view('view',$data);
    }
}