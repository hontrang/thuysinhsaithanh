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
        $this->load->model('MSlide2');
        $this->load->model('MCommon');
    }
    

    public function listallslide2()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('slide2',['id'=>$id]);
            if(!$info)
                redirect('/admin/slide2/listallslide2','refresh');

            //bai truoc
            $item_truoc = $this->MSlide->getPreItem('slide2',$info->orders);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'slide2',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'slide2',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('slide2',['id'=>$id]);
            if(!$info)
                redirect('/admin/slide2/listallslide2','refresh');

            //bai truoc
            $item_truoc = $this->MSlide->getNextItem('slide2',$info->orders);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'slide2',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'slide2',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/slide2/listallslide2/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','slide2');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','slide2',$config['per_page'],$start,"orders");
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

    public function addslide2()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Icon', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['image'] = $post_data['image'];
                $data_db['url'] = $post_data['url'];
                $data_db_lang['lang'] = 'vi';

                //get order max
                $order_max = $this->MCommon->getMaxOrder('slide2');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'slide2'))
                {
                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'slide2_lang');

                    redirect('/admin/slide2/listallslide2','refresh');
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

    public function editslide2()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/slide2/listallslide2','refresh');

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Icon', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['image'] = $post_data['image'];
                $data_db['url'] = $post_data['url'];

                if($this->MCommon->update($data_db,'slide2',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'slide2_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/slide2/listallslide2','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('slide2',['id'=>$id]);
        if(!$check)
            redirect('/admin/slide2/listallslide2','refresh');

        $info = $this->MCommon->getRow_lang($lang,'slide2',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'slide2_lang');
            $info = $this->MCommon->getRow_lang($lang,'slide2',['id'=>$id]);
        }


        $data['info'] = $info;

        //template

        $data['module'] = $module;
        $data['title'] = "Sửa";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function delslide2()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/slide2/listallslide2','refresh');

        $this->MCommon->delete('slide2',['id'=>$id]);
        $this->MCommon->delete('slide2_lang',['record_id'=>$id]);

        redirect('/admin/slide2/listallslide2','refresh');

    }

}
