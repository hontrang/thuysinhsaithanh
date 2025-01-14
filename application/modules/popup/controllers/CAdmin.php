<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/6/17 11:26 AM
 * Date: 10/6/17 11:26 AM
 *
 */

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
        $this->load->model('MPopup');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/popup/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('popup');
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('popup',$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách Popup";
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
                array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['title'] = $post_data['title'];
                $data_db['image'] = $post_data['image'];
                $data_db['url'] = $post_data['url'];
                $data_db['create_date'] = date("Y-m-d h:s:i");

                if($this->MCommon->insert($data_db,"popup"))
                {
                    redirect('/admin/popup/listall','refresh');
                    die();
                }
            }
        }


        //template
        $data['module'] = $module;
        $data['title'] = "Thêm Popup";
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
            redirect('/admin/popup/listall','refresh');

        if(!empty($this->input->post('submit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình ảnh', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['title'] = $post_data['title'];
                $data_db['image'] = $post_data['image'];
                $data_db['url'] = $post_data['url'];

                if($this->MCommon->update($data_db,'popup',['id'=> $id]))
                {
                    redirect('/admin/popup/listall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('popup',['id'=>$id]);
        if(!$info)
            redirect('/admin/popup/listall','refresh');

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Sửa Popup";
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
            redirect('/admin/popup/listall','refresh');

        $this->MCommon->delete('popup',['id'=>$id]);

        redirect('/admin/popup/listall','refresh');

    }

    public function active()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/popup/listall','refresh');

        //reset all
        $this->MCommon->update(['status'=>0],'popup',['id !='=>$id]);

        //set active
        $popup = $this->MCommon->getRow('popup',['id'=>$id]);
        if(!$popup)
            redirect('/admin/popup/listall','refresh');
        if($popup->status == 0)
            $this->MCommon->update(['status'=>1],'popup',['id'=>$id]);
        else
            $this->MCommon->update(['status'=>0],'popup',['id'=>$id]);

        redirect('/admin/popup/listall','refresh');

    }
}
