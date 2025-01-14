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
        $this->load->model('MOrder');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/tour/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('tour');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('tour',$config['per_page'],$start,"id","desc");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách Tour";
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
                array('field' => 'name', 'label' => 'Tên Tour', 'rules' => 'required'),
                array('field' => 'code', 'label' => 'Mã Tour', 'rules' => 'required'),
                array('field' => 'time', 'label' => 'Thời gian', 'rules' => 'required'),
                array('field' => 'time_start', 'label' => 'Thời gian khởi hành', 'rules' => 'required'),
                array('field' => 'seat', 'label' => 'Số chỗ', 'rules' => 'required'),
                array('field' => 'price', 'label' => 'Giá', 'rules' => 'required'),
                array('field' => 'province_id', 'label' => 'Nơi xuất phát', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Danh mục', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình đại diện', 'rules' => 'required'),
                array('field' => 'schedule[]', 'label' => 'Chương trình Tour', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['code'] = $post_data['code'];
                $data_db['time'] = $post_data['time'];
                $data_db['time_start'] = $post_data['time_start'].":00";
                $data_db['seat'] = $post_data['seat'];
                $data_db['price'] = $post_data['price'];
                $data_db['province_id'] = (int)$post_data['province_id'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
                $data_db['detail'] = $post_data['detail'];
                $data_db['warning'] = $post_data['warning'];




                if($this->MCommon->insert($data_db,'tour'))
                {
                    $id_tour = $this->db->insert_id();
                    $schedule = $post_data['schedule'];
                    foreach ($schedule as $item){
                        $this->MCommon->insert(['tour_id'=>$id_tour,'name'=>$item['schedule_name'],'detail'=>$item['schedule_detail']],'tour_schedule');
                    }


                    //them chu de
                    if(!empty($post_data['filter'])){
                        foreach ($post_data['filter'] as $filter){
                            $this->MCommon->insert(['tour_id'=>$id_tour,'filter_id'=>$filter],'tour_filter');
                        }
                    }

                    redirect('/admin/tour/addimage/'.$id_tour,'refresh');
                    die();
                }
            }
        }

        $cats = $this->MCommon->getAllRow('tour_cat');
        if($cats)
            $data['cats'] = $cats;

        $provinces = $this->MCommon->getAllRow('province');
        if($provinces)
            $data['provinces'] = $provinces;


        $filters = $this->MCommon->getAllRow('filter');
        if($filters)
            $data['filters'] = $filters;

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
            redirect('/admin/tour/listall','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên Tour', 'rules' => 'required'),
                array('field' => 'code', 'label' => 'Mã Tour', 'rules' => 'required'),
                array('field' => 'time', 'label' => 'Thời gian', 'rules' => 'required'),
                array('field' => 'time_start', 'label' => 'Thời gian khởi hành', 'rules' => 'required'),
                array('field' => 'seat', 'label' => 'Số chỗ', 'rules' => 'required'),
                array('field' => 'price', 'label' => 'Giá', 'rules' => 'required'),
                array('field' => 'province_id', 'label' => 'Nơi xuất phát', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Danh mục', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình đại diện', 'rules' => 'required'),
                array('field' => 'schedule[]', 'label' => 'Chương trình Tour', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['code'] = $post_data['code'];
                $data_db['time'] = $post_data['time'];
                $data_db['time_start'] = $post_data['time_start'].":00";
                $data_db['seat'] = $post_data['seat'];
                $data_db['price'] = $post_data['price'];
                $data_db['province_id'] = (int)$post_data['province_id'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
                $data_db['detail'] = $post_data['detail'];
                $data_db['warning'] = $post_data['warning'];


                if($this->MCommon->update($data_db,'tour',['id'=>$id]))
                {
                    $id_tour = $id;
                    //xoa lich trinh cu di
                    $this->MCommon->delete('tour_schedule',['tour_id'=>$id_tour]);
                    //update lai
                    $schedule = $post_data['schedule'];
                    foreach ($schedule as $item){
                        $this->MCommon->insert(['tour_id'=>$id_tour,'name'=>$item['schedule_name'],'detail'=>$item['schedule_detail']],'tour_schedule');
                    }

                    //xoa chu de cu
                    $this->MCommon->delete('tour_filter',['tour_id'=>$id_tour]);
                    //them chu de
                    if(!empty($post_data['filter'])){
                        foreach ($post_data['filter'] as $filter){
                            $this->MCommon->insert(['tour_id'=>$id_tour,'filter_id'=>$filter],'tour_filter');
                        }
                    }

                    redirect('/admin/tour/addimage/'.$id_tour,'refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('tour',['id'=>$id]);
        if(!$info)
            redirect('/admin/tour/listall','refresh');

        $cats = $this->MCommon->getAllRow('tour_cat');
        if($cats)
            $data['cats'] = $cats;

        $provinces = $this->MCommon->getAllRow('province');
        if($provinces)
            $data['provinces'] = $provinces;

        $schedules = $this->MCommon->getAllRowByWhere('tour_schedule',['tour_id'=>$id]);
        if($schedules)
            $data['schedules'] = $schedules;

        $filters = $this->MCommon->getAllRow('filter');
        if($filters)
            $data['filters'] = $filters;

        $filter = $this->MCommon->getAllRowByWhere('tour_filter',['tour_id'=>$id]);
        if($filter){
            $filter_selected = null;
            foreach ($filter as $item){
                $filter_selected[] = $item->filter_id;
            }
            $data['filter_selected'] = $filter_selected;
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
            redirect('/admin/tour/listall','refresh');

        $this->MCommon->delete('tour',['id'=>$id]);
        $this->MCommon->delete('tour_image',['tour_id'=>$id]);
        $this->MCommon->delete('tour_filter',['tour_id'=>$id]);

        redirect('/admin/tour/listall','refresh');

    }


    public function listallcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('tour_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/tour/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MTour->getPreItem('tour_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'tour_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'tour_cat',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('tour_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/tour/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MTour->getNextItem('tour_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'tour_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'tour_cat',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/tour/listallcat/';
        $config['total_rows'] = $this->MTour->getTotalRow(0);
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MTour->getAllRowWithPage(0,$config['per_page'],$start,"orders");
        $pagination_link = $this->pagination->create_links();

        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MTour->getAllRowWithPage($item->id,10000,0,"orders");
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['list'] = $list_new;
        }




        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách Tour";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
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
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Danh mục cha', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['parent_id'] = (int)$post_data['parent_id'];

                //get order max
                $order_max = $this->MTour->getMaxOrder('tour_cat',$data_db['parent_id']);
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'tour_cat'))
                {
                    redirect('/admin/tour/listallcat','refresh');
                    die();
                }
            }
        }

        $listparent = $this->MCommon->getAllRow('tour_cat');
        if($listparent)
            $data['listparent'] = $listparent;



        //template
        $data['module'] = $module;
        $data['title'] = "Thêm mới";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function editcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/tour/listallcat','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Danh mục cha', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['parent_id'] = (int)$post_data['parent_id'];

                if($this->MCommon->update($data_db,'tour_cat',['id'=>$id]))
                {
                    redirect('/admin/tour/listallcat','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('tour_cat',['id'=>$id]);
        if(!$info)
            redirect('/admin/tour/listallcat','refresh');

        $listparent = $this->MCommon->getAllRowByWhere('tour_cat',['parent_id'=>0]);
        if($listparent)
            $data['listparent'] = $listparent;


        $data['info'] = $info;

        //template

        $data['module'] = $module;
        $data['title'] = "Sửa danh mục";
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
            redirect('/admin/tour/listallcat','refresh');

        $this->MCommon->delete('tour_cat',['id'=>$id]);

        redirect('/admin/tour/listallcat','refresh');

    }

    public function listallfilter()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('filter',['id'=>$id]);
            if(!$info)
                redirect('/admin/tour/listallfilter','refresh');

            //bai truoc
            $item_truoc = $this->MTour->getPreItem('filter',$info->orders);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'filter',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'filter',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('filter',['id'=>$id]);
            if(!$info)
                redirect('/admin/tour/listallfilter','refresh');

            //bai truoc
            $item_truoc = $this->MTour->getNextItem('filter',$info->orders);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'filter',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'filter',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/tour/listallfilter/';
        $config['total_rows'] = $this->MCommon->getTotalRow('filter');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('filter',$config['per_page'],$start,"orders");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách Chủ đề";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function addfilter()
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
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['icon'] = $post_data['image'];

                //get order max
                $order_max = $this->MTour->getMaxOrder('filter',null);
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'filter'))
                {
                    redirect('/admin/tour/listallfilter','refresh');
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

    public function editfilter()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/tour/listallfilter','refresh');

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
                $data_db['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['icon'] = $post_data['image'];


                if($this->MCommon->update($data_db,'filter',['id'=>$id]))
                {
                    redirect('/admin/tour/listallfilter','refresh');
                    die();
                }
            }
        }

        $info = $this->MCommon->getRow('filter',['id'=>$id]);
        if(!$info)
            redirect('/admin/tour/listallfilter','refresh');

        $data['info'] = $info;

        //template

        $data['module'] = $module;
        $data['title'] = "Sửa Chủ đề";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function delfilter()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/tour/listallfilter','refresh');

        $this->MCommon->delete('filter',['id'=>$id]);

        redirect('/admin/tour/listallfilter','refresh');

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
        if(!file_exists("public/userfiles/tour/".$id)){
            mkdir("public/userfiles/tour/".$id);
        }

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 500,
            'maxSize' => null,
            'fileMaxSize' => 20,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/userfiles/tour/'.$id.'/',
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
            $data_db['image'] = 'tour/'.$id.'/'.$data_db['name'];
            $data_db['tour_id'] = $id;

            $this->MCommon->insert($data_db,'tour_image');
        }

        // export to js
        echo json_encode($upload);
        exit;
    }
    public function delimage()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        if (isset($_POST['file'])) {
            $file = 'public/userfiles/tour/'.$id.'/' . $_POST['file'];

            $this->MCommon->delete('tour_image',['tour_id'=>$id,'name'=>$_POST["file"]]);

            if(file_exists($file))
                unlink($file);
        }
    }

    public function editimage()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        include('public/fileuploader/class.fileuploader.php');
        echo 'hehe';
        if (isset($_POST['fileuploader']) && isset($_POST['_file']) && isset($_POST['_editor'])) {
            echo 'yes';
            $file = str_replace("/public","public",$_POST['_file']);
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
            redirect('admin/tour/listall/','refresh');
        }

        $this->session->set_userdata("id_upload",$id);


        $images = $this->MCommon->getAllRowByWhere('tour_image',['tour_id'=>$id]);
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

        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/jquery.fileuploader.js"></script>';
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom.js"></script>';




        //template
        $data['module'] = $module;
        $data['scripts'] = $scripts;
        $data['title'] = "Thêm hình vào Tour";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }
}
