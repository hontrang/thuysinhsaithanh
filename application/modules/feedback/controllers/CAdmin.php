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
        $this->load->model('MFeedback');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/feedback/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('feedback');
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('feedback',$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách Feedback";
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
                array('field' => 'work', 'label' => 'Nghề nghiệp', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Avatar', 'rules' => 'required'),
                array('field' => 'comment', 'label' => 'Nội dung Feedback', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['work'] = $post_data['work'];
                $data_db['image'] = $post_data['image'];
                $data_db['comment'] = $post_data['comment'];

                if($this->MCommon->insert($data_db,"feedback"))
                {
                    redirect('/admin/feedback/listall','refresh');
                    die();
                }
            }
        }


        //template
        $data['module'] = $module;
        $data['title'] = "Thêm Feedback";
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
            redirect('/admin/feedback/listall','refresh');

        if(!empty($this->input->post('submit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Tên khách hàng', 'rules' => 'required'),
                array('field' => 'work', 'label' => 'Nghề nghiệp', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Avatar', 'rules' => 'required'),
                array('field' => 'comment', 'label' => 'Nội dung Feedback', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['work'] = $post_data['work'];
                $data_db['image'] = $post_data['image'];
                $data_db['comment'] = $post_data['comment'];

                if($this->MCommon->update($data_db,'feedback',['id'=> $id]))
                {
                    redirect('/admin/feedback/listall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('feedback',['id'=>$id]);
        if(!$info)
            redirect('/admin/feedback/listall','refresh');

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Sửa Feedback";
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
            redirect('/admin/feedback/listall','refresh');

        $this->MCommon->delete('feedback',['id'=>$id]);

        redirect('/admin/feedback/listall','refresh');

    }
}
