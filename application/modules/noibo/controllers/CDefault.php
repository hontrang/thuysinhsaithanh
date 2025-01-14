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
 * Class noibot
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        //$this->load->model('Mnoibo');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");
		
		if($this->session->userdata("userid") == "")
			$page_html = "login";
		else
			$page_html ="index";

        $this->config->load('pagination');
        $config['base_url'] = site_url().'tin-noi-bo/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'noibo');
        $config['per_page'] = 6;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'noibo',$config['per_page'],$start,"is_hot DESC, id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list_item'] = $list_item;


        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("noibo") => '',

        ];


        $scripts[] = '';

        //banner
        $banner = $this->MCommon->getRow_lang($lang,'noibo_cat',null,"orders ASC");
        if($banner)
            $data['bannerimage'] = $banner->image;
        //template
        $data['title'] = $this->lang->line("noibo");
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;

        $data['module'] = $this->router->fetch_module();
        $data['method'] = $page_html;
        echo modules::run('template/getlayout/user', $data);
    }

    public function listbycat(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");
		
		if($this->session->userdata("userid") == "")
			$page_html = "login";
		else
			$page_html ="index";

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $check = $this->MCommon->getRow('noibo_cat',['slug'=>$slug]);
        if(!$check)
            redirect(site_url(),'refresh');

        $cat = $this->MCommon->getRow_lang($lang,'noibo_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'tin-noi-bo/'.$slug.'/';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'noibo',['cat_id'=>$cat->id]);
        }
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'noibo_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'noibo','cat_id',$ids);

        }

        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        if($cat->parent_id != "0")
            $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'noibo',$config['per_page'],$start,"is_hot DESC, id DESC",['cat_id'=>$cat->id]);
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'noibo_cat',['parent_id'=>$cat->id]);
            if($get_sub){

                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }

            $list_item = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'noibo',$config['per_page'],$start,"is_hot DESC, id DESC",'cat_id',$ids);

        }

        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list_item'] = $list_item;



        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->id;

        $data['current_parent_id'] = $current_parent_id;

        $data['current_slug'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("noibo") => 'tin-noi-bo',
            $cat->name => '',

        ];

        $scripts[] = '';

        $data['info'] = json_decode(json_encode(['banner'=>$cat->image]));

        //template
        $data['title'] = $cat->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $page_html;
        echo modules::run('template/getlayout/user', $data);
    }

	public function view(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");
		
		if($this->session->userdata("userid") == "")
			$page_html = "login";
		else
			$page_html ="view";

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);
        $check = $this->MCommon->getRow('noibo',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $noibo = $this->MCommon->getRow_lang($lang,'noibo',['id'=>$id]);
        if(!$noibo)
            redirect(site_url(),'refresh');


        //cat
        $cat = $this->MCommon->getRow_lang($lang,'noibo_cat',['id'=>$noibo->cat_id]);
        if($cat)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$noibo->view+1],'noibo',['id'=>$noibo->id]);


        //lien quan
        $related = $this->MCommon->getAllRowByWhere_lang($lang,'noibo',['id<>'=>$noibo->id],8,'id DESC');
        if($related)
            $data['related'] = $related;

        //hot
        $hot = $this->MCommon->getAllRowByWhere_lang($lang,'noibo',null,8,'view DESC');
        if($hot)
            $data['hot'] = $hot;

        $data['current_parent_id'] = $cat->id;
        $noibo->banner = new stdClass();
        $noibo->banner = $cat->image;
        $data['info'] = $noibo;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("noibo") => 'tin-noi-bo',
            $cat->name => '/tin-noi-bo/'.$cat->slug,
            max_len($noibo->name,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $noibo->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['bannerimage'] = $cat->image;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $page_html;
        echo modules::run('template/getlayout/user', $data);
    }
	
	
	public function download(){

		if($this->session->userdata("userid") == "")
			redirect('tin-noi-bo','refresh');
		
		$id = (int)$this->uri->segment(3);
        $check = $this->MCommon->getRow('noibo',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');
		
		$file_url = 'public/userfiles/'.$check->file;
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
		
		exit;
	}
}
