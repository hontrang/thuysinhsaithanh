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
 * Class constructiont
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MConstruction');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'cong-trinh/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'construction',['hide'=>0]);
        $config['per_page'] = 12;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang($lang,'construction',$config['per_page'],$start,"orders DESC",['hide'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        $data['current_parent_id'] = '';
        $data['current_slug'] = '';
        $data['menu_tab'] = 'menu';
        $data['sub_menu_tab'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('construction') => '',

        ];


        $scripts[] = '';
        $data['total_construction'] = $config['total_rows'];

        //template
        $data['title'] = $this->lang->line('construction');
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
        $cat = $this->MCommon->getRow_lang($lang,'construction_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'cong-trinh/'.$slug.'/';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'construction',['cat_id'=>$cat->id,'hide'=>0]);
        }
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'construction','cat_id',$ids,['hide'=>0]);

        }

        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        if($cat->parent_id != "0")
            $list = $this->MCommon->getAllRowWithPage_lang($lang,'construction',$config['per_page'],$start,"orders DESC",['cat_id'=>$cat->id,'hide'=>0]);
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>$cat->id]);
            if($get_sub){

                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }

            $list = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'construction',$config['per_page'],$start,"orders DESC",'cat_id',$ids,['hide'=>0]);

        }

        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

		$data['cat'] = $cat;

        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }


        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;
        $data['current_slug'] = $slug;
        $data['menu_tab'] = 'menu';
        $data['sub_menu_tab'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('construction') => 'cong-trinh',
            $cat->name => '',

        ];
		
		$data['image_share'] = base_url('public/userfiles/'.$cat->image);
        $data['description'] = max_len(strip_tags($cat->description),300);

        $scripts[] = '';

        $data['total_construction'] = $config['total_rows'];

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
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);

        $construction = $this->MCommon->getRow_lang($lang,'construction',['id'=>$id]);
        if(!$construction)
            redirect(site_url(),'refresh');

        //image
        $images = $this->MCommon->getAllRowByWhere('construction_image',['construction_id'=>$construction->id]);
        if($images)
            $data['images'] = $images;

        

        //cat
        $cat = $this->MCommon->getRow_lang($lang,'construction_cat',['id'=>$construction->cat_id]);
        if($images)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$construction->view+1],'construction',['id'=>$construction->id]);

        $data['info'] = $construction;


        //cung danh muc
        $cat_relevant = $this->MCommon->getAllRowByWhere_lang($lang,'construction',['cat_id'=>$cat->id,'id !='=>$id],6);
        if($cat_relevant)
            $data['cat_relevant'] = $cat_relevant;


        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'construction_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        $current_parent_id = $cat->id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;
        $data['current_slug'] = $slug;
        $data['menu_tab'] = 'menu';
        $data['sub_menu_tab'] = $slug;
	

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('construction') => 'cong-trinh',
            $cat->name => '/cong-trinh/'.$cat->slug,
            $construction->name => '',

        ];

        $scripts[] = '';

        //share
        $data['image_share'] = base_url('public/userfiles/'.$construction->image);
        $data['url_share'] = site_url('cong-trinh/'.$construction->slug.'-'.$construction->id);
        $data['description'] = max_len($construction->detail,300);

        //template
        $data['title'] = $construction->name;
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
            $list = $this->Mconstruction->searchconstruction($q);
            if($list){
                echo '<div class="itemResults">';
                $i = 0;
                foreach ($list as $item){
                    echo '<div class="wrapItem clearfix">
                        <div class="pull-left image">
                            <a href="/cong-trinh/'.$item->slug.'-'.$item->id.'.html" title="'.$item->name.'">
                                <img alt="'.$item->name.'" src="'.base_url('public/userfiles/'.$item->image).'" alt="'.$item->name.'" />
                            </a>
                        </div>
                        <div class="pull-left info">
                            <a href="/cong-trinh/'.$item->slug.'-'.$item->id.'.html" title="'.$item->name.'">
                               '.$item->name.'
                            </a>
                            <p class="pdPrice">
                                
                                <span>'.number_format($item->price).'đ</span>
                                
                            </p>
                        </div>
                    </div>';
                    if($i == 6)
                        break;
                    else
                        $i++;
                }
                $total = number_format(count($list));
                echo '<div class="resultsMore">
                    <a href="javascript:void(0)">Xem thêm '.$total.' sản phẩm</a>
                </div>';
                echo '</div>';
            }
            exit;
        }
        $total_construction = 0;
        $list = $this->Mconstruction->searchconstruction($q);
        if($list){
            $data['list'] = $list;
            $total_construction = count($list);
        }
        $data['total_construction'] = $total_construction;

        //breadcrumbx
        $breadcrumb = [
            'Sản phẩm' => 'cong-trinh',
            'Tìm kiếm' => '',
            $q => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = 'Tìm kiếm :'.$q;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }
}
