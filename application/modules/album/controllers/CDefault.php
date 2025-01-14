<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 2:12 PM
 * Date: 9/15/17 3:05 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/30/17 2:35 PM
 * Date: 9/15/17 10:42 AM
 *
 */

/**
 * Class Cart
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MAlbum');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'thu-vien/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'album');
        $config['per_page'] = 100;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'album',$config['per_page'],$start,"orders DESC, id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list'] = $list_item;
		
		
		$cats = $this->MCommon->getAllRowByWhere_lang('vi','album_cat',[],null,"orders ASC");
		if($cats)
			$data['cats'] = $cats;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('album') => 'thu-vien',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $this->lang->line('album');
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
		$data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }


	public function view(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);

        $info = $this->MCommon->getRow_lang($lang,'album',['id'=>$id]);
        if(!$info)
            redirect(site_url(),'refresh');


        //update view
        $this->MCommon->update(['view'=>$info->view+1],'album',['id'=>$info->id]);

        $data['info'] = $info;



        //image
        $list_item = $this->MCommon->getAllRowByWhere('album_image',['album_id'=>$info->id],null,"LENGTH(title), title ASC");
        if($list_item)
            $data['list_item'] = $list_item;

        //cong trinh khac
        $related = $this->MCommon->getAllRowByWhere_lang($lang,'album',['id !='=>$id],4,'id DESC');
        if($related)
            $data['related'] = $related;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('album') => 'thu-vien',
            $info->name => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $info->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
