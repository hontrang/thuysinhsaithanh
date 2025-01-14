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
        $this->load->model('MNews');
        $this->load->model('MCommon');
    }

    public function buildServices()
    {
        $news = $this->MCommon->getAllRowByWhere('table_news',['type'=>'dichvu'],null,"stt ASC, id DESC");
        if($news){
            foreach ($news as $n){
                $data_db_lang['name'] = $n->ten;
                $data_db['slug'] = create_slug($data_db_lang['name']);
                $data_db['image'] = 'news/'.$n->photo;
                $data_db_lang['des'] = $n->mota;
                $data_db_lang['detail'] = $n->noidung;
                $data_db['cat_id'] = 1;
                $data_db_lang['lang'] = 'vi';
                $data_db['is_hot'] = $n->noibat;
                $data_db['hide'] = $n->hienthi*-1;
                $data_db['view'] = $n->luotxem;
                $data_db['id'] = $n->id;

                if($this->MCommon->insert($data_db,'services')){
                    $id_news = $n->id;
                    $data_db_lang['record_id'] = $id_news;
                    $this->MCommon->insert($data_db_lang,'services_lang');

                }
            }
        }
    }
    public function buildNews()
    {
        $news = $this->MCommon->getAllRowByWhere('table_news',['type'=>'tintuc'],null,"stt ASC, id DESC");
        if($news){
            foreach ($news as $n){
                $data_db_lang['name'] = $n->ten;
                $data_db['slug'] = create_slug($data_db_lang['name']);
                $data_db['image'] = 'news/'.$n->photo;
                $data_db_lang['des'] = $n->mota;
                $data_db_lang['detail'] = $n->noidung;
                $data_db['cat_id'] = 9;
                $data_db_lang['lang'] = 'vi';
                $data_db['is_hot'] = $n->noibat;
                $data_db['hide'] = $n->hienthi*-1;
                $data_db['view'] = $n->luotxem;
                $data_db['id'] = $n->id;

                if($this->MCommon->insert($data_db,'news')){
                    $id_news = $n->id;
                    $data_db_lang['record_id'] = $id_news;
                    $this->MCommon->insert($data_db_lang,'news_lang');

                }
            }
        }
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/news/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','news');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','news',$config['per_page'],$start,"id DESC");
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

                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if($this->MCommon->insert($data_db,'news')){
                    $id_news = $this->db->insert_id();
                    $data_db_lang['record_id'] = $id_news;
                    $this->MCommon->insert($data_db_lang,'news_lang');

                    redirect('/admin/news/listall/','refresh');
                    die();
                }
            }
        }

        $list = $this->MCommon->getAllRowByWhere_lang('vi','news_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang('vi','news_cat',['parent_id'=>$item->id]);
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
            redirect('/admin/news/listall','refresh');

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
                if(isset($post_data['is_hot']))
                    $data_db['is_hot'] = $post_data['is_hot'];
                else
                    $data_db['is_hot'] = 0;

                if($this->MCommon->update($data_db,'news',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'news_lang',['record_id'=>$id,'lang'=>$lang]);
                    redirect('/admin/news/listall/','refresh');
                    die();
                }
            }
        }

        $check = $this->MCommon->getRow('news',['id'=>$id]);
        if(!$check)
            redirect('/admin/news/listall','refresh');

        $info = $this->MCommon->getRow_lang($lang,'news',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'news_lang');
            $info = $this->MCommon->getRow_lang($lang,'news',['id'=>$id]);
        }

        $list = $this->MCommon->getAllRowByWhere_lang($lang,'news_cat',['parent_id'=>0]);
        if($list){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'news_cat',['parent_id'=>$item->id]);
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
            redirect('/admin/news/listall','refresh');

        $this->MCommon->delete('news',['id'=>$id]);
        $this->MCommon->delete('news_lang',['record_id'=>$id]);

        redirect('/admin/news/listall','refresh');

    }


    public function listallcat()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $act = $this->input->get('order');
        if($act == "up"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('news_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/news/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getPreItem('news_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                //print_r($item_truoc);
                $this->MCommon->update(['orders'=>$item_truoc->orders],'news_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'news_cat',['id'=>$item_truoc->id]);
            }

        }
        if($act == "down"){
            $id = (int)$this->input->get('id');
            $info = $this->MCommon->getRow('news_cat',['id'=>$id]);
            if(!$info)
                redirect('/admin/news/listallcat','refresh');

            //bai truoc
            $item_truoc = $this->MCommon->getNextItem('news_cat',$info->orders,$info->parent_id);
            if($item_truoc){
                $this->MCommon->update(['orders'=>$item_truoc->orders],'news_cat',['id'=>$id]);
                $this->MCommon->update(['orders'=>$info->orders],'news_cat',['id'=>$item_truoc->id]);
            }
        }

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/news/listallcat/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang('vi','news_cat');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage_lang('vi','news_cat',$config['per_page'],$start,"orders ASC");
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
                //array('field' => 'image', 'label' => 'Banner', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                $data_db['slug'] = create_slug($post_data['name']);
                $data_db_lang['lang'] = 'vi';
                $data_db_lang['image'] = '';

                //get order max
                $order_max = $this->MCommon->getMaxOrder('news_cat');
                if($order_max)
                    $data_db['orders'] = $order_max->orders + 1;
                else
                    $data_db['orders'] = 0;


                if($this->MCommon->insert($data_db,'news_cat'))
                {
                    $data_db_lang['record_id'] = $this->db->insert_id();
                    $this->MCommon->insert($data_db_lang,'news_cat_lang');

                    redirect('/admin/news/listallcat','refresh');
                    die();
                }
            }
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','news_cat',['parent_id'=>0]);
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
            redirect('/admin/news/listallcat','refresh');

        //change lang
        $lang = 'vi';
        if($this->input->get("langchange") != "")
            $lang = $this->input->get("langchange");

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên', 'rules' => 'required'),
                //array('field' => 'image', 'label' => 'Banner', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db_lang['name'] = $post_data['name'];
                if($lang == 'vi')
                    $data_db['slug'] = create_slug($post_data['name']);
                $data_db_lang['image'] = '';
                $data_db['id'] = $id;

                if($this->MCommon->update($data_db,'news_cat',['id'=>$id]))
                {
                    $this->MCommon->update($data_db_lang,'news_cat_lang',['record_id'=>$id,'lang'=>$lang]);

                    redirect('/admin/news/listallcat','refresh');
                    die();
                }
            }
        }


        $check = $this->MCommon->getRow('news_cat',['id'=>$id]);
        if(!$check)
            redirect('/admin/news/listallcat','refresh');

        $info = $this->MCommon->getRow_lang($lang,'news_cat',['id'=>$id]);
        if(!$info){
            $this->MCommon->insert(['record_id'=>$id,'lang'=>$lang],'news_cat_lang');
            $info = $this->MCommon->getRow_lang($lang,'news_cat',['id'=>$id]);
        }

        $listparent = $this->MCommon->getAllRowByWhere_lang('vi','news_cat',['parent_id'=>0]);
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
            redirect('/admin/news/listallcat','refresh');

        $this->MCommon->delete('news_cat',['id'=>$id]);
        $this->MCommon->delete('news_cat_lang',['record_id'=>$id]);

        redirect('/admin/news/listallcat','refresh');

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
        if(!file_exists("public/userfiles/news/".$id)){
            mkdir("public/userfiles/news/".$id);
        }

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 500,
            'maxSize' => null,
            'fileMaxSize' => 20,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/userfiles/news/'.$id.'/',
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
            $data_db['image'] = 'news/'.$id.'/'.$data_db['name'];
            $data_db['news_id'] = $id;

            $this->MCommon->insert($data_db,'news_image');
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
            $file = 'public/userfiles/news/'.$id.'/' . $_POST['file'];

            $this->MCommon->delete('news_image',['news_id'=>$id,'name'=>$_POST["file"]]);

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
            redirect('admin/news/listall/','refresh');
        }

        $this->session->set_userdata("id_upload",$id);


        $images = $this->MCommon->getAllRowByWhere('news_image',['news_id'=>$id]);
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
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom_news.js"></script>';




        //template
        $data['module'] = $module;
        $data['scripts'] = $scripts;
        $data['title'] = "Thêm hình";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }
}
