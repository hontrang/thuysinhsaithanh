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
 * Class newst
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MNews');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'tin-tuc/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'news');
        $config['per_page'] = 12;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'news',$config['per_page'],$start,"is_hot DESC, id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list'] = $list_item;


        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("news") => '',

        ];



        //hot
        $news_cat = $this->MCommon->getAllRowByWhere_lang($lang,'news_cat',null,null,'orders ASC');
        if($news_cat)
            $data['news_cat'] = $news_cat;


        $scripts[] = '';

        //banner
        $banner = $this->MCommon->getRow_lang($lang,'news_cat',null,"orders ASC");
        if($banner)
            $data['bannerimage'] = $banner->image;
        //template
        $data['title'] = $this->lang->line("news");
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;

        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function listbycat(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $check = $this->MCommon->getRow('news_cat',['slug'=>$slug]);
        if(!$check)
            redirect(site_url(),'refresh');

        $cat = $this->MCommon->getRow_lang($lang,'news_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'tin-tuc/'.$slug.'/';

        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'news',['cat_id'=>$cat->id]);

        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'news',$config['per_page'],$start,"is_hot DESC, id DESC",['cat_id'=>$cat->id]);

        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list'] = $list_item;


        $news_cat = $this->MCommon->getAllRowByWhere_lang($lang,'news_cat',null,null,'orders ASC');
        if($news_cat)
            $data['news_cat'] = $news_cat;


        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->id;

        $data['current_parent_id'] = $current_parent_id;

        $data['current_slug'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("news") => 'tin-tuc',
            $cat->name => '',

        ];

        //hot
        $hot = $this->MCommon->getAllRowByWhere_lang($lang,'news',null,8,'view DESC');
        if($hot)
            $data['hot'] = $hot;

        $scripts[] = '';

        $data['info'] = json_decode(json_encode(['banner'=>$cat->image]));

        //template
        $data['title'] = $cat->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'index';
        echo modules::run('template/getlayout/user', $data);
    }

	public function view(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);
        $check = $this->MCommon->getRow('news',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $news = $this->MCommon->getRow_lang($lang,'news',['id'=>$id]);
        if(!$news)
            redirect(site_url(),'refresh');


        //cat
        $cat = $this->MCommon->getRow_lang($lang,'news_cat',['id'=>$news->cat_id]);
        if($cat)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$news->view+1],'news',['id'=>$news->id]);


        $news_cat = $this->MCommon->getAllRowByWhere_lang($lang,'news_cat',null,null,'orders ASC');
        if($news_cat)
            $data['news_cat'] = $news_cat;

        $data['current_parent_id'] = $cat->id;
        $news->banner = new stdClass();
        $news->banner = $cat->image;
        $data['info'] = $news;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("news") => 'tin-tuc',
            $cat->name => '/tin-tuc/'.$cat->slug,
            max_len($news->name,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $news->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['bannerimage'] = $cat->image;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
