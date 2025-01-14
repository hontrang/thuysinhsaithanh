<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/31/17 10:38 AM
 * Date: 8/21/17 2:21 PM
 *
 */

/**
 * Class Cart
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CAdmin extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MBds');
        $this->load->model('MCommon');
        $this->load->model('auth/MAuth');
    }

    public function dstincho()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $set_type = "";


        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/user/dstincho';
        $config['total_rows'] = $this->MBds->getTotalRowListBDSduyet($set_type);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MBds->getListBDSduyet($set_type,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }


    public function dstin()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

       
        $set_type = "";


        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/user/dstin';
        $config['total_rows'] = $this->MBds->getTotalRowListBDS($set_type);
        $config['per_page'] = 2000;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MBds->getAllListBDS($config['per_page'],$start,$set_type);
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function duyettin()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id == 0)
            redirect('/admin','refresh');

        $this->MBds->duyettin($id);

        redirect('/admin/bds/dstin','refresh');
    }

    public function huyduyet()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id == 0)
            redirect('/admin','refresh');
        $this->MBds->huyduyet($id);

        redirect('/admin/bds/dstin','refresh');

    }

    public function xoatin()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id == 0)
            redirect('/admin','refresh');

		$this->MBds->xoatin($id);
		if($this->input->server('HTTP_REFERER') != "")
        {
            redirect($this->input->server('HTTP_REFERER'),'refresh');
        }
		else
			redirect('/admin/bds/dstin','refresh');

    }

    public function chitiettin()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $idbds = (int)$this->uri->segment(4);
        if($idbds == 0)
            redirect('/admin','refresh');

        $bds = $this->MBds->getBDSByID($idbds);
		


        if($bds)
            $data['bds'] = $bds;

        //get imgage
        if($bds){
            $images = $this->MBds->getImgBDSByID($idbds);
            $data['images'] = $images;
        }

        //vi tri ban do
        $map_lat = $bds->map_lat;
        $map_lng = $bds->map_lng;

        $listcat = $this->MCommon->getAllRowByWhere('bds_cat',[],null,'orders ASC');
        if($listcat)
            $data['listcat'] = $listcat;
		


        //custom script


        $scripts[] = '<script type="text/javascript" src="'.base_url('public/templates/user/hoinhadat/js/hnd.js').'"></script>';
        $scripts[] = '<script type="text/javascript" src="'.base_url('public/templates/user/hoinhadat/js/custom_map_need.js').'"></script>';
        $scripts[] = '<script>//showmap();</script>';
        $scripts[] = '<script>calPrice();</script>';

        //template
        $data['title'] = $bds->title;
        $data['map_lat'] = $map_lat;
        $data['map_lng'] = $map_lng;
        $data['scripts'] = $scripts;
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }
	
	public function setstatus(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		
        $type = (int)$this->input->get('type');
        $id = (int)$this->input->get('id');

        $this->MCommon->update(['vip_type'=>$type],'bds',['id'=>$id]);
		
        echo json_encode(['error'=>0]);
        exit;
    }
}
