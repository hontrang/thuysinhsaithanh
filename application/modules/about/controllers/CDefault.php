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
        $this->load->model('MAbout');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'gioi-thieu/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'about');
        $config['per_page'] = 12;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'about',$config['per_page'],$start,"orders ASC");
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list'] = $list_item;


        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("about") => '',

        ];


        $scripts[] = '';

 
        //template
        $data['title'] = $this->lang->line("about");
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;

        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }


	public function view(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $info = $this->MCommon->getRow_lang($lang,'about',['slug'=>$slug]);
        if(!$info)
            redirect(site_url(),'refresh');


        //update view
        $this->MCommon->update(['view'=>$info->view+1],'about',['id'=>$info->id]);

        $data['info'] = $info;

        //list
        $list = $this->MCommon->getAllRow_lang($lang,'about',null,'orders ASC');
        if($list)
            $data['list'] = $list;

        //lien quan
        $related = $this->MCommon->getAllRowByWhere_lang($lang,'about',['id<>'=>$info->id],8,'orders DESC');
        if($related)
            $data['related'] = $related;

        //hot
        $hot = $this->MCommon->getAllRowByWhere_lang($lang,'about',null,8,'view DESC');
        if($hot)
            $data['hot'] = $hot;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("about") => '/gioi-thieu',
            $info->name => '',

        ];

        $data['current_parent_id'] = $info->id;

        $scripts[] = '';

        //template
        $data['title'] = $info->name;
        $data['scripts'] = $scripts;
        $data['bannerimage'] = $info->image;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
