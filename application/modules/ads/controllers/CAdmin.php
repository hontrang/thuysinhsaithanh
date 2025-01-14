<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/6/17 10:49 AM
 * Date: 10/6/17 11:03 AM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/4/17 1:41 PM
 * Date: 10/4/17 1:41 PM
 *
 */

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
        $this->load->model('MAds');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/ads/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('ads');
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('ads',$config['per_page'],$start,NULL,null,"orders DESC, id DESC ");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách ads";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }


    public function add()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        if(!empty($this->input->post('submit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required'),
                array('field' => 'position', 'label' => 'Vị trí', 'rules' => 'required'),
                //array('field' => 'ads_from', 'label' => 'Ngày Bắt đầu', 'rules' => 'required'),
                //array('field' => 'ads_to', 'label' => 'Ngày kết thúc', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                //$data_db['ads_from'] = $post_data['ads_from'];
                //$data_db['ads_to'] = $post_data['ads_to'];
                $data_db['position'] = $post_data['position'];
                $data_db['content'] = $post_data['content'];
                //$data_db['image'] = $post_data['image'];
                //$data_db['url'] = $post_data['url'];
                $data_db['orders'] = 99999;
                $data_db['user_id'] = $this->session->userdata("userid");

                if($this->MCommon->insert($data_db,"ads"))
                {
                    $this->syncOrder($module);
					redirect('/admin/ads/listall','refresh');
                    die();
                }
            }
        }


        //template
        $data['module'] = $module;
        $data['title'] = "Thêm ads";
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
            redirect('/admin/ads/listall','refresh');

        if(!empty($this->input->post('submit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required'),
                //array('field' => 'position', 'label' => 'Vị trí', 'rules' => 'required'),
                //array('field' => 'ads_from', 'label' => 'Ngày Bắt đầu', 'rules' => 'required'),
                //array('field' => 'ads_to', 'label' => 'Ngày kết thúc', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                //$data_db['ads_from'] = $post_data['ads_from'];
                //$data_db['ads_to'] = $post_data['ads_to'];
                $data_db['position'] = $post_data['position'];
                $data_db['content'] = $post_data['content'];
                //$data_db['url'] = $post_data['url'];
                $data_db['user_id'] = $this->session->userdata("userid");

                if($this->MCommon->update($data_db,'ads',['id'=> $id]))
                {
                    redirect('/admin/ads/listall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('ads',['id'=>$id]);
        if(!$info)
            redirect('/admin/ads/listall','refresh');

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Sửa ads";
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
            redirect('/admin/ads/listall','refresh');

        $this->MCommon->delete('ads',['id'=>$id]);
		$this->syncOrder($module);
        redirect('/admin/ads/listall','refresh');

    }
	public function updateOrder(){
		$module = $this->router->fetch_module();
        $orders_new = (int)$this->input->post('orders_new');
        $id = (int)$this->input->post('id');
        if($id == 0 or $id == ""){
            redirect('/admin/'.$module.'/listall/','refresh');
        }

        $this->MCommon->update(['orders'=>$orders_new],$module,['id'=>$id]);
        echo 'upadated';
        exit;
    }
	
	public function syncOrder($module=''){
		$redirect = 0;
		if($module == ""){
			$module = $this->router->fetch_module();
			$redirect = 1;
		}
			
        
        $products = $this->MCommon->getAllRow($module,null,'orders ASC, id ASC');
        if($products){
            $i = 1;
            foreach($products as $product){
                $this->MCommon->update(['orders'=>$i],$module,['id'=>$product->id]);
                $i++;
            }
        }
		if($redirect == 1)
			redirect('/admin/'.$module.'/listall','refresh');

    }
}
