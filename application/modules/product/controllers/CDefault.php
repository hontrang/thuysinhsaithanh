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
 * Class productt
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MProduct');
        $this->load->model('MCommon');
    }

    public function ajax(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $cat_id = (int)$this->input->post('id_danhmuc');
        $page = (int)$this->input->post('page');

        $cat = $this->MCommon->getRow_lang($lang,'product_cat',['id'=>$cat_id]);
        if(!$cat)
            exit;

        $this->config->load('pagination');

        $config['base_url'] = '#';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'product',['cat_id'=>$cat->id,'hide'=>0]);
        }
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'product','cat_id',$ids,['hide'=>0]);

        }

        $config['per_page'] = 4;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $start = ($page-1)*$config['per_page'];

        if($cat->parent_id != "0")
            $list = $this->MCommon->getAllRowWithPage_lang($lang,'product',$config['per_page'],$start,"orders DESC",['cat_id'=>$cat->id,'hide'=>0]);
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>$cat->id]);
            if($get_sub){

                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }

            $list = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'product',$config['per_page'],$start,"orders DESC",'cat_id',$ids,['hide'=>0]);

        }

        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;




        //template

        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/ajax', $data);
    }

    public function index(){
		
		
		
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'san-pham/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'product',['hide'=>0]);
        $config['per_page'] = 16;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang($lang,'product',$config['per_page'],$start,"orders DESC, id DESC",['hide'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $data['current_parent_id'] = '';
        $data['current_slug'] = '';
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('product') => '',

        ];
		
		$brands = $this->MCommon->getAllRow('product_brand');
        if($brands)
            $data['brands'] = $brands;
		
		$sub = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>0],null,"orders ASC");
        if($sub)
            $data['sub'] = $sub;
		
		$product_hot = $this->MCommon->getAllRowByWhere_lang($lang,'product',['is_hot'=>1],8,'orders DESC, id DESC');
        if($product_hot){
            $data['product_hot'] = $product_hot;
        }
		
		$ads_left = $this->MCommon->getAllRowByWhere('ads',['position'=>'left'],null,'orders ASC, id ASC');
        if($ads_left){
            $data['ads_left'] = $ads_left;
        }


        $scripts[] = '';
        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = $this->lang->line('product');
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function brandby(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $brand = $this->MCommon->getRow('product_brand',['slug'=>$slug]);
        if(!$brand)
            redirect(site_url(),'refresh');

        $this->config->load('pagination');
        $config['base_url'] = site_url().'thuong-hieu/'.$slug.'/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'product',['brand_id'=>$brand->id,'hide'=>0]);
        $config['per_page'] = 16;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang($lang,'product',$config['per_page'],$start,"orders DESC,id DESC",['brand_id'=>$brand->id,'hide'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $data['current_parent_id'] = '';
        $data['current_slug'] = '';
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = '';

        //breadcrumbx
        $breadcrumb = [
            'Thương hiệu' => 'thuong-hieu',
            $brand->name => '',

        ];


        $scripts[] = '';
        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = "Các sản phẩm thương hiệu ".$brand->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'brandby';
        echo modules::run('template/getlayout/user', $data);
    }

    public function brand(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

       
        $this->config->load('pagination');
        $config['base_url'] = site_url().'thuong-hieu/';
        $config['total_rows'] = $this->MCommon->getTotalRow('product_brand',[]);
        $config['per_page'] = 50;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('product_brand',$config['per_page'],$start,"name ASC",[]);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $data['current_parent_id'] = '';
        $data['current_slug'] = '';
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = '';

        //breadcrumbx
        $breadcrumb = [
            'Thương hiệu' => '',

        ];
		
		


        $scripts[] = '';
        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = "Thương hiệu";
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'brand';
        echo modules::run('template/getlayout/user', $data);
    }

    public function listpromo(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'san-pham/khuyen-mai/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'product',['is_hot'=>1,'hide'=>0]);
        $config['per_page'] = 100;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang($lang,'product',$config['per_page'],$start,"orders DESC,id DESC",['is_hot'=>1,'hide'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $data['current_parent_id'] = '';
        $data['current_slug'] = '';
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('product') => 'san-pham',
            'Khuyến mãi' => '',

        ];
		
		$brands = $this->MCommon->getAllRow('product_brand');
        if($brands)
            $data['brands'] = $brands;
		
		$data['is_hot'] = 1;;

        $scripts[] = '';
        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = 'Các sản phẩm khuyến mãi';
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'index';
        echo modules::run('template/getlayout/user', $data);
    }

    public function listbycat(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $cat = $this->MCommon->getRow_lang($lang,'product_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'san-pham/'.$slug.'/';

        $ids = null;
        $ids[] = $cat->id;
        $get_sub = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$cat->id]);
        if($get_sub){
            foreach ($get_sub as $item){
                $ids[]=$item->id;
                $sub1s = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$item->id]);
                if($sub1s) {
                    foreach ($sub1s as $sub1) {
                        $ids[] = $sub1->id;
                        $sub2s = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$sub1->id]);
                        if($sub2s) {
                            foreach ($sub2s as $sub2) {
                                $ids[] = $sub2->id;

                            }
                        }
                    }
                }
            }
        }
        $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'product','cat_id',$ids,['hide'=>0]);

        $config['per_page'] = 16;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        $list = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'product',$config['per_page'],$start,"orders DESC, id DESC",'cat_id',$ids,['hide'=>0]);

        $pagination_link = $this->pagination->create_links();
        if($list)
            $data['list'] = $list;

        $data['cat'] = $cat;
        $data['cats'] = $ids;
        

        $brands = $this->MCommon->getBrandByCats($cat->id);
        if($brands)
            $data['brands'] = $brands;
        $properties = $this->MCommon->getAllRowByWhere('product_cat_properties',['product_cat_id'=>$cat->id],null,"properties_name ASC");
        if($properties)
            $data['properties'] = $properties;

        $sub = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>$cat->id],null,"orders ASC");
        if($sub)
            $data['sub'] = $sub;
		
		$product_hot = $this->MCommon->getAllRowByWhere_lang($lang,'product',['is_hot'=>1],8,'orders DESC, id DESC');
        if($product_hot){
            $data['product_hot'] = $product_hot;
        }
		
		$ads_left = $this->MCommon->getAllRowByWhere('ads',['position'=>'left'],null,'orders ASC, id ASC');
        if($ads_left){
            $data['ads_left'] = $ads_left;
        }


        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;
        $data['current_slug'] = $slug;
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = $slug;
		

        if($current_parent_id != 0)
			$scripts[] = '<script>openCat('.$current_parent_id.')</script>';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('product') => 'san-pham',
            $cat->name => '',

        ];

		//$data['image_share'] = base_url('public/userfiles/'.$cat->image);
        $data['description'] = max_len(strip_tags($cat->description),300);
		 $data['detail'] = $cat->detail;

        $scripts[] = '';

        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = $cat->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
	
	
	public function listbybrand(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $slug2 = $this->uri->segment(3);

        //kiem tra danh muc
        $cat = $this->MCommon->getRow_lang($lang,'product_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');
		
		$brand = $this->MCommon->getRow('product_brand',['slug'=>$slug2]);
        if(!$brand)
            redirect(site_url(),'refresh');
        


        $this->config->load('pagination');
        $config['base_url'] = site_url().'san-pham/'.$slug.'/'.$slug2.'/';

        $ids = null;
        $ids[] = $cat->id;
        $get_sub = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$cat->id]);
        if($get_sub){
            foreach ($get_sub as $item){
                $ids[]=$item->id;
                $sub1s = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$item->id]);
                if($sub1s) {
                    foreach ($sub1s as $sub1) {
                        $ids[] = $sub1->id;
                        $sub2s = $this->MCommon->getAllRowByWhere('product_cat',['parent_id'=>$sub1->id]);
                        if($sub2s) {
                            foreach ($sub2s as $sub2) {
                                $ids[] = $sub2->id;

                            }
                        }
                    }
                }
            }
        }
        $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'product','cat_id',$ids,['hide'=>0,'brand_id'=>$brand->id]);

        $config['per_page'] = 16;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        $list = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'product',$config['per_page'],$start,"orders DESC, id DESC",'cat_id',$ids,['hide'=>0,'brand_id'=>$brand->id]);

        $pagination_link = $this->pagination->create_links();
        if($list)
            $data['list'] = $list;

        $data['cat'] = $cat;
        $data['cats'] = $ids;
        $data['brand'] = $brand;
        

        $brands = $this->MCommon->getBrandByCats($cat->id);
        if($brands)
            $data['brands'] = $brands;
        $properties = $this->MCommon->getAllRowByWhere('product_cat_properties',['product_cat_id'=>$cat->id],null,"properties_name ASC");
        if($properties)
            $data['properties'] = $properties;
		
		$product_hot = $this->MCommon->getAllRowByWhere_lang($lang,'product',['is_hot'=>1],8,'orders DESC, id DESC');
        if($product_hot){
            $data['product_hot'] = $product_hot;
        }
		
		$ads_left = $this->MCommon->getAllRowByWhere('ads',['position'=>'left'],null,'orders ASC, id ASC');
        if($ads_left){
            $data['ads_left'] = $ads_left;
        }


        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;
        $data['current_slug'] = $slug;
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('product') => 'san-pham',
            $cat->name => '',
            $brand->name => '',

        ];

		//$data['image_share'] = base_url('public/userfiles/'.$cat->image);
        $data['description'] = max_len(strip_tags($cat->description),300);

        $scripts[] = '';

        $data['total_product'] = $config['total_rows'];

        //template
        $data['title'] = $cat->name." ". $brand->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'listbycat';
        echo modules::run('template/getlayout/user', $data);
    }

	public function view(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);

        $product = $this->MCommon->getRow_lang($lang,'product',['id'=>$id]);
        if(!$product)
            redirect(site_url(),'refresh');

        //image
        $images = $this->MCommon->getAllRowByWhere('product_image',['product_id'=>$product->id]);
        if($images)
            $data['images'] = $images;



        //cat
        $cat = $this->MCommon->getRow_lang($lang,'product_cat',['id'=>$product->cat_id]);
        if($cat)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$product->view+1],'product',['id'=>$product->id]);

        $data['info'] = $product;




        //cung danh muc
        $cat_relevant = $this->MCommon->getAllRowByWhere_lang($lang,'product',['cat_id'=>$cat->id,'id !='=>$id,'hide'=>0],10,"orders DESC, id DESC");
        if($cat_relevant)
            $data['cat_relevant'] = $cat_relevant;

        $product_hot = $this->MCommon->getAllRowByWhere_lang($lang,'product',['is_hot'=>1],8,'orders DESC, id DESC');
        if($product_hot){
            $data['product_hot'] = $product_hot;
        }
		
		$ads_left = $this->MCommon->getAllRowByWhere('ads',['position'=>'left'],null,'orders ASC, id ASC');
        if($ads_left){
            $data['ads_left'] = $ads_left;
        }

        $services = $this->MCommon->getAllRowByWhere_lang($lang,'services',[],null,'orders ASC, id ASC');
        if($services){
            $data['services'] = $services;
        }

        $chinhsach = $this->MCommon->getRow_lang($lang,'about',['id'=>15]);
        if($chinhsach)
            $data['chinhsach'] = $chinhsach;
		
		

        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;
        $data['current_slug'] = $cat->slug;
        $data['menu_tab'] = 'product';
        $data['sub_menu_tab'] = $cat->slug;


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('product') => 'san-pham',
            $cat->name => '/san-pham/'.$cat->slug,
            //$product->name => '',

        ];

        $scripts[] = '';

        //share

        $data['title'] = $product->title_seo!=''?$product->title_seo:$product->name;
        $data['description'] = $product->des_seo!=''?$product->des_seo:max_len(strip_tags ($product->description),300);
        $data['keyword'] = $product->keyword_seo!=''?$product->keyword_seo:'';
        //$data['image_share'] = (isset($product->image) and ($product->image!=''))?$product->image:'';
		$data['image_share'] = base_url('public/userfiles/'.$product->image);

        //template
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }


    public function search(){
		
        $q = $this->input->get('q');
        $view = $this->input->get('view');
        if($view == "json"){
			$repo = [];
            $list = $this->MProduct->searchProduct($q);
            if($list){
				$i = 0;
                foreach($list as $item){
					$repo[$i]['productName'] = $item->name;
					$repo[$i]['productUrl'] = '/san-pham/'.$item->slug.'-'.$item->id.'.html';
					$repo[$i]['productImage']['medium'] = thumb($item->image,'50x50');
					$repo[$i]['price'] = $item->price;
					$i++;
				}
            }
			echo json_encode($repo);
            exit;
        }
		
        $total_product = 0;
        $list = $this->MProduct->searchProduct($q);
        if($list){
            $data['list'] = $list;
            $total_product = count($list);
        }
        $data['total_product'] = $total_product;

        //breadcrumbx
        $breadcrumb = [
            'Sản phẩm' => 'san-pham',
            'Tìm kiếm' => '',
            $q => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = 'Tìm kiếm: '.$q;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }


    public function getProduct(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $page = (int)$this->input->post('page');
		if($page == 0)
			$page = 1;
        $cat_id = (int)$this->input->post('cat');
        $cats_id = $this->input->post('cats');
		if($cats_id != "")
			$cats_id = explode(",",$cats_id);
		else
			$cats_id = "";
		
		$is_hot = $this->input->post('is_hot');

        $brand = $this->input->post('brand');
        $sort = $this->input->post('sort');
        $filter = $this->input->post('filter');
		if($filter != ""){
			$filters = [];
			foreach($filter as $f){
				$t = [];
				$t = explode("-",$f);
				$check = $this->MCommon->getRow('product_properties',['product_properties_id'=>$t[0],'product_properties_value'=>$t[1]]);
				if($check)
					$filters[] = $check->sub_id;
			}
		}
		else{
			$filters = '';
		}
		

        
        $per_page = 16;
        $start = ($page-1)*$per_page;
        $totalRow = $this->MProduct->getTotalFilterProduct($lang,$cats_id,$start,$per_page,$brand,$sort,$filters,$is_hot);
		$totalpage = ceil($totalRow/$per_page);
        $list = $this->MProduct->getFilterProduct($lang,$cats_id,$start,$per_page,$brand,$sort,$filters,$is_hot);
        if($list){
            $data['list'] = $list;
			if($page >= $totalpage)
				$data['show_page'] = 0;
			else
				$data['show_page'] = 1;
        } 
        else
            $data['show_page'] = 0;

        $data['page'] = $page;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/ajax', $data);
    }

    public function _cURL($url,$postdata = '',$useragent='Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36'){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        if($postdata != ""){
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            "user-agent: ".$useragent
        ));
        
        $repo = curl_exec($ch);
        return $repo;
    }

    public function download($link,$path,$filename,$ext){
        @mkdir($path);
        $fullpath = $path.$filename.".".$ext;
        if(file_exists($fullpath)){
            return true;
            //unlink($fullpath);

            $fullpath = $path.time()."-".$filename.".".$ext;
        }

        $ch = curl_init ($link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        $rawdata=curl_exec($ch);
        curl_close ($ch);
        
        $fp = fopen($fullpath,'x');
        fwrite($fp, $rawdata);
        fclose($fp);
    }

    public function mime_content_type($file) {
        if (function_exists('mime_content_type')) {
            return mime_content_type($file);
        } else {
            $mime_types = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',

                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',

                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',

                // audio/video
                'mp3' => 'audio/mpeg',
                'mp4' => 'video/mp4',
                'webM' => 'video/webm',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',

                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',

                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',

                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
            $ext = strtolower(array_pop(explode('.', $file)));

            if (array_key_exists($ext, $mime_types)) {
                return $mime_types[$ext];
            } elseif (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME);
                $mimetype = finfo_file($finfo, $file);
                finfo_close($finfo);
                return $mimetype;
            } else {
                return 'application/octet-stream';
            }
        }
    }

    public function getSP(){
        exit;
        $this->load->library("simple_html_dom");
        $parent_cat = 30;
        $url="https://vuabonnuoc.com/danh-muc/thiet-bi-ve-sinh/";
        $page = $this->_cURL($url);
        $html = new simple_html_dom();
        $html->load($page);
        $list = $html->find('div[class=product-type-simple]');
        foreach($list as $item){
            $name = trim($item->find('p[class=product-title] a',0)->plaintext);
            $name_slug = create_slug($name);
            echo $name_slug." \n";
            //echo $url_p = trim($item->find('p[class=product-title] a',0)->href)." \n"." \n";
            
            $image = $item->find('div[class=box-image] img',1)->src;
            $image = str_replace("-500x500","",$image);

            @mkdir('public/userfiles/product');
            @mkdir('public/userfiles/product/'.$name_slug);
            $file_ext = pathinfo($image, PATHINFO_EXTENSION); // to get extension
            $file_name =create_slug(pathinfo($image, PATHINFO_FILENAME)); //file name without extension
            $this->download($image,'public/userfiles/product/'.$name_slug.'/',$file_name,$file_ext);
            $product_image = 'product/'.$name_slug.'/'.$file_name.".".$file_ext;
            
            
            
            $price_old = 0;
            $price = 0;
            //$price_old = (int)str_replace(",","",str_replace("VNĐ","",trim($item->find('span[class=woocommerce-Price-amount]',0)->plaintext)));
            //$price = (int)str_replace(",","",str_replace("VNĐ","",trim($item->find('span[class=woocommerce-Price-amount]',1)->plaintext)));
            
            $url_p = trim($item->find('p[class=product-title] a',0)->href);
            
            if($url_p != ""){

                $page2 = $this->_cURL($url_p);
                $html2 = new simple_html_dom();
                $html2->load($page2);
                
                $detail = $html2->find('div[id=tab-description]',0)->innertext;
                $detail = str_replace("<noscript>","",$detail);
                $detail = str_replace("</noscript>","",$detail);

                $html3 = new simple_html_dom();
                $html3->load($detail);
                $image_detail = $html3->find('img');
                foreach($image_detail as $i){
                    $src = $i->src;
                    if($src == "data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20350%20350'%3E%3C/svg%3E"){
                        $i->outertext = "";
                    }
                }
                $detail = $html3->outertext;

                //$html2->find('div[id=Top2]',0)->find('div[id=Top2]',0)->outertext = "";

                $des = $html2->find('div[class=product-short-description]',0)->innertext;

                $brand = trim($html2->find('div[class=pwb-single-product-brands] a',0)->plaintext);
                $brand_slug = create_slug($brand);
                $check_brand = $this->MCommon->getRow('product_brand',['slug'=>$brand_slug]);
                if(!$check_brand){
                    $this->MCommon->insert(['slug'=>$brand_slug,'image'=>'','name'=>$brand],'product_brand');
                    $brand_id = $this->db->insert_id();
                }
                else{
                    $brand_id = $check_brand->id;
                }

                

                //tim và tao cat
                $bc = $html2->find('nav[class=woocommerce-breadcrumb] a');
                $i = 0;
                $top_cat = $parent_cat;
                foreach($bc as $c){
                    if($i > 0){
                        $cat_name = trim($c->plaintext);
                        $cat_name_slug = create_slug($cat_name);
                        $check = $this->MCommon->getRow_lang('vi','product_cat',['slug'=>$cat_name_slug]);
                        if(!$check){

                            
                            $this->MCommon->insert(['slug'=>$cat_name_slug,'image'=>'category/motor.png','parent_id'=>$top_cat],'product_cat');
                            $product_cat_id = $this->db->insert_id();
                            $this->MCommon->insert(['name'=>$cat_name,'record_id'=>$product_cat_id,'lang'=>'vi'],'product_cat_lang');
                            $top_cat = $product_cat_id;
                            
                        }
                        else{
                            $top_cat = $check->id;
                        }
                    }
                    $i++;
                }

                $cat_id = $top_cat;
              

                //insert product
                $data_db = null;
                $data_db['slug'] = create_slug($name);
                $data_db['price'] = $price;
                $data_db['price_old'] = $price_old;
                $data_db['cat_id'] = $cat_id;
                $data_db['image'] = $product_image;
                $data_db['brand_id'] = $brand_id;
                $this->MCommon->insert($data_db,'product');
                $product_id = $this->db->insert_id();

                $data_db_lang = null;
                $data_db_lang['record_id'] = $product_id;
                $data_db_lang['name'] = $name;
                $data_db_lang['description'] = $des;
                $data_db_lang['detail'] = $detail;
                $data_db_lang['lang'] = 'vi';
                $this->MCommon->insert($data_db_lang,'product_lang');


                //images
                $images = $html2->find('div[class=product-thumbnails] div[class=col] a noscript img');
                $i = 0;
                foreach($images as $ii){
                    if($i > 0){
                        $img = $ii->src;
                        $img = str_replace("-500x500","",$img);

                        @mkdir('public/userfiles/product_image');
                        @mkdir('public/userfiles/product_image/'.$product_id);
                        $file_ext = pathinfo($img, PATHINFO_EXTENSION); // to get extension
                        $file_name =create_slug(pathinfo($img, PATHINFO_FILENAME)); //file name without extension
                        $this->download($img,'public/userfiles/product_image/'.$product_id.'/',$file_name,$file_ext);
                        $product_image = 'product_image/'.$product_id.'/'.$file_name.".".$file_ext;
                        $data_db_image['name'] = $file_name.".".$file_ext;

                        $data_db_image = null;
                        $data_db_image['size'] = @filesize('public/userfiles/product_image/'.$product_id.'/'.$file_name.".".$file_ext);
                        $data_db_image['type'] = $this->mime_content_type('public/userfiles/product_image/'.$product_id.'/'.$file_name.".".$file_ext);
                        $data_db_image['image'] = $product_image;
                        $data_db_image['product_id'] = $product_id;
                        $this->MCommon->insert($data_db_image,'product_image');

                    }
                    $i++;
                }



            }
            else{
                echo "error";
                exit;
            }

            
           
        }
    }
    public function remove_emoji($text){
        return preg_replace('/[\x{1F3F4}](?:\x{E0067}\x{E0062}\x{E0077}\x{E006C}\x{E0073}\x{E007F})|[\x{1F3F4}](?:\x{E0067}\x{E0062}\x{E0073}\x{E0063}\x{E0074}\x{E007F})|[\x{1F3F4}](?:\x{E0067}\x{E0062}\x{E0065}\x{E006E}\x{E0067}\x{E007F})|[\x{1F3F4}](?:\x{200D}\x{2620}\x{FE0F})|[\x{1F3F3}](?:\x{FE0F}\x{200D}\x{1F308})|[\x{0023}\x{002A}\x{0030}\x{0031}\x{0032}\x{0033}\x{0034}\x{0035}\x{0036}\x{0037}\x{0038}\x{0039}](?:\x{FE0F}\x{20E3})|[\x{1F441}](?:\x{FE0F}\x{200D}\x{1F5E8}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F467}\x{200D}\x{1F467})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F467}\x{200D}\x{1F466})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F467})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F466}\x{200D}\x{1F466})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F466})|[\x{1F468}](?:\x{200D}\x{1F468}\x{200D}\x{1F467}\x{200D}\x{1F467})|[\x{1F468}](?:\x{200D}\x{1F468}\x{200D}\x{1F466}\x{200D}\x{1F466})|[\x{1F468}](?:\x{200D}\x{1F468}\x{200D}\x{1F467}\x{200D}\x{1F466})|[\x{1F468}](?:\x{200D}\x{1F468}\x{200D}\x{1F467})|[\x{1F468}](?:\x{200D}\x{1F468}\x{200D}\x{1F466})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F469}\x{200D}\x{1F467}\x{200D}\x{1F467})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F469}\x{200D}\x{1F466}\x{200D}\x{1F466})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F469}\x{200D}\x{1F467}\x{200D}\x{1F466})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F469}\x{200D}\x{1F467})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F469}\x{200D}\x{1F466})|[\x{1F469}](?:\x{200D}\x{2764}\x{FE0F}\x{200D}\x{1F469})|[\x{1F469}\x{1F468}](?:\x{200D}\x{2764}\x{FE0F}\x{200D}\x{1F468})|[\x{1F469}](?:\x{200D}\x{2764}\x{FE0F}\x{200D}\x{1F48B}\x{200D}\x{1F469})|[\x{1F469}\x{1F468}](?:\x{200D}\x{2764}\x{FE0F}\x{200D}\x{1F48B}\x{200D}\x{1F468})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F9B3})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F9B2})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F9B1})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F9B0})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F9B0})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F9B0})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F9B0})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F9B0})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F9B0})|[\x{1F575}\x{1F3CC}\x{26F9}\x{1F3CB}](?:\x{FE0F}\x{200D}\x{2640}\x{FE0F})|[\x{1F575}\x{1F3CC}\x{26F9}\x{1F3CB}](?:\x{FE0F}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FF}\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FE}\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FD}\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FC}\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FB}\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F9B8}\x{1F9B9}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F9DE}\x{1F9DF}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F46F}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93C}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{200D}\x{2640}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FF}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FE}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FD}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FC}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{1F3FB}\x{200D}\x{2642}\x{FE0F})|[\x{1F46E}\x{1F9B8}\x{1F9B9}\x{1F482}\x{1F477}\x{1F473}\x{1F471}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F9DE}\x{1F9DF}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F46F}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93C}\x{1F93D}\x{1F93E}\x{1F939}](?:\x{200D}\x{2642}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F692})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F680})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{200D}\x{2708}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F3A8})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F3A4})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F4BB})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F52C})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F4BC})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F3ED})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F527})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F373})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F33E})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{200D}\x{2696}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F3EB})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{200D}\x{1F393})|[\x{1F468}\x{1F469}](?:\x{1F3FF}\x{200D}\x{2695}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FE}\x{200D}\x{2695}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FD}\x{200D}\x{2695}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FC}\x{200D}\x{2695}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{1F3FB}\x{200D}\x{2695}\x{FE0F})|[\x{1F468}\x{1F469}](?:\x{200D}\x{2695}\x{FE0F})|[\x{1F476}\x{1F9D2}\x{1F466}\x{1F467}\x{1F9D1}\x{1F468}\x{1F469}\x{1F9D3}\x{1F474}\x{1F475}\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F934}\x{1F478}\x{1F473}\x{1F472}\x{1F9D5}\x{1F9D4}\x{1F471}\x{1F935}\x{1F470}\x{1F930}\x{1F931}\x{1F47C}\x{1F385}\x{1F936}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F483}\x{1F57A}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F6C0}\x{1F6CC}\x{1F574}\x{1F3C7}\x{1F3C2}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}\x{1F933}\x{1F4AA}\x{1F9B5}\x{1F9B6}\x{1F448}\x{1F449}\x{261D}\x{1F446}\x{1F595}\x{1F447}\x{270C}\x{1F91E}\x{1F596}\x{1F918}\x{1F919}\x{1F590}\x{270B}\x{1F44C}\x{1F44D}\x{1F44E}\x{270A}\x{1F44A}\x{1F91B}\x{1F91C}\x{1F91A}\x{1F44B}\x{1F91F}\x{270D}\x{1F44F}\x{1F450}\x{1F64C}\x{1F932}\x{1F64F}\x{1F485}\x{1F442}\x{1F443}](?:\x{1F3FF})|[\x{1F476}\x{1F9D2}\x{1F466}\x{1F467}\x{1F9D1}\x{1F468}\x{1F469}\x{1F9D3}\x{1F474}\x{1F475}\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F934}\x{1F478}\x{1F473}\x{1F472}\x{1F9D5}\x{1F9D4}\x{1F471}\x{1F935}\x{1F470}\x{1F930}\x{1F931}\x{1F47C}\x{1F385}\x{1F936}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F483}\x{1F57A}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F6C0}\x{1F6CC}\x{1F574}\x{1F3C7}\x{1F3C2}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}\x{1F933}\x{1F4AA}\x{1F9B5}\x{1F9B6}\x{1F448}\x{1F449}\x{261D}\x{1F446}\x{1F595}\x{1F447}\x{270C}\x{1F91E}\x{1F596}\x{1F918}\x{1F919}\x{1F590}\x{270B}\x{1F44C}\x{1F44D}\x{1F44E}\x{270A}\x{1F44A}\x{1F91B}\x{1F91C}\x{1F91A}\x{1F44B}\x{1F91F}\x{270D}\x{1F44F}\x{1F450}\x{1F64C}\x{1F932}\x{1F64F}\x{1F485}\x{1F442}\x{1F443}](?:\x{1F3FE})|[\x{1F476}\x{1F9D2}\x{1F466}\x{1F467}\x{1F9D1}\x{1F468}\x{1F469}\x{1F9D3}\x{1F474}\x{1F475}\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F934}\x{1F478}\x{1F473}\x{1F472}\x{1F9D5}\x{1F9D4}\x{1F471}\x{1F935}\x{1F470}\x{1F930}\x{1F931}\x{1F47C}\x{1F385}\x{1F936}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F483}\x{1F57A}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F6C0}\x{1F6CC}\x{1F574}\x{1F3C7}\x{1F3C2}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}\x{1F933}\x{1F4AA}\x{1F9B5}\x{1F9B6}\x{1F448}\x{1F449}\x{261D}\x{1F446}\x{1F595}\x{1F447}\x{270C}\x{1F91E}\x{1F596}\x{1F918}\x{1F919}\x{1F590}\x{270B}\x{1F44C}\x{1F44D}\x{1F44E}\x{270A}\x{1F44A}\x{1F91B}\x{1F91C}\x{1F91A}\x{1F44B}\x{1F91F}\x{270D}\x{1F44F}\x{1F450}\x{1F64C}\x{1F932}\x{1F64F}\x{1F485}\x{1F442}\x{1F443}](?:\x{1F3FD})|[\x{1F476}\x{1F9D2}\x{1F466}\x{1F467}\x{1F9D1}\x{1F468}\x{1F469}\x{1F9D3}\x{1F474}\x{1F475}\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F934}\x{1F478}\x{1F473}\x{1F472}\x{1F9D5}\x{1F9D4}\x{1F471}\x{1F935}\x{1F470}\x{1F930}\x{1F931}\x{1F47C}\x{1F385}\x{1F936}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F483}\x{1F57A}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F6C0}\x{1F6CC}\x{1F574}\x{1F3C7}\x{1F3C2}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}\x{1F933}\x{1F4AA}\x{1F9B5}\x{1F9B6}\x{1F448}\x{1F449}\x{261D}\x{1F446}\x{1F595}\x{1F447}\x{270C}\x{1F91E}\x{1F596}\x{1F918}\x{1F919}\x{1F590}\x{270B}\x{1F44C}\x{1F44D}\x{1F44E}\x{270A}\x{1F44A}\x{1F91B}\x{1F91C}\x{1F91A}\x{1F44B}\x{1F91F}\x{270D}\x{1F44F}\x{1F450}\x{1F64C}\x{1F932}\x{1F64F}\x{1F485}\x{1F442}\x{1F443}](?:\x{1F3FC})|[\x{1F476}\x{1F9D2}\x{1F466}\x{1F467}\x{1F9D1}\x{1F468}\x{1F469}\x{1F9D3}\x{1F474}\x{1F475}\x{1F46E}\x{1F575}\x{1F482}\x{1F477}\x{1F934}\x{1F478}\x{1F473}\x{1F472}\x{1F9D5}\x{1F9D4}\x{1F471}\x{1F935}\x{1F470}\x{1F930}\x{1F931}\x{1F47C}\x{1F385}\x{1F936}\x{1F9D9}\x{1F9DA}\x{1F9DB}\x{1F9DC}\x{1F9DD}\x{1F64D}\x{1F64E}\x{1F645}\x{1F646}\x{1F481}\x{1F64B}\x{1F647}\x{1F926}\x{1F937}\x{1F486}\x{1F487}\x{1F6B6}\x{1F3C3}\x{1F483}\x{1F57A}\x{1F9D6}\x{1F9D7}\x{1F9D8}\x{1F6C0}\x{1F6CC}\x{1F574}\x{1F3C7}\x{1F3C2}\x{1F3CC}\x{1F3C4}\x{1F6A3}\x{1F3CA}\x{26F9}\x{1F3CB}\x{1F6B4}\x{1F6B5}\x{1F938}\x{1F93D}\x{1F93E}\x{1F939}\x{1F933}\x{1F4AA}\x{1F9B5}\x{1F9B6}\x{1F448}\x{1F449}\x{261D}\x{1F446}\x{1F595}\x{1F447}\x{270C}\x{1F91E}\x{1F596}\x{1F918}\x{1F919}\x{1F590}\x{270B}\x{1F44C}\x{1F44D}\x{1F44E}\x{270A}\x{1F44A}\x{1F91B}\x{1F91C}\x{1F91A}\x{1F44B}\x{1F91F}\x{270D}\x{1F44F}\x{1F450}\x{1F64C}\x{1F932}\x{1F64F}\x{1F485}\x{1F442}\x{1F443}](?:\x{1F3FB})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1E9}\x{1F1F0}\x{1F1F2}\x{1F1F3}\x{1F1F8}\x{1F1F9}\x{1F1FA}](?:\x{1F1FF})|[\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1F0}\x{1F1F1}\x{1F1F2}\x{1F1F5}\x{1F1F8}\x{1F1FA}](?:\x{1F1FE})|[\x{1F1E6}\x{1F1E8}\x{1F1F2}\x{1F1F8}](?:\x{1F1FD})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1F0}\x{1F1F2}\x{1F1F5}\x{1F1F7}\x{1F1F9}\x{1F1FF}](?:\x{1F1FC})|[\x{1F1E7}\x{1F1E8}\x{1F1F1}\x{1F1F2}\x{1F1F8}\x{1F1F9}](?:\x{1F1FB})|[\x{1F1E6}\x{1F1E8}\x{1F1EA}\x{1F1EC}\x{1F1ED}\x{1F1F1}\x{1F1F2}\x{1F1F3}\x{1F1F7}\x{1F1FB}](?:\x{1F1FA})|[\x{1F1E6}\x{1F1E7}\x{1F1EA}\x{1F1EC}\x{1F1ED}\x{1F1EE}\x{1F1F1}\x{1F1F2}\x{1F1F5}\x{1F1F8}\x{1F1F9}\x{1F1FE}](?:\x{1F1F9})|[\x{1F1E6}\x{1F1E7}\x{1F1EA}\x{1F1EC}\x{1F1EE}\x{1F1F1}\x{1F1F2}\x{1F1F5}\x{1F1F7}\x{1F1F8}\x{1F1FA}\x{1F1FC}](?:\x{1F1F8})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EA}\x{1F1EB}\x{1F1EC}\x{1F1ED}\x{1F1EE}\x{1F1F0}\x{1F1F1}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F8}\x{1F1F9}](?:\x{1F1F7})|[\x{1F1E6}\x{1F1E7}\x{1F1EC}\x{1F1EE}\x{1F1F2}](?:\x{1F1F6})|[\x{1F1E8}\x{1F1EC}\x{1F1EF}\x{1F1F0}\x{1F1F2}\x{1F1F3}](?:\x{1F1F5})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1E9}\x{1F1EB}\x{1F1EE}\x{1F1EF}\x{1F1F2}\x{1F1F3}\x{1F1F7}\x{1F1F8}\x{1F1F9}](?:\x{1F1F4})|[\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1ED}\x{1F1EE}\x{1F1F0}\x{1F1F2}\x{1F1F5}\x{1F1F8}\x{1F1F9}\x{1F1FA}\x{1F1FB}](?:\x{1F1F3})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1E9}\x{1F1EB}\x{1F1EC}\x{1F1ED}\x{1F1EE}\x{1F1EF}\x{1F1F0}\x{1F1F2}\x{1F1F4}\x{1F1F5}\x{1F1F8}\x{1F1F9}\x{1F1FA}\x{1F1FF}](?:\x{1F1F2})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1EE}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F8}\x{1F1F9}](?:\x{1F1F1})|[\x{1F1E8}\x{1F1E9}\x{1F1EB}\x{1F1ED}\x{1F1F1}\x{1F1F2}\x{1F1F5}\x{1F1F8}\x{1F1F9}\x{1F1FD}](?:\x{1F1F0})|[\x{1F1E7}\x{1F1E9}\x{1F1EB}\x{1F1F8}\x{1F1F9}](?:\x{1F1EF})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EB}\x{1F1EC}\x{1F1F0}\x{1F1F1}\x{1F1F3}\x{1F1F8}\x{1F1FB}](?:\x{1F1EE})|[\x{1F1E7}\x{1F1E8}\x{1F1EA}\x{1F1EC}\x{1F1F0}\x{1F1F2}\x{1F1F5}\x{1F1F8}\x{1F1F9}](?:\x{1F1ED})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1E9}\x{1F1EA}\x{1F1EC}\x{1F1F0}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F8}\x{1F1F9}\x{1F1FA}\x{1F1FB}](?:\x{1F1EC})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F9}\x{1F1FC}](?:\x{1F1EB})|[\x{1F1E6}\x{1F1E7}\x{1F1E9}\x{1F1EA}\x{1F1EC}\x{1F1EE}\x{1F1EF}\x{1F1F0}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F7}\x{1F1F8}\x{1F1FB}\x{1F1FE}](?:\x{1F1EA})|[\x{1F1E6}\x{1F1E7}\x{1F1E8}\x{1F1EC}\x{1F1EE}\x{1F1F2}\x{1F1F8}\x{1F1F9}](?:\x{1F1E9})|[\x{1F1E6}\x{1F1E8}\x{1F1EA}\x{1F1EE}\x{1F1F1}\x{1F1F2}\x{1F1F3}\x{1F1F8}\x{1F1F9}\x{1F1FB}](?:\x{1F1E8})|[\x{1F1E7}\x{1F1EC}\x{1F1F1}\x{1F1F8}](?:\x{1F1E7})|[\x{1F1E7}\x{1F1E8}\x{1F1EA}\x{1F1EC}\x{1F1F1}\x{1F1F2}\x{1F1F3}\x{1F1F5}\x{1F1F6}\x{1F1F8}\x{1F1F9}\x{1F1FA}\x{1F1FB}\x{1F1FF}](?:\x{1F1E6})|[\x{00A9}\x{00AE}\x{203C}\x{2049}\x{2122}\x{2139}\x{2194}-\x{2199}\x{21A9}-\x{21AA}\x{231A}-\x{231B}\x{2328}\x{23CF}\x{23E9}-\x{23F3}\x{23F8}-\x{23FA}\x{24C2}\x{25AA}-\x{25AB}\x{25B6}\x{25C0}\x{25FB}-\x{25FE}\x{2600}-\x{2604}\x{260E}\x{2611}\x{2614}-\x{2615}\x{2618}\x{261D}\x{2620}\x{2622}-\x{2623}\x{2626}\x{262A}\x{262E}-\x{262F}\x{2638}-\x{263A}\x{2640}\x{2642}\x{2648}-\x{2653}\x{2660}\x{2663}\x{2665}-\x{2666}\x{2668}\x{267B}\x{267E}-\x{267F}\x{2692}-\x{2697}\x{2699}\x{269B}-\x{269C}\x{26A0}-\x{26A1}\x{26AA}-\x{26AB}\x{26B0}-\x{26B1}\x{26BD}-\x{26BE}\x{26C4}-\x{26C5}\x{26C8}\x{26CE}-\x{26CF}\x{26D1}\x{26D3}-\x{26D4}\x{26E9}-\x{26EA}\x{26F0}-\x{26F5}\x{26F7}-\x{26FA}\x{26FD}\x{2702}\x{2705}\x{2708}-\x{270D}\x{270F}\x{2712}\x{2714}\x{2716}\x{271D}\x{2721}\x{2728}\x{2733}-\x{2734}\x{2744}\x{2747}\x{274C}\x{274E}\x{2753}-\x{2755}\x{2757}\x{2763}-\x{2764}\x{2795}-\x{2797}\x{27A1}\x{27B0}\x{27BF}\x{2934}-\x{2935}\x{2B05}-\x{2B07}\x{2B1B}-\x{2B1C}\x{2B50}\x{2B55}\x{3030}\x{303D}\x{3297}\x{3299}\x{1F004}\x{1F0CF}\x{1F170}-\x{1F171}\x{1F17E}-\x{1F17F}\x{1F18E}\x{1F191}-\x{1F19A}\x{1F201}-\x{1F202}\x{1F21A}\x{1F22F}\x{1F232}-\x{1F23A}\x{1F250}-\x{1F251}\x{1F300}-\x{1F321}\x{1F324}-\x{1F393}\x{1F396}-\x{1F397}\x{1F399}-\x{1F39B}\x{1F39E}-\x{1F3F0}\x{1F3F3}-\x{1F3F5}\x{1F3F7}-\x{1F3FA}\x{1F400}-\x{1F4FD}\x{1F4FF}-\x{1F53D}\x{1F549}-\x{1F54E}\x{1F550}-\x{1F567}\x{1F56F}-\x{1F570}\x{1F573}-\x{1F57A}\x{1F587}\x{1F58A}-\x{1F58D}\x{1F590}\x{1F595}-\x{1F596}\x{1F5A4}-\x{1F5A5}\x{1F5A8}\x{1F5B1}-\x{1F5B2}\x{1F5BC}\x{1F5C2}-\x{1F5C4}\x{1F5D1}-\x{1F5D3}\x{1F5DC}-\x{1F5DE}\x{1F5E1}\x{1F5E3}\x{1F5E8}\x{1F5EF}\x{1F5F3}\x{1F5FA}-\x{1F64F}\x{1F680}-\x{1F6C5}\x{1F6CB}-\x{1F6D2}\x{1F6E0}-\x{1F6E5}\x{1F6E9}\x{1F6EB}-\x{1F6EC}\x{1F6F0}\x{1F6F3}-\x{1F6F9}\x{1F910}-\x{1F93A}\x{1F93C}-\x{1F93E}\x{1F940}-\x{1F945}\x{1F947}-\x{1F970}\x{1F973}-\x{1F976}\x{1F97A}\x{1F97C}-\x{1F9A2}\x{1F9B0}-\x{1F9B9}\x{1F9C0}-\x{1F9C2}\x{1F9D0}-\x{1F9FF}]/u', '', $text);
  }

    public function updatedes($url){
        $this->load->library("simple_html_dom");
        $parent_cat = 30;
        $page = $this->_cURL($url);
        $html = new simple_html_dom();
        $html->load($page);
        $list = $html->find('div[class=product-type-simple]');
        foreach($list as $item){
            $name = trim($item->find('p[class=product-title] a',0)->plaintext);
            $name_slug = create_slug($name);
            echo $name_slug."\n";
            $url_p = trim($item->find('p[class=product-title] a',0)->href);
            
            if($url_p != ""){

                $page2 = $this->_cURL($url_p);
                $html2 = new simple_html_dom();
                $html2->load($page2);

                $des = $html2->find('div[class=product-short-description]',0)->innertext;
                $des = $this->remove_emoji($des);
                
                $html3 = new simple_html_dom();
                $html3->load($des);
                if(isset($html3->find('div[class=row]',0)->outertext))
                    $html3->find('div[class=row]',0)->outertext = '';

                $des = $html3->outertext;
                $des = str_replace("GỌI ĐẶT HÀNG NHANH: 0899.177.899","",$des);
               
                $check = $this->MCommon->getRow('product',['slug'=>$name_slug]);
                if($check){
                    if($this->MCommon->update(['description'=>$des],'product_lang',['record_id'=>$check->id]))
                        echo "OK \n";
                    else
                        echo "ERROR \n";
                }
            }
            
        }
    }
    public function runupdatedes(){
        $this->updatedes("https://vuabonnuoc.com/danh-muc/bon-nuoc-inox/");
        $this->updatedes("https://vuabonnuoc.com/danh-muc/bon-nuoc-nhua/");
        $this->updatedes("https://vuabonnuoc.com/danh-muc/may-nuoc-nong-nang-luong-mat-troi/");
        $this->updatedes("https://vuabonnuoc.com/danh-muc/thiet-bi-ve-sinh/");
    }
	
	public function clean($str)
	{       
		$str = str_replace("\xc2\xa0", ' ', $str);
		return $str;
	}
	
	public function cleandetail(){
		$this->load->library("simple_html_dom");
		
		$list = $this->MCommon->getAllRowByWhere_lang('vi','product',[]);
		if($list)foreach($list as $item){
			$detail = $item->detail;
			
			$detail = str_replace("0899.177.899",'<a href="tel:0938872110">0938 872 110</a>',$detail);
			$detail = str_replace("Vua Bồn Nước",'<a href="https://phanphoibonnuoc.vn">Phân Phối Bồn Nước</a>',$detail);
			$detail = $this->clean($detail);
			$pattern = '/\s{2,}/m';
			$replace = '';
			$detail = preg_replace( $pattern, $replace,$detail );
			
			$detail = str_replace('<ul> <li><strong>Chủ Tài Khoản:</strong> CÔNG TY TNHH Đầu Tư &#8211; Thương mại &#8211; Dịch Vụ BAK</li> </ul>','<ul> <li><strong>Chủ Tài Khoản:</strong> Phạm Tấn Phát</li> </ul>',$detail);
			$detail = str_replace('<p><strong>1. Tài khoản Vietcombank:</strong> ‭0921000713022‬ Tại ngân hàng: Vietcombank Chi Nhánh Hồ Chí Minh</p>','<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Tài khoản Vietcombank Chi Nhánh Đồng Nai:</strong> 0121 001 335 396</p>',$detail);
			$detail = str_replace('<p><strong>2. Tài khoản ACB:</strong> 42688888 Tại ngân hàng ACB chi nhánh Hai Bà Trưng, Q1, Hồ Chí Minh</p>','<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. VietinBank Chi Nhánh KCN Biên Hòa:</strong> 10 800 51 68 956</p><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. ACB Chi Nhánh Đồng Nai:</strong> 29 65 39 69</p>',$detail);
			
			$html = new simple_html_dom();
			$html->load($detail);
			$imgs = $html->find('img[src^="data:image/svg+xml]');
			foreach($imgs as $img){
				$img->outertext = '';
			}
			
			$detail = $html->outertext;
			
			$this->MCommon->update(['detail'=>$detail],'product_lang',['record_id'=>$item->id]);
			//echo $detail;
			
			//exit;
		}
	}

}
