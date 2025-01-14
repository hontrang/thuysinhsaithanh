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
        $this->load->model('MComment');
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
            $info = $this->MCommon->getRow('comment',['id'=>$id]);
            if(!$info)
                redirect('/admin/comment/listall','refresh');

            //bai truoc
            $item_truoc = $this->MComment->getPreItem('comment',$info->orders);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'comment',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'comment',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('comment',['id'=>$id]);
            if(!$info)
                redirect('/admin/hotel/listall','refresh');

            //bai truoc
            $item_truoc = $this->MComment->getNextItem('comment',$info->orders);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'comment',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'comment',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/comment/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('comment');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('comment',$config['per_page'],$start,"orders");
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
                array('field' => 'customer_name', 'label' => 'Tên khách hàng', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['customer_name'] = $post_data['customer_name'];
                $data_db['info'] = $post_data['info'];
                $data_db['content'] = $post_data['content'];

                //get order max
                $order_max = $this->MComment->getMaxOrder('comment');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'comment'))
                {
                    redirect('/admin/comment/listall','refresh');
                    die();
                }
            }
        }




        //template
        $data['module'] = $module;
        $data['title'] = "Thêm mới";
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
            redirect('/admin/comment/listallcomment','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'customer_name', 'label' => 'Tên khách hàng', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['customer_name'] = $post_data['customer_name'];
                $data_db['info'] = $post_data['info'];
                $data_db['content'] = $post_data['content'];

                if($this->MCommon->update($data_db,'comment',['id'=>$id]))
                {
                    redirect('/admin/comment/listall','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('comment',['id'=>$id]);
        if(!$info)
            redirect('/admin/comment/listall','refresh');


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
            redirect('/admin/comment/listall','refresh');

        $this->MCommon->delete('comment',['id'=>$id]);

        redirect('/admin/comment/listall','refresh');

    }



}
