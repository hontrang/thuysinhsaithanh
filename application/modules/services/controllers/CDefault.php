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
 * Class servicest
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->model('MServices');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'dich-vu/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'services');
        $config['per_page'] = 12;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'services',$config['per_page'],$start,"is_hot DESC, id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list'] = $list_item;


        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("services") => '',

        ];




        $scripts[] = '';


        //template
        $data['title'] = $this->lang->line("services");
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
        $check = $this->MCommon->getRow('services_cat',['slug'=>$slug]);
        if(!$check)
            redirect(site_url(),'refresh');

        $cat = $this->MCommon->getRow_lang($lang,'services_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'dich-vu/'.$slug.'/';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'services',['cat_id'=>$cat->id]);
        }
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'services_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'services','cat_id',$ids);

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
            $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'services',$config['per_page'],$start,"is_hot DESC, id DESC",['cat_id'=>$cat->id]);
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'services_cat',['parent_id'=>$cat->id]);
            if($get_sub){

                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }

            $list_item = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'services',$config['per_page'],$start,"is_hot DESC, id DESC",'cat_id',$ids);

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
            $this->lang->line("services") => 'dich-vu',
            $cat->name => '',

        ];

        //hot
        $hot = $this->MCommon->getAllRowByWhere_lang($lang,'services',null,8,'view DESC');
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
        $check = $this->MCommon->getRow('services',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $services = $this->MCommon->getRow_lang($lang,'services',['id'=>$id]);
        if(!$services)
            redirect(site_url(),'refresh');




        //update view
        $this->MCommon->update(['view'=>$services->view+1],'services',['id'=>$services->id]);


        //lien quan
        $related = $this->MCommon->getAllRowByWhere_lang($lang,'services',['id<>'=>$services->id],10,'id DESC');
        if($related)
            $data['related'] = $related;



        $data['current_parent_id'] = '';
        $data['info'] = $services;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("services") => 'dich-vu',
            max_len($services->name,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $services->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
