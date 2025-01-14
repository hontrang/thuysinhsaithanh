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
        $this->load->model('MConstruction');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/construction/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','construction');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','construction',$config['per_page'],$start,"orders DESC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        $list_cat = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List constructions";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function search()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);


        $name = $this->input->get("name");
        $cat_id = $this->input->get("cat_id");
        $code = $this->input->get("code");
        $hot = $this->input->get("hot");
        $new = $this->input->get("new");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/construction/listall/';
        $config['total_rows'] = $this->MConstruction->getTotalRowSearch('vi',$name,$cat_id,$code,$hot,$new);
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MConstruction->getAllRowWithPageSearch('vi',$name,$cat_id,$code,$hot,$new,$config['per_page'],$start,"orders DESC");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;


        $list_cat = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "List constructions";
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
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                //array('field' => 'price', 'label' => 'Price', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Category', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Image', 'rules' => 'required'),
                array('field' => 'detail', 'label' => 'Detail', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                //$data_db['price'] = $post_data['price'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
                $data_db_lang['detail'] = $post_data['detail'];
                $data_db_lang['description'] = $post_data['description'];
                //$data_db['price_discount'] = $post_data['price_discount'];



                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if(isset($post_data['is_new']))
                    $data_db['is_new'] = $post_data['is_new'];
                else
                    $data_db['is_new'] = 0;
				
				//get order max
                $order_max = $this->MConstruction->getMaxOrder('construction');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;

                if($this->MCommon->insert($data_db,'construction'))
                {
                    $id_construction = $this->db->insert_id();
                    $data_db_lang['record_id'] = $id_construction;
                    $this->MCommon->insert($data_db_lang,'construction_lang');

                  

                    redirect('/admin/construction/addimage/'.$id_construction,'refresh');
                    die();
                }
            }
        }

        $list = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }

        $list_constructions = $this->MCommon->getAllRow_lang('vi','construction');
        if($list_constructions)
            $data['list_constructions'] = $list_constructions;


        //template
        $data['module'] = $module;
        $data['title'] = "Add New";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function edit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/construction/listall','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                //array('field' => 'price', 'label' => 'Price', 'rules' => 'required'),
                array('field' => 'cat_id', 'label' => 'Category', 'rules' => 'required'),
                array('field' => 'image', 'label' => 'Image', 'rules' => 'required'),
                array('field' => 'detail', 'label' => 'Detail', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang == "vi")
                    $data_db['slug'] = create_slug($post_data['name']);
                //$data_db['price'] = $post_data['price'];
                $data_db['cat_id'] = (int)$post_data['cat_id'];
                $data_db['image'] = $post_data['image'];
                $data_db_lang['detail'] = $post_data['detail'];
                $data_db_lang['description'] = $post_data['description'];
                $data_db['id'] = $id;
                //$data_db['price_discount'] = $post_data['price_discount'];



                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if(isset($post_data['is_new']))
                    $data_db['is_new'] = $post_data['is_new'];
                else
                    $data_db['is_new'] = 0;

                if($this->MCommon->update($data_db,'construction',['id'=>$id]))
                {
                    $id_construction = $id;
                    $this->MCommon->update($data_db_lang,'construction_lang',['record_id'=>$id,'lang'=>$lang]);

                  

                    redirect('/admin/construction/addimage/'.$id,'refresh');
                    die();
                }
            }
        }

 
		
		$check = $this->MCommon->getRow('construction',['id'=>$id]);
        if(!$check)
            redirect('/admin/construction/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'construction',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'construction_lang');
            $info = $this->MCommon->getRow_lang($lang,'construction',['id'=>$id]);
        }
        $data['info'] = $info;
		

        $list = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['cats'] = $list_new;
        }
		

       

        $list_constructions = $this->MCommon->getAllRow_lang('vi','construction');
        if($list_constructions)
            $data['list_constructions'] = $list_constructions;


        $data['info'] = $info;

        //template
        $data['module'] = $module;
        $data['title'] = "Edit";
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
            redirect('/admin/construction/listall','refresh');

        $this->MCommon->delete('construction',['id'=>$id]);
        $this->MCommon->delete('construction_lang',['record_id'=>$id]);
        $this->MCommon->delete('construction_image',['construction_id'=>$id]);

        redirect('/admin/construction/listall','refresh');

    }


    public function listallcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow_lang('vi','construction_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/construction/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MConstruction->getPreItem('construction_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'construction_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'construction_cat',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow_lang('vi','construction_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/construction/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MConstruction->getNextItem('construction_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'construction_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'construction_cat',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/construction/listallcat/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','construction_cat');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','construction_cat',$config['per_page'],$start,"orders DESC, id DESC");
        $pagination_link = $this->pagination->create_links();

        if($list){
            $data['list'] = $list;
        }

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Category";
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
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Parent Category', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db['image'] = $post_data['image'];
				$data_db['parent_id'] = (int)$post_data['parent_id'];
                $data_db_lang['description'] = $post_data['description'];
                

                //get order max
                $order_max = $this->MConstruction->getMaxOrder('construction_cat',$data_db['parent_id']);
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'construction_cat'))
                {
                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'construction_cat_lang');
                    redirect('/admin/construction/listallcat','refresh');
                    die();
                }
            }
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($listparent)
            $data['listparent'] = $listparent;



        //template
        $data['module'] = $module;
        $data['title'] = "Add New";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function editcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/construction/listallcat','refresh');

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'parent_id', 'label' => 'Parent Category', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang=="vi")
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db['parent_id'] = (int)$post_data['parent_id'];
                $data_db['image'] = $post_data['image'];
                $data_db['id'] = $id;
                $data_db_lang['description'] = $post_data['description'];

                if($this->MCommon->update($data_db,'construction_cat',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'construction_cat_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/construction/listallcat','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('construction_cat',['id'=>$id]);
        if(!$check)
            redirect('/admin/construction/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'construction_cat',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'construction_cat_lang');
            $info = $this->MCommon->getRow_lang($lang,'construction_cat',['id'=>$id]);
        }
        $data['info'] = $info;

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','construction_cat',['parent_id'=>0]);
        if($listparent)
            $data['listparent'] = $listparent;



        //template

        $data['module'] = $module;
        $data['title'] = "Edit";
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
            redirect('/admin/construction/listallcat','refresh');

        $this->MCommon->delete('construction_cat',['id'=>$id]);
        $this->MCommon->delete('construction_cat_lang',['record_id'=>$id]);

        redirect('/admin/construction/listallcat','refresh');

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
        if(!file_exists("public/userfiles/construction_image/".$id)){
            mkdir("public/userfiles/construction_image/".$id);
        }
        if(!file_exists("public/small/construction_image/".$id)){
            mkdir("public/small/construction_image/".$id);
        }

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 500,
            'maxSize' => null,
            'fileMaxSize' => 20,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/userfiles/construction_image/'.$id.'/',
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
            $data_db['image'] = 'construction_image/'.$id.'/'.$data_db['name'];
            $data_db['construction_id'] = $id;

            $this->MCommon->insert($data_db,'construction_image');

            //tao anh nho
            FileUploader::resize('public/userfiles/construction_image/'.$id.'/'.$upload['files'][0]['name'], $width = 300, $height = 300, $destination = 'public/small/construction_image/'.$id.'/'.$upload['files'][0]['name'], $crop = false, $quality = 90, $rotation = 0);
        }

        // export to js
        echo json_encode($upload);
        exit;
    }
    public function delimage()
    {

        $id = (int)$this->session->userdata("id_upload");
        if($id == 0 or $id == ""){
            die;
        }

        if (isset($_POST['file'])) {
            $file = 'public/userfiles/construction_image/'.$id.'/' . $_POST['file'];

            $this->MCommon->delete('construction_image',['construction_id'=>$id,'name'=>$_POST["file"]]);

            if(file_exists($file))
                unlink($file);
        }
    }

    public function editimage()
    {

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
            redirect('admin/construction/listall/','refresh');
        }

        $this->session->set_userdata("id_upload",$id);


        $images = $this->MCommon->getAllRowByWhere('construction_image',['construction_id'=>$id]);
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
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom_construction.js"></script>';




        //template
        $data['module'] = $module;
        $data['scripts'] = $scripts;
        $data['title'] = "Thêm hình ảnh (nếu cần)";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function setstatus(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		
        $type = $this->input->get('type');
        $id = (int)$this->input->get('id');

        if($type == 'hot'){
            //kiem tra
            $info = $this->MCommon->getRow('construction',['id'=>$id]);
            if($info->is_hot == '0')
                $this->MCommon->update(['is_hot'=>1],'construction',['id'=>$id]);
            else
                $this->MCommon->update(['is_hot'=>0],'construction',['id'=>$id]);
        }
        if($type == 'new'){
            //kiem tra
            $info = $this->MCommon->getRow('construction',['id'=>$id]);
            if($info->is_new == '0')
                $this->MCommon->update(['is_new'=>1],'construction',['id'=>$id]);
            else
                $this->MCommon->update(['is_new'=>0],'construction',['id'=>$id]);
        }

        if($type == 'hide'){
            //kiem tra
            $info = $this->MCommon->getRow('construction',['id'=>$id]);
            if($info->hide == '0')
                $this->MCommon->update(['hide'=>1],'construction',['id'=>$id]);
            else
                $this->MCommon->update(['hide'=>0],'construction',['id'=>$id]);
        }
        echo json_encode(['error'=>0]);
        exit;
    }
	
	public function updateOrder(){
		
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		
		$orders_new = (int)$this->input->post('orders_new');
        $id = (int)$this->input->post('id');
		if($id == 0 or $id == ""){
            redirect('/admin/construction/listall/','refresh');
        }
		
		$this->MCommon->update(['orders'=>$orders_new],'construction',['id'=>$id]);
		echo 'upadated';
		exit;
	}
	
	public function syncOrder(){
		$module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
		$constructions = $this->MCommon->getAllRow('construction',null,'orders ASC');
		if($constructions){
			$i = 0;
			foreach($constructions as $construction){
				$this->MCommon->update(['orders'=>$i],'construction',['id'=>$construction->id]);
				$i++;
			}
		}
		redirect('/admin/construction/listall','refresh');
		exit;
	}
}
