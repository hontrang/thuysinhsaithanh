<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/4/17 2:09 PM
 * Date: 10/4/17 2:53 PM
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
        $this->load->model('MContact');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $filter = $this->uri->segment(4);
        if($filter == ''){
            $filter = 'new';
            $view = 0;
        }
        elseif($filter == 'new')
        {
            $filter = 'new';
            $view = 0;
        }
        elseif($filter == 'old')
        {
            $filter = 'old';
            $view = 1;
        }
        else
            redirect('/admin/contact/listall/new','refresh');

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/cart/listall/'.$filter.'/';
        $config['total_rows'] = $this->MContact->getTotalRow($view);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(5)?$this->uri->segment(5):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MContact->getAllRowWithPage($view,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách liên hệ";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }



    public function view()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/contact/listall','refresh');


        $info = $this->MCommon->getRow('contact',['id'=>$id]);
        if(!$info)
            redirect('/admin/contact/listall','refresh');

        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Chi tiết";
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
            redirect('/admin/teacher/listall','refresh');

        $this->MCommon->delete('teacher',['id'=>$id]);

        redirect('/admin/teacher/listall','refresh');

    }
}
