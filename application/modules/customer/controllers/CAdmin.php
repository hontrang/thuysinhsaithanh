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
        $this->load->model('MCustomer');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','customer');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','customer',$config['per_page'],$start,"id DESC");
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
                array('field' => 'des', 'label' => 'Mô tả', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình đại diện', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Danh mục', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
                $data_db_lang['des'] = $post_data['des'];
                $data_db_lang['detail'] = $post_data['detail'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db_lang['lang'] = 'vi';

                if($this->MCommon->insert($data_db,'customer')){
                    $id_customer = $this->db->insert_id();
                    $data_db_lang['record_id'] = $id_customer;
                    $this->MCommon->insert($data_db_lang,'customer_lang');

                    redirect('/admin/customer/listall/','refresh');
                    die();
                }
            }
        }

        $list = $this->MCommon->getAllRowByWhere_lang('vi','customer_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
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
            redirect('/admin/customer/listall','refresh');

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'des', 'label' => 'Mô tả', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Danh mục', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Hình đại diện', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang == 'vi')
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
                $data_db_lang['des'] = $post_data['des'];
                $data_db_lang['detail'] = $post_data['detail'];
                if($this->MCommon->update($data_db,'customer',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'customer_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/customer/listall/','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('customer',['id'=>$id]);
        if(!$check)
            redirect('/admin/customer/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'customer',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'customer_lang');
            $info = $this->MCommon->getRow_lang($lang,'customer',['id'=>$id]);
        }

        $list = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
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
            redirect('/admin/customer/listall','refresh');

        $this->MCommon->delete('customer',['id'=>$id]);
        $this->MCommon->delete('customer_lang',['record_id'=>$id]);

        redirect('/admin/customer/listall','refresh');

    }


    public function listallcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('customer_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/customer/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getPreItem('customer_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'customer_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'customer_cat',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('customer_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/customer/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getNextItem('customer_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'customer_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'customer_cat',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/listallcat/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','customer_cat');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','customer_cat',$config['per_page'],$start,"orders ASC");
        $pagination_link = $this->pagination->create_links();

        if($list){
            $data['list'] = $list;
        }




        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách";
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
                array('field' => 'image', 'label' => 'Banner', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db_lang['lang'] = 'vi';
                $data_db_lang['image'] = $post_data['image'];

                //get order max
                $order_max = $this->MCommon->getMaxOrder('customer_cat');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'customer_cat'))
                {
                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'customer_cat_lang');

                    redirect('/admin/customer/listallcat','refresh');
                    die();
                }
            }
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','customer_cat',['parent_id'=>0]);
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
            redirect('/admin/customer/listallcat','refresh');

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

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
                if($lang == 'vi')
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db_lang['image'] = $post_data['image'];
                $data_db['id'] = $id;

                if($this->MCommon->update($data_db,'customer_cat',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'customer_cat_lang',['record_id'=>$id,'lang'=>$lang]);

                    redirect('/admin/customer/listallcat','refresh');
                    die();
                }
            }
        }


        $check = $this->MCommon->getRow('customer_cat',['id'=>$id]);
        if(!$check)
            redirect('/admin/customer/listallcat','refresh');

        $info = $this->MCommon->getRow_lang($lang,'customer_cat',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'customer_cat_lang');
            $info = $this->MCommon->getRow_lang($lang,'customer_cat',['id'=>$id]);
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','customer_cat',['parent_id'=>0]);
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
            redirect('/admin/customer/listallcat','refresh');

        $this->MCommon->delete('customer_cat',['id'=>$id]);
        $this->MCommon->delete('customer_cat_lang',['record_id'=>$id]);

        redirect('/admin/customer/listallcat','refresh');

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
        if(!file_exists("public/userfiles/customer/".$id)){
            mkdir("public/userfiles/customer/".$id);
        }

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 500,
            'maxSize' => null,
            'fileMaxSize' => 20,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/userfiles/customer/'.$id.'/',
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
            $data_db['image'] = 'customer/'.$id.'/'.$data_db['name'];
            $data_db['customer_id'] = $id;

            $this->MCommon->insert($data_db,'customer_image');
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
            $file = 'public/userfiles/customer/'.$id.'/' . $_POST['file'];

            $this->MCommon->delete('customer_image',['customer_id'=>$id,'name'=>$_POST["file"]]);

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
            redirect('admin/customer/listall/','refresh');
        }

        $this->session->set_userdata("id_upload",$id);


        $images = $this->MCommon->getAllRowByWhere('customer_image',['customer_id'=>$id]);
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
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom_customer.js"></script>';




        //template
        $data['module'] = $module;
        $data['scripts'] = $scripts;
        $data['title'] = "Thêm hình";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }
    public function subscribe()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/subscribe/';
        $config['total_rows'] = $this->MCommon->getTotalRow('subscribe');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('subscribe',$config['per_page'],$start,"id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách đăng ký nhận tin";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function subscribedel()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/subscribe','refresh');

        $this->MCommon->delete('subscribe',['id'=>$id]);

        redirect('/admin/customer/subscribe','refresh');

    }

    public function contact()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/contact/';
        $config['total_rows'] = $this->MCommon->getTotalRow('contact');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('contact',$config['per_page'],$start,"id DESC");
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

    public function contactview()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/contact','refresh');


        $info = $this->MCommon->getRow('contact',['id'=>$id]);
        if($info){
            $data['info'] = $info;
        }

        //update view
        $this->MCommon->update(['view'=>$info->view+1],'contact',['id'=>$info->id]);

        //template

        $data['module'] = $module;
        $data['title'] = "Xem chi tiết";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }


    public function contactdel()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/contact','refresh');

        $this->MCommon->delete('contact',['id'=>$id]);

        redirect('/admin/customer/contact','refresh');

    }


    public function booking()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/booking/';
        $config['total_rows'] = $this->MCommon->getTotalRow('booking');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('booking',$config['per_page'],$start,"id DESC");
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

    public function bookingview()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/booking','refresh');


        $info = $this->MCommon->getRow('booking',['id'=>$id]);
        if($info){
            $data['info'] = $info;
        }

        $doctor = $this->MCommon->getRow_lang('vi','doctor',['id'=>$info->doctor_id]);
        if($doctor)
            $data['doctor'] = $doctor;

        $department = $this->MCommon->getRow_lang('vi','doctor_department',['id'=>$info->department_id]);
        if($department)
            $data['department'] = $department;

        //update view
        $this->MCommon->update(['view'=>$info->view+1],'booking',['id'=>$info->id]);

        //template

        $data['module'] = $module;
        $data['title'] = "Xem chi tiết";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function bookingdel()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/booking','refresh');

        $this->MCommon->delete('booking',['id'=>$id]);

        redirect('/admin/customer/booking','refresh');

    }


    public function ask()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/customer/ask/';
        $config['total_rows'] = $this->MCommon->getTotalRow('ask');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('ask',$config['per_page'],$start,"id DESC");
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

    public function askview()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/customer/advisory','refresh');


        $this->load->library('form_validation');
        if(!empty($this->input->post('btnSubmit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Họ và Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
                array('field' => 'age', 'label' => 'Năm Sinh', 'rules' => 'required'),
                array('field' => 'title', 'label' => 'Tiều đề', 'rules' => 'required'),
                array('field' => 'detail', 'label' => 'Nội dung câu hỏi', 'rules' => 'required'),
                array('field' => 'answer', 'label' => 'Nội dung trả lời', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Ảnh đại diện', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['email'] = $post_data['email'];
                $data_db['age'] = $post_data['age'];
                $data_db['phone'] = $post_data['phone'];
                $data_db['address'] = $post_data['address'];
                $data_db['title'] = $post_data['title'];
                $data_db['detail'] = $post_data['detail'];
                $data_db['answer'] = $post_data['answer'];
                $data_db['image'] = $post_data['image'];



                if($this->MCommon->update($data_db,'ask',['id'=>$id]))
                {
                    $data_db['id'] = $id;
                    $data_mail = $data_db;

                    $this->sendMail($data_mail);
                    redirect(site_url('/admin/customer/ask'),'refresh');
                    die();
                }
            }
        }


        $info = $this->MCommon->getRow('ask',['id'=>$id]);
        if($info){
            $data['info'] = $info;

            $this->MCommon->update(['view'=>1],'ask',['id'=>$info->id]);
        }


        //template

        $data['module'] = $module;
        $data['title'] = "Xem chi tiết";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    private function sendMail($data_mail){
        //$email  = $this->MCommon->getRow('config',['k'=>'email']);
        $title  = $this->MCommon->getRow('config',['k'=>'title_en']);

        $url = site_url('khach-hang/tu-van-hoi-dap/'.create_slug($data_mail['title']).'-'.$data_mail['id']);

        $time = time();
        $content = '';
        $content .='<strong>Chào </strong>: '.$data_mail['name'].'<br /><br />';
        $content .='Câu hỏi về <strong>'.$data_mail['title'].'</strong> đã được chúng tôi trả lời.<br /><br />';
        $content .='Bạn có thể xem câu trả lời tại địa chỉ sau: <a target="_blank" href="'.$url.'">'.$url.'</a>';



        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = "sender@dos.vn";
        $config['smtp_pass'] = "fdbhbibbonploilc";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('sender@dos.vn',$title->value);
        $this->email->to($data_mail['email']);
        $this->email->subject('Thông tin phản hồi #'.$time);
        $this->email->message($content);
        $this->email->send();


    }

}
