<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/10/17 9:39 AM
 * Date: 10/10/17 9:39 AM
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
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/doitac/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('doitac');
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('doitac',$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách đối tác";
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
                array('field' => 'name', 'label' => 'Tên khách hàng', 'rules' => 'required'),
                array('field' => 'url', 'label' => 'Link', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Avatar', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['url'] = $post_data['url'];
                $data_db['image'] = $post_data['image'];

                if($this->MCommon->insert($data_db,"doitac"))
                {
                    redirect('/admin/doitac/listall','refresh');
                    die();
                }
            }
        }


        //template
        $data['module'] = $module;
        $data['title'] = "Thêm Đối tác";
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
            redirect('/admin/doitac/listall','refresh');

        if(!empty($this->input->post('submit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Tên khách hàng', 'rules' => 'required'),
                array('field' => 'url', 'label' => 'Link', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Avatar', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['url'] = $post_data['url'];
                $data_db['image'] = $post_data['image'];

                if($this->MCommon->update($data_db,'doitac',['id'=> $id]))
                {
                    redirect('/admin/doitac/listall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('doitac',['id'=>$id]);
        if(!$info)
            redirect('/admin/doitac/listall','refresh');

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Sửa Đối tác";
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
            redirect('/admin/doitac/listall','refresh');

        $this->MCommon->delete('doitac',['id'=>$id]);

        redirect('/admin/doitac/listall','refresh');

    }
}
