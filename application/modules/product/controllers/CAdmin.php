<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:33 AM
 * Date: 9/15/17 3:05 PM
 *
 */

/**
 * Class CAdmin
 * @property CAdmin $CAdmin event module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CAdmin extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('MProduct');
        $this->load->model('MCommon');
    }

    

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/product/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','product');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','product',$config['per_page'],$start,"orders DESC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        $list_cat = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }
		
		$brands = $this->MCommon->getAllRowByWhere('product_brand',[]);
		if($brands)
			$data['brands'] = $brands;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List Products";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function brandlistall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/product/brandlistall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('product_brand');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('product_brand',$config['per_page'],$start,"orders ASC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách thương hiệu";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	

    public function search()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);


        $name = $this->input->get("name");
        $cat_id = $this->input->get("cat_id");
        $brand_id = $this->input->get("brand_id");
        $code = $this->input->get("code");
        $hot = $this->input->get("hot");
        $new = $this->input->get("new");
		
		if($cat_id != ""){
			$cat_id = $this->MCommon->getCatIDs($cat_id);
		}

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/product/listall/';
        $config['total_rows'] = $this->MProduct->getTotalRowSearch('vi',$name,$cat_id,$brand_id,$code,$hot,$new);
        $config['per_page'] = 99999;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MProduct->getAllRowWithPageSearch('vi',$name,$cat_id,$brand_id,$code,$hot,$new,$config['per_page'],$start,"orders DESC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $list_cat = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0],null,"orders ASC");
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$item->id],null,"orders ASC");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }
		
		$brands = $this->MCommon->getAllRowByWhere('product_brand',[]);
		if($brands)
			$data['brands'] = $brands;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List Products";
        $data['method'] = 'listall';
        echo modules::run('template/getlayout/admin', $data);
    }


    public function add()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                //array('field' => 'price', 'label' => 'Price', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Category', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Image', 'rules' => 'required'),
                array('field' => 'detail', 'label' => 'Detail', 'rules' => 'required'),
                array('field' => 'brand_id', 'label' => 'Thương hiệu', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
				$data_db_lang['code'] = $post_data['code'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['price'] = $post_data['price'];
				$data_db_lang['dvt'] = $post_data['dvt'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
   

                $data_db_lang['detail'] = $post_data['detail'];
                $data_db_lang['description'] = $post_data['description'];
                $data_db_lang['parameter'] = $post_data['parameter'];
                $data_db['price_old'] = $post_data['price_old'];
                //$data_db['tags'] = $post_data['tags'];
                $data_db['brand_id'] = $post_data['brand_id'];

                //seo
                $data_db['title_seo'] = $post_data['title_seo'];
                $data_db['des_seo'] = $post_data['des_seo'];
                $data_db['keyword_seo'] = $post_data['keyword_seo'];

                if($post_data['tragop'] != "")
                    $data_db['tragop'] = $post_data['tragop'];
                else
                    $data_db['tragop'] = Null;

                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if(isset($post_data['is_new']))
                    $data_db['is_new'] = $post_data['is_new'];
                else
                    $data_db['is_new'] = 0;

				//get order max
                $order_max = $this->MProduct->getMaxOrder('product');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;

                if($this->MCommon->insert($data_db,'product'))
                {
                    $id_product = $this->db->insert_id();
                    $data_db_lang['record_id'] = $id_product;
                    $this->MCommon->insert($data_db_lang,'product_lang');

                    if(isset($post_data['related_product'])){
                        foreach ($post_data['related_product'] as $related){
                            $this->MCommon->insert(['product_id'=>$id_product,'related_id'=>$related],'product_related');
                        }
                    }


                    if(isset($post_data['properties'])){
                        foreach ($post_data['properties'] as $item){
                            if(trim($item['properties_id']) != ""){
                                $data_properties = null;
                                $data_properties['product_properties_id'] = trim($item['properties_id']);
                                $data_properties['product_properties_value'] = trim($item['properties_value']);
                                $data_properties['product_id'] = $id_product;
                                $this->MCommon->insert($data_properties,'product_properties');
                            }

                        }

                    }

                    if(isset($post_data['product_promotion'])){
                        foreach ($post_data['product_promotion'] as $item){
                            if($item['product_promotion_image'] == "") $item['product_promotion_image'] = "image-default.png";
                            if(trim($item['product_promotion_name']) != ""){
                                $data_properties = null;
                                $data_properties['name'] = trim($item['product_promotion_name']);
                                $data_properties['image'] = trim($item['product_promotion_image']);
                                $data_properties['url'] = trim($item['product_promotion_url']);
                                $data_properties['product_id'] = $id_product;
                                $this->MCommon->insert($data_properties,'product_promotion');
                            }

                        }

                    }

                    redirect('/admin/product/addimage/'.$id_product,'refresh');
                    die();
                }
            }
        }

        $list = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        $list_products = $this->MCommon->getAllRow_lang('vi','product');
        if($list_products)
            $data['list_products'] = $list_products;

        $list_brand = $this->MCommon->getAllRowByWhere('product_brand',[],null,"name ASC");
        if($list_brand)
            $data['list_brand'] = $list_brand;


        //template
        $data['module'] = $module;
        $data['title'] = "Add New";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function getProperties(){
        $cat_id = (int)$this->input->post('cat_id');
        $properties = $this->MCommon->getAllRowByWhere('product_cat_properties',['product_cat_id'=>$cat_id],null,"properties_name ASC");
        if($properties)
        {
            $repo['error'] = 0;
            $repo['data'] = $properties;
        }
        else{
            $repo['error'] = 1;
            $repo['data'] = [];
        }
        echo json_encode($repo);
        exit;
    }
	
	public function copy()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		//change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");
		
		$id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/listall','refresh');
		
		$info = $this->MCommon->getRow_lang($lang,'product',['id'=>$id]);
        if(!$info){
            redirect('/admin/product/listall','refresh');
        }
		

		$data_db_lang['name'] = $info->name;
		$data_db['slug'] = create_slug($info->name);
		$data_db['price'] = $info->price;
		$data_db['cat_id'] = (int)$info->cat_id;
		$data_db['image'] = $info->image;

		$data_db_lang['detail'] = $info->detail;
		$data_db_lang['description'] = $info->description;
		$data_db_lang['parameter'] = $info->parameter;
		$data_db['price_old'] = $info->price_old;
		//$data_db['tags'] = $info->tags;
		$data_db['brand_id'] = $info->brand_id;

		//seo
		$data_db['title_seo'] = $info->title_seo;
		$data_db['des_seo'] = $info->des_seo;
		$data_db['keyword_seo'] = $info->keyword_seo;

		if($info->tragop != "")
			$data_db['tragop'] = $info->tragop;
		else
			$data_db['tragop'] = Null;

		if(isset($info->is_hot))
			$data_db['is_hot'] = $info->is_hot;
		else
			$data_db['is_hot'] = 0;

		if(isset($info->is_new))
			$data_db['is_new'] = $info->is_new;
		else
			$data_db['is_new'] = 0;

		//get order max
		$order_max = $this->MProduct->getMaxOrder('product');
		if($order_max)
			$data_db['orders'] = $order_max->orders + 1;
		else
			$data_db['orders'] = 0;
		
		
		if($this->MCommon->insert($data_db,'product'))
		{
			$id_product = $this->db->insert_id();
			$data_db_lang['record_id'] = $id_product;
			$this->MCommon->insert($data_db_lang,'product_lang');
			
			@mkdir("public/userfiles/product_image/".$id_product);
			$product_image = $this->MCommon->getAllRowByWhere('product_image',['product_id'=>$id]);
			if($product_image)foreach($product_image as $image){
				$temp = explode("/",$image->image);
				$image_name = $temp[count($temp)-1];
				
				
				if(copy("public/userfiles/".$image->image,"public/userfiles/product_image/".$id_product."/".$image_name)){
					$data_image['name'] = $image->name;
					$data_image['size'] = $image->size;
					$data_image['type'] = $image->type;
					$data_image['image'] = 'product_image/'.$id_product.'/'.$image_name;
					$data_image['product_id'] = $id_product;

					$this->MCommon->insert($data_image,'product_image');
				}
			}
		}
		
		redirect('/admin/product/listall','refresh');
		exit;
		
	}

    public function edit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/listall','refresh');
		
		

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                //array('field' => 'price', 'label' => 'Price', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Category', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Image', 'rules' => 'required'),
                array('field' => 'detail', 'label' => 'Detail', 'rules' => 'required'),
                array('field' => 'brand_id', 'label' => 'Thương hiệu', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
				$data_db_lang['code'] = $post_data['code'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['price'] = $post_data['price'];
				$data_db_lang['dvt'] = $post_data['dvt'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
				

                $data_db_lang['detail'] = $post_data['detail'];
                $data_db_lang['description'] = $post_data['description'];
                $data_db_lang['parameter'] = $post_data['parameter'];
                $data_db['price_old'] = $post_data['price_old'];
                //$data_db['tags'] = $post_data['tags'];
                $data_db['brand_id'] = $post_data['brand_id'];

                //seo
                $data_db['title_seo'] = $post_data['title_seo'];
                $data_db['des_seo'] = $post_data['des_seo'];
                $data_db['keyword_seo'] = $post_data['keyword_seo'];

                if($post_data['tragop'] != "")
                    $data_db['tragop'] = $post_data['tragop'];
                else
                    $data_db['tragop'] = Null;

                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if(isset($post_data['is_new']))
                    $data_db['is_new'] = $post_data['is_new'];
                else
                    $data_db['is_new'] = 0;

				

                if($this->MCommon->update($data_db,'product',['id'=>$id]))
                {
                    $id_product = $id;
                    $this->MCommon->update($data_db_lang,'product_lang',['record_id'=>$id,'lang'=>$lang]);

                    //xoa cai cu
                    $this->MCommon->delete('product_related',['product_id'=>$id_product]);

                    if(isset($post_data['related_product'])){
                        foreach ($post_data['related_product'] as $related){
                            $this->MCommon->insert(['product_id'=>$id_product,'related_id'=>$related],'product_related');
                        }
                    }

                    $this->MCommon->delete('product_properties',['product_id'=>$id]);
                    if(isset($post_data['properties'])){
                        //print_r($post_data['properties'][1]);
                        foreach ($post_data['properties'] as $item){
                            if(trim($item['properties_id']) != ""){
                                $data_properties = null;
                                $data_properties['product_properties_id'] = trim($item['properties_id']);
                                $data_properties['product_properties_value'] = trim($item['properties_value']);
                                $data_properties['product_id'] = $id;
                                $this->MCommon->insert($data_properties,'product_properties');
                            }

                        }

                    }
                    
                    $this->MCommon->delete('product_promotion',['product_id'=>$id]);
                    if(isset($post_data['product_promotion'])){
                        foreach ($post_data['product_promotion'] as $item){
                            if($item['product_promotion_image'] == "") $item['product_promotion_image'] = "image-default.png";
                            if(trim($item['product_promotion_name']) != ""){
                                $data_properties = null;
                                $data_properties['name'] = trim($item['product_promotion_name']);
                                $data_properties['image'] = trim($item['product_promotion_image']);
                                $data_properties['url'] = trim($item['product_promotion_url']);
                                $data_properties['product_id'] = $id_product;
                                $this->MCommon->insert($data_properties,'product_promotion');
                            }

                        }

                    }

                    
                    
                    redirect('/admin/product/addimage/'.$id,'refresh');
                    die();
                }
            }
        }
		else{
			$this->load->library('user_agent');
			$referrer = $this->agent->referrer();

			
			$this->session->set_userdata('referrer',$referrer);
		}



		$check = $this->MCommon->getRow('product',['id'=>$id]);
        if(!$check)
            redirect('/admin/product/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'product',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'product_lang');
            $info = $this->MCommon->getRow_lang($lang,'product',['id'=>$id]);
        }
        $data['info'] = $info;


        $list = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }


        $related_products = $this->MCommon->getAllRowByWhere('product_related',['product_id'=>$id]);
        if($related_products)
            $data['related_products'] = $related_products;

        $list_products = $this->MCommon->getAllRow_lang('vi','product');
        if($list_products)
            $data['list_products'] = $list_products;

        
        $data['info'] = $info;

        $list_brand = $this->MCommon->getAllRowByWhere('product_brand',[],null,"name ASC");
        if($list_brand)
            $data['list_brand'] = $list_brand;

        $properties = $this->MCommon->getAllRowByWhere('product_cat_properties',['product_cat_id'=>$info->cat_id],null,"properties_name ASC");
        if($properties)
        {
            $data['properties'] = $properties;
        }

        $product_properties = $this->MCommon->getAllRowByWhere('product_properties',['product_id'=>$info->id],null,"sub_id ASC");
        if($product_properties){
            $list_product_properties = null;
            foreach($product_properties as $item){
                $list_product_properties[$item->product_properties_id] = $item->product_properties_value;
            }
            $data['product_properties'] = $list_product_properties;
        }
        else{
            $data['product_properties'] = [];
        }

        $product_promotion = $this->MCommon->getAllRowByWhere('product_promotion',['product_id'=>$info->id],null,"id ASC");
        if($product_promotion)
            $data['product_promotion'] = $product_promotion;
        
        //template
        $data['module'] = $module;
        $data['title'] = "Edit";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function del()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/listall','refresh');

        $this->MCommon->delete('product',['id'=>$id]);
        $this->MCommon->delete('product_lang',['record_id'=>$id]);
        $this->MCommon->delete('product_image',['product_id'=>$id]);

        redirect('/admin/product/listall','refresh');

    }
	
	public function dels()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $ids = $this->input->post('ids');
		
        foreach($ids as $id){
			$this->MCommon->delete('product',['id'=>$id]);
			$this->MCommon->delete('product_lang',['record_id'=>$id]);
			$this->MCommon->delete('product_image',['product_id'=>$id]);
		}

        

        redirect('/admin/product/listall','refresh');

    }


    public function listallcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);


        $list_parent = $this->MCommon->getAllRowByWhere_lang('vi',"product_cat",['parent_id'=>0],null,"orders ASC, id ASC");
        if($list_parent){
            $list = new stdClass();
            $i = 0;
            foreach ($list_parent as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$parent->id],null,"orders ASC, id ASC");
                if($sub){
                    $list->{$i}->sub = new stdClass();
                    $j = 0;
                    foreach ($sub as $parent_sub){
                        $list->{$i}->sub->{$j} = new stdClass();
                        $list->{$i}->sub->{$j} = $parent_sub;
                        $sub2 = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$parent_sub->id],null,"orders ASC, id ASC");
                        if($sub2){
                            $list->{$i}->sub->{$j}->sub = new stdClass();
                            $list->{$i}->sub->{$j}->sub = $sub2;
                        }
                        $j++;
                    }


                }
                $i++;
            }
            $data['list'] = (($list));
        }

        //template
        $data['module'] = $module;
        $data['title'] = "Category";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function savecatorder()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $data = $this->input->post('data');
        $data = json_decode(json_encode($data));
        if($data){
            foreach($data as $i => $item){
                $this->MCommon->update(['orders'=>$i,'parent_id'=>0],'product_cat',['id'=>$item->id]);
                if(isset($item->children)){
                    foreach($item->children as $j=>$sub){
                        $this->MCommon->update(['orders'=>$j,'parent_id'=>$item->id],'product_cat',['id'=>$sub->id]);
                        if(isset($sub->children)){
                            foreach($sub->children as $k=>$sub2){
                                $this->MCommon->update(['orders'=>$k,'parent_id'=>$sub->id],'product_cat',['id'=>$sub2->id]);

                            }
                        }
                    }
                }
            }
        }
        print_r($data);
        exit;

    }

    public function addcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Parent Category', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
                $data_db['ads_url'] = $post_data['ads_url'];
                $data_db['ads_image'] = $post_data['ads_image'];
				$data_db['parent_id'] = (int)$post_data['parent_id'];
				$data_db['discount'] = (int)$post_data['discount'];
				$data_db['color'] = $post_data['color'];
                $data_db_lang['description'] = $post_data['description'];
				$data_db_lang['detail'] = $post_data['detail'];

                if(isset($post_data['show_home']))
                    $data_db['show_home'] = $post_data['show_home'];
                else
                    $data_db['show_home'] = 0;


                //get order max
                $order_max = $this->MProduct->getMaxOrder('product_cat',$data_db['parent_id']);
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'product_cat'))
                {
                    $id_cat = $this->db->insert_id();
                    if(isset($post_data['product_cat_properties'])){
                        foreach ($post_data['product_cat_properties'] as $item){
                            if(trim($item['name']) != ""){
                                $data_properties = null;
                                $data_properties['properties_name'] = trim($item['name']);
                                $data_properties['properties_slug'] = create_slug(trim($item['name']));
                                $data_properties['product_cat_id'] = $id_cat;
                                $this->MCommon->insert($data_properties,'product_cat_properties');
                            }

                        }

                    }

                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'product_cat_lang');
                    redirect('/admin/product/listallcat','refresh');
                    die();
                }
            }
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0]);
        if($listparent)
            $data['listparent'] = $listparent;



        //template
        $data['module'] = $module;
        $data['title'] = "Add New";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }


    public function brandadd()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
				$data_db['image'] = $post_data['image'];
                $data_db['letter'] = strtoupper(substr($post_data['image'],0,1));
				
				//get order max
                $order_max = $this->MProduct->getMaxOrder('product_brand');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;
				
				$check = $this->MCommon->getRow('product_brand',['slug'=>$data_db['slug']]);
				if(!$check){
					if($this->MCommon->insert($data_db,'product_brand'))
					{
						redirect('/admin/product/brandlistall','refresh');
						die();
					}
				}
				else{
					$this->session->set_flashdata('error','Thương hiệu này đã tồn tại!');
				}
                
            }
        }



        //template
        $data['module'] = $module;
        $data['title'] = "Add New";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function editcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/listallcat','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Parent Category', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang=="vi")
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db['parent_id'] = (int)$post_data['parent_id'];
                $data_db['image'] = $post_data['image'];
                $data_db['ads_url'] = $post_data['ads_url'];
                $data_db['ads_image'] = $post_data['ads_image'];
				$data_db['discount'] = (int)$post_data['discount'];
				$data_db['color'] = $post_data['color'];
                $data_db['id'] = $id;
                $data_db_lang['description'] = $post_data['description'];
				$data_db_lang['detail'] = $post_data['detail'];

                if(isset($post_data['show_home']))
                    $data_db['show_home'] = $post_data['show_home'];
                else
                    $data_db['show_home'] = 0;

                if($this->MCommon->update($data_db,'product_cat',['id'=>$id]))
                {
                    
                    //them phien ban
                    //$this->MCommon->delete('product_cat_properties',['product_cat_id'=>$id]);
                    if(isset($post_data['product_cat_properties'])){
                        foreach ($post_data['product_cat_properties'] as $item){
                            if(trim($item['name']) != ""){
                                $data_properties = null;
                                $data_properties['properties_name'] = trim($item['name']);
                                $data_properties['properties_slug'] = create_slug(trim($item['name']));
                                $data_properties['product_cat_id'] = $id;
                                //$this->MCommon->insert($data_properties,'product_cat_properties');
                            }

                        }

                    }

                    $this->MCommon->update($data_db_lang,'product_cat_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/product/listallcat','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('product_cat',['id'=>$id]);
        if(!$check)
            redirect('/admin/product/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'product_cat',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'product_cat_lang');
            $info = $this->MCommon->getRow_lang($lang,'product_cat',['id'=>$id]);
        }
        $data['info'] = $info;

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>0]);
        if($listparent)
            $data['listparent'] = $listparent;
        

        $product_cat_properties = $this->MCommon->getAllRowByWhere('product_cat_properties',['product_cat_id'=>$info->id],null,"properties_name ASC");
        if($product_cat_properties){
            $data['product_cat_properties'] = $product_cat_properties;
        }


        //template

        $data['module'] = $module;
        $data['title'] = "Edit";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function brandedit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);


        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/brandlistall','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
                $data_db['letter'] = strtoupper(substr($post_data['image'],0,1));


                if($this->MCommon->update($data_db,'product_brand',['id'=>$id]))
                {
                    redirect('/admin/product/brandlistall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('product_brand',['id'=>$id]);
        $data['info'] = $info;



        //template

        $data['module'] = $module;
        $data['title'] = "Edit";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function delcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/listallcat','refresh');

        $this->MCommon->delete('product_cat',['id'=>$id]);
        $this->MCommon->delete('product_cat_lang',['record_id'=>$id]);

        redirect('/admin/product/listallcat','refresh');

    }


    public function branddel()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/product/brandlistall','refresh');

        $this->MCommon->delete('product_brand',['id'=>$id]);

        redirect('/admin/product/brandlistall','refresh');

    }



    public function upload()
    {
        //kiem tra phan quyen
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        //id cua album
        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        include('public/fileuploader/class.fileuploader.php');

        $isAfterEditing = false;
        $fileuploader_title = 'name';
        $fileuploader_replace = false;

        // if after editing
        if (isset($_POST['_namee']) && isset($_POST['_editorr'])) {
            $fileuploader_title = $_POST['_namee'];
            $fileuploader_replace = true;
            $isAfterEditing = true;
        }
		
		//check
        if(!file_exists("public/userfiles/product_image/".$id)){
            mkdir("public/userfiles/product_image/".$id);
        }



        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 500,
            'maxSize' => null,
            'fileMaxSize' => 20,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/userfiles/product_image/'.$id.'/',
            'title' => 'name',
            'replace' => $fileuploader_replace,
            'listInput' => true,
            'files' => null
        ));

        // call to upload the files
        $upload = $FileUploader->upload();

        //update database
        if($upload['hasWarnings'] == false and $upload['isSuccess'] == true){
            $data_db['name'] = $upload['files'][0]['name'];
            $data_db['size'] = $upload['files'][0]['size'];
            $data_db['type'] = $upload['files'][0]['type'];
            $data_db['image'] = 'product_image/'.$id.'/'.$data_db['name'];
            //$data_db['thumb'] = 'product_image/'.$id.'/'.$data_db['name'];
            $data_db['product_id'] = $id;

            $this->MCommon->insert($data_db,'product_image');

            //tao anh nho
            //FileUploader::resize('upload/hinhthem/'.$upload['files'][0]['name'], $width = 250, $height = 200, $destination = 'upload/hinhthem/thumb_'.$upload['files'][0]['name'], $crop = true, $quality = 90, $rotation = 0);
        }

        // export to js
        echo json_encode($upload);
        exit;
    }
    public function delimage()
    {

        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        if (isset($_POST['file'])) {
            $file = 'product_image/'.$id.'/' . $_POST['file'];
            //$file2 = 'upload/hinhthem/thumb_' . $_POST['file'];

            $this->MCommon->delete('product_image',['product_id'=>$id,'name'=>$_POST["file"]]);

            if(file_exists($file))
                unlink($file);

           
        }
    }

    public function editimage()
    {

        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        include('public/fileuploader/class.fileuploader.php');
        echo 'hehe';
        if (isset($_POST['fileuploader']) && isset($_POST['_file']) && isset($_POST['_editor'])) {
            echo 'yes';
            $file = str_replace("/upload","upload",$_POST['_file']);
            if (is_file($file)) {
                echo 'yes2';
                $editor = json_decode($_POST['_editor'], true);

                Fileuploader::resize($file, null, null, null, (isset($editor['crop']) ? $editor['crop'] : null), 100, (isset($editor['rotation']) ? $editor['rotation'] : null));
            }
        }
    }


    public function addimage()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id == 0 or $id == ""){
            redirect('admin/product/listall/','refresh');
        }

        $this->session->set_userdata("id_upload",$id);


        $images = $this->MCommon->getAllRowByWhere('product_image',['product_id'=>$id]);
        if($images){
            $image_list = null;
            $i=0;
            foreach ($images as $image){
                $image_list[$i]['name'] = $image->name;
                $image_list[$i]['size'] = (int)$image->size;
                $image_list[$i]['type'] = $image->type;
                $image_list[$i]['file'] = '/public/userfiles/'.$image->image;
                $i++;
            }
            $list = json_encode($image_list);
            $scripts[] = '<script>var image_list = '.$list.';</script>';
        }
        else{
            $scripts[] = '<script>var image_list = null;</script>';
        }
		
		$referrer = $this->session->userdata('referrer');
		if($referrer != "")
			$data['referrer'] = $referrer;

        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/jquery.fileuploader.js"></script>';
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom_product.js"></script>';




        //template
        $data['module'] = $module;
        $data['scripts'] = $scripts;
        $data['title'] = "Thêm hình ảnh cho sản phẩm (nếu cần)";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function setstatus(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $type = $this->input->get('type');
        $id = (int)$this->input->get('id');

        if($type == 'hot'){
            //kiem tra
            $info = $this->MCommon->getRow('product',['id'=>$id]);
            if($info->is_hot == '0')
                $this->MCommon->update(['is_hot'=>1],'product',['id'=>$id]);
            else
                $this->MCommon->update(['is_hot'=>0],'product',['id'=>$id]);
        }
        if($type == 'new'){
            //kiem tra
            $info = $this->MCommon->getRow('product',['id'=>$id]);
            if($info->is_new == '0')
                $this->MCommon->update(['is_new'=>1],'product',['id'=>$id]);
            else
                $this->MCommon->update(['is_new'=>0],'product',['id'=>$id]);
        }
		if($type == 'show_home'){
            //kiem tra
            $info = $this->MCommon->getRow('product',['id'=>$id]);
            if($info->show_home == '0')
                $this->MCommon->update(['show_home'=>1],'product',['id'=>$id]);
            else
                $this->MCommon->update(['show_home'=>0],'product',['id'=>$id]);
        }

        if($type == 'hide'){
            //kiem tra
            $info = $this->MCommon->getRow('product',['id'=>$id]);
            if($info->hide == '0')
                $this->MCommon->update(['hide'=>1],'product',['id'=>$id]);
            else
                $this->MCommon->update(['hide'=>0],'product',['id'=>$id]);
        }
        echo json_encode(['error'=>0]);
        exit;
    }

	public function updateOrder(){

		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

		$orders_new = (int)$this->input->post('orders_new');
        $id = (int)$this->input->post('id');
		if($id == 0 or $id == ""){
            redirect('/admin/product/listall/','refresh');
        }

		$this->MCommon->update(['orders'=>$orders_new],'product',['id'=>$id]);
		echo 'upadated';
		exit;
	}
	
	public function updateOrderBrand(){

		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

		$orders_new = (int)$this->input->post('orders_new');
        $id = (int)$this->input->post('id');
		if($id == 0 or $id == ""){
            redirect('/admin/product/brandlistall/','refresh');
        }

		$this->MCommon->update(['orders'=>$orders_new],'product_brand',['id'=>$id]);
		echo 'upadated';
		exit;
	}
	
	public function updatePrice(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		
		if($this->MCommon->update([$type=>$value],'product',['id'=>$id])){
			$repo['error'] = 0;
			$repo['value'] = number_format($value);
		}
		else{
			$repo['error'] = 1;
		}
		echo json_encode($repo);
		exit;
	}
	public function syncOrder(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		$products = $this->MCommon->getAllRow('product',null,'orders ASC');
		if($products){
			$i = 0;
			foreach($products as $product){
				$this->MCommon->update(['orders'=>$i],'product',['id'=>$product->id]);
				$i++;
			}
		}
		redirect('/admin/product/listall','refresh');
		exit;
	}
	
	public function syncOrderBrand(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		$products = $this->MCommon->getAllRow('product_brand',null,'orders ASC');
		if($products){
			$i = 0;
			foreach($products as $product){
				$this->MCommon->update(['orders'=>$i],'product_brand',['id'=>$product->id]);
				$i++;
			}
		}
		redirect('/admin/product/brandlistall','refresh');
		exit;
	}
}
