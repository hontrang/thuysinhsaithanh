<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/1/17 10:05 AM
 * Date: 8/21/17 1:49 PM
 *
 */

class CAdmin extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MHome');
        $this->load->model('MCommon');

    }

    public function index()
    {

        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);


        $listcontact = $this->MCommon->getAllRowByWhere('contact',['view'=>0],30,"id DESC");
        if($listcontact)
            $data['listcontact'] = $listcontact;
		
		
		$list = $this->MCommon->getAllRowWithPage('orders',20,0,"id DESC");
		if($list)
            $data['list'] = $list;

        //template
        $data['title'] = "Trang quản trị";
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

}
?>