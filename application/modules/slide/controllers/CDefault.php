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
        $this->load->model('MHotel');
        $this->load->model('MCommon');
    }

    public function index(){

        $this->config->load('pagination');
        $config['base_url'] = site_url().'khach-san/';
        $config['total_rows'] = $this->MCommon->getTotalRow('hotel');
        $config['per_page'] = 10;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('hotel',$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['hotels'] = $list;


        $list_cat = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            'Khách sạn' => '',

        ];


        $scripts[] = '';

        //template
        $data['title'] = 'Khách sạn';
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function listbycat(){

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $cat = $this->MCommon->getRow('hotel_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'khach-san/'.$slug.'/';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow('hotel',['cat_id'=>$cat->id]);
        }
        else{
            $get_sub = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                $ids = null;
                $ids[] = $cat->id;
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn('hotel','cat_id',$ids);

        }
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        if($cat->parent_id != "0")
            $list = $this->MCommon->getAllRowWithPage('hotel',$config['per_page'],$start,null,['cat_id'=>$cat->id]);
        else{
            $get_sub = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                $ids = null;
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            //print_r($ids);
            //exit;
            $list = $this->MCommon->getAllRowWithPageWhereIn('hotel',$config['per_page'],$start,null,'cat_id',$ids);

        }

        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['hotels'] = $list;



        $list_cat = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere('hotel_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        $current_parent_id = $cat->parent_id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;

        $data['current_slug'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            'Khách sạn' => '/khach-san',
            $cat->name => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $cat->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

	public function view(){

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);

        $hotel = $this->MCommon->getRow('hotel',['id'=>$id]);
        if(!$hotel)
            redirect(site_url(),'refresh');

        //image
        $images = $this->MCommon->getAllRowByWhere('hotel_image',['hotel_id'=>$hotel->id]);
        if($images)
            $data['images'] = $images;
        

        //cat
        $cat = $this->MCommon->getRow('hotel_cat',['id'=>$hotel->cat_id]);
        if($images)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$hotel->view+1],'hotel',['id'=>$hotel->id]);

        $data['info'] = $hotel;


        //cung danh muc
        $cat_relevant = $this->MCommon->getAllRowByWhere('hotel',['cat_id'=>$cat->id, 'id !='=>$hotel->id],3);
        if($cat_relevant)
            $data['cat_relevant'] = $cat_relevant;


        //breadcrumbx
        $breadcrumb = [
            'Khách sạn' => '/khach-san.html',
            $cat->name => '/khach-san/'.$cat->slug,
            max_len($hotel->name,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $hotel->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
