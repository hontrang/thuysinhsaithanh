<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Search_box_widget extends MY_Widget 
{
    function index(){
        $listtinhthanh = Modules::run('search/Ajax/getTinhThanh');
        $listcat = $this->MCommon->getAllRowByWhere('bds_cat',[],null,'orders ASC');
        if($listcat)
            $data['listcat'] = $listcat;
        $data['listtinhthanh'] = $listtinhthanh;
        $this->load->view('view',$data);
    }
}