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
        $this->load->model('MMenu');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $parent_id = (int)$this->input->get('parent_id');
            $info = $this->MCommon->getRow('menu',['id'=>$id]);
            if(!$info)
                redirect('/admin/menu/listall','refresh');

            //bai truoc
            $item_truoc = $this->MMenu->getPreItem('menu',$info->orders,$info->parent_id);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'menu',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'menu',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $parent_id = (int)$this->input->get('parent_id');
            $info = $this->MCommon->getRow('menu',['id'=>$id]);
            if(!$info)
                redirect('/admin/menu/listall','refresh');

            //bai truoc
            $item_truoc = $this->MMenu->getNextItem('menu',$info->orders,$info->parent_id);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'menu',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'menu',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/menu/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('menu',['parent_id'=>0]);
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_parent = $this->MCommon->getAllRowWithPage('menu',$config['per_page'],$start,"orders ASC",['parent_id'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list_parent){
            $list = new stdClass();
            $i = 0;
            foreach ($list_parent as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$parent->id],null,"orders ASC");
                if($sub){
                    
						$list->{$i}->sub = new stdClass();
						$j = 0;
						foreach ($sub as $parent_sub){
							$list->{$i}->sub->{$j} = new stdClass();
							$list->{$i}->sub->{$j} = $parent_sub;
							$sub2 = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$parent_sub->id],null,"orders ASC");
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
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	public function listall2()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

       

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/menu/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('menu_test',['parent_id'=>0]);
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_parent = $this->MCommon->getAllRowWithPage('menu_test',$config['per_page'],$start,"orders ASC",['parent_id'=>0]);
        $pagination_link = $this->pagination->create_links();

        if($list_parent){
            $list = new stdClass();
            $i = 0;
            foreach ($list_parent as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere('menu_test',['parent_id'=>$parent->id],null,"orders ASC");
                if($sub){
                    
						$list->{$i}->sub = new stdClass();
						$j = 0;
						foreach ($sub as $parent_sub){
							$list->{$i}->sub->{$j} = new stdClass();
							$list->{$i}->sub->{$j} = $parent_sub;
							$sub2 = $this->MCommon->getAllRowByWhere('menu_test',['parent_id'=>$parent_sub->id],null,"orders ASC");
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
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	public function save()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
		modules::run('auth/Permission/check',$permission_id);
		
		$data = $this->input->post('data');
		$data = json_decode(json_encode($data));
		if($data){
			foreach($data as $i => $item){
				$this->MCommon->update(['orders'=>$i,'parent_id'=>0],'menu',['id'=>$item->id]);
				if(isset($item->children)){
					foreach($item->children as $j=>$sub){
						$this->MCommon->update(['orders'=>$j,'parent_id'=>$item->id],'menu',['id'=>$sub->id]);
						if(isset($sub->children)){
							foreach($sub->children as $k=>$sub2){
								$this->MCommon->update(['orders'=>$k,'parent_id'=>$sub->id],'menu',['id'=>$sub2->id]);
								
							}
						}
					}
				}
			}
		}
		print_r($data);
		exit;
	
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
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'url', 'label' => 'Link', 'rules' => 'required'),
                array('field' => 'target', 'label' => 'Loại', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['url'] = $post_data['url'];
                $data_db['parent_id'] = $post_data['parent_id'];
                $data_db['target'] = $post_data['target'];


                //get order max
                $order_max = $this->MMenu->getMaxOrder('menu',$post_data['parent_id']);
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;

                if($this->MCommon->insert($data_db,'menu'))
                {
                    redirect('/admin/menu/listall','refresh');
                    die();
                }
            }
        }

        $menus = $this->MCommon->getAllRow('menu',null,null,null,['parent_id'=> 0]);
		if($menus){
            $list = new stdClass();
            $i = 0;
            foreach ($menus as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$parent->id],null,"orders ASC");
                if($sub){
                    $list->{$i}->sub = new stdClass();
                    $list->{$i}->sub = $sub;
					
                }
                $i++;
            }
            $data['menus'] = $list;
        }
		
		
        

        //template
        $data['module'] = $module;
        $data['title'] = "Add";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function edit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		


        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/menu/listall','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'url', 'label' => 'Link', 'rules' => 'required'),
                array('field' => 'target', 'label' => 'Loại', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['url'] = $post_data['url'];
                $data_db['target'] = $post_data['target'];
                $data_db['parent_id'] = $post_data['parent_id'];


                if($this->MCommon->update($data_db,'menu',['id'=>$id]))
                {
                    redirect('/admin/menu/listall','refresh');
                    die();
                }
            }
        }
        $menus = $this->MCommon->getAllRow('menu',null,null,null,['parent_id'=> 0]);
        if($menus){
            $list = new stdClass();
            $i = 0;
            foreach ($menus as $parent){
                $list->{$i} = new stdClass();
                $list->{$i} = $parent;
                $sub = $this->MCommon->getAllRowByWhere('menu',['parent_id'=>$parent->id],null,"orders ASC");
                if($sub){
                    $list->{$i}->sub = new stdClass();
                    $list->{$i}->sub = $sub;
                }
                $i++;
            }
            $data['menus'] = $list;
        }

        $info = $this->MCommon->getRow('menu',['id'=>$id]);
        $data['info'] = $info;
		
		$lang_list = $this->MCommon->getAllRow('language_list');
		if($lang_list)
			$data['lang_list'] = $lang_list;



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
            redirect('/admin/menu/listall','refresh');

        $this->MCommon->delete('menu',['id'=>$id]);

        redirect('/admin/menu/listall','refresh');

    }
    public function getCatbyType(){
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $module_id = $this->input->post("module_id");
        $check = $this->MCommon->getRow('modules',['id'=>$module_id]);
        $cats = null;
        if($check->has_cat == '1'){

            $cat_list = $this->MCommon->getAllRowByWhere($module_id.'_cat');
            if($cat_list){
                $i = 0;
                foreach ($cat_list as $item){
                    $cats[$i]['id'] = $item->id;
                    $cats[$i]['name'] = $item->name;
                    $i++;
                }
            }
        }
        if($check->has_cat == '0'){
            $cats[0]['id'] = 0;
            $cats[0]['name'] = 'Danh mục chính';
        }
        echo json_encode($cats);
        exit;

    }

    public function getPostbyCat(){
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $cat_id = $this->input->post("cat_id");
        $module_id = $this->input->post("module_id");

        if($cat_id == 0)
            $where = null;
        else
            $where = ['cat_id'=>$cat_id];

        $posts = null;
        $post_list = $this->MCommon->getAllRowByWhere($module_id,$where);
        if($post_list){
            $i = 0;
            foreach ($post_list as $item){
                $posts[$i]['id'] = $item->id;
                $posts[$i]['name'] = $item->name;
                $i++;
            }
        }
        echo json_encode($posts);
        exit;

    }
}
