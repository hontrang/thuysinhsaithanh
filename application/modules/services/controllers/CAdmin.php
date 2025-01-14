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
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if(!$info)
                redirect('/admin/'.$module.'/listall','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getPreItem('services',$info->orders);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'services',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'services',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if(!$info)
                redirect('/admin/'.$module.'/listall','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getNextItem('services',$info->orders);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'services',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'services',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/services/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','services');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','services',$config['per_page'],$start,"orders ASC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách";
        $data['method'] = $this->router->fetch_method();
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
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Banner', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
                //$data_db_lang['banner'] = $post_data['banner'];
                //$data_db_lang['des'] = $post_data['des'];
                $data_db_lang['detail'] = $post_data['detail'];
                $data_db_lang['lang'] = 'vi';

                //get order max
                $order_max = $this->MCommon->getMaxOrder('services');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;

                if($this->MCommon->insert($data_db,'services'))
                {
                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'services_lang');

                    redirect('/admin/services/listall','refresh');
                    die();
                }
            }
        }



        //template
        $data['module'] = $module;
        $data['title'] = "Thêm";
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
            redirect('/admin/services/listall','refresh');

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'banner', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang == 'vi')
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
                //$data_db_lang['banner'] = $post_data['banner'];
                //$data_db_lang['des'] = $post_data['des'];
                $data_db_lang['detail'] = $post_data['detail'];
                $data_db['id'] = $id;


                if($this->MCommon->update($data_db,'services',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'services_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/services/listall/','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('services',['id'=>$id]);
        if(!$check)
            redirect('/admin/services/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'services',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'services_lang');
            $info = $this->MCommon->getRow_lang($lang,'services',['id'=>$id]);
        }

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Sửa";
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
            redirect('/admin/services/listall','refresh');

        $this->MCommon->delete('services',['id'=>$id]);
        $this->MCommon->delete('services_lang',['record_id'=>$id]);

        redirect('/admin/services/listall','refresh');

    }
	
	public function setstatus(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $type = $this->input->get('type');
        $id = (int)$this->input->get('id');

        if($type == 'hot'){
            //kiem tra
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if($info->is_hot == '0')
                $this->MCommon->update(['is_hot'=>1],'services',['id'=>$id]);
            else
                $this->MCommon->update(['is_hot'=>0],'services',['id'=>$id]);
        }
        if($type == 'new'){
            //kiem tra
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if($info->is_new == '0')
                $this->MCommon->update(['is_new'=>1],'services',['id'=>$id]);
            else
                $this->MCommon->update(['is_new'=>0],'services',['id'=>$id]);
        }
		if($type == 'show_home'){
            //kiem tra
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if($info->show_home == '0')
                $this->MCommon->update(['show_home'=>1],'services',['id'=>$id]);
            else
                $this->MCommon->update(['show_home'=>0],'services',['id'=>$id]);
        }

        if($type == 'hide'){
            //kiem tra
            $info = $this->MCommon->getRow('services',['id'=>$id]);
            if($info->hide == '0')
                $this->MCommon->update(['hide'=>1],'services',['id'=>$id]);
            else
                $this->MCommon->update(['hide'=>0],'services',['id'=>$id]);
        }
        echo json_encode(['error'=>0]);
        exit;
    }

}
