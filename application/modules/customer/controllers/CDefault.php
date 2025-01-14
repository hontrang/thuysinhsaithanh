<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 2:12 PM
 * Date: 9/15/17 3:05 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/30/17 2:35 PM
 * Date: 9/15/17 10:42 AM
 *
 */

/**
 * Class customert
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MCustomer');
        $this->load->model('MCommon');
    }

    public function index(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'khach-hang/';
        $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'customer');
        $config['per_page'] = 10;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'customer',$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list_item'] = $list_item;


        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("customer") => '',

        ];


        $scripts[] = '';

        //banner
        $banner = $this->MCommon->getRow_lang($lang,'customer_cat',null,"orders ASC");
        if($banner)
            $data['bannerimage'] = $banner->image;
        //template
        $data['title'] = $this->lang->line("customer");
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;

        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function listbycat(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);

        //kiem tra danh muc
        $check = $this->MCommon->getRow('customer_cat',['slug'=>$slug]);
        if(!$check)
            redirect(site_url(),'refresh');

        $cat = $this->MCommon->getRow_lang($lang,'customer_cat',['slug'=>$slug]);
        if(!$cat)
            redirect(site_url(),'refresh');


        $this->config->load('pagination');
        $config['base_url'] = site_url().'khach-hang/'.$slug.'/';

        if($cat->parent_id != "0"){
            $config['total_rows'] = $this->MCommon->getTotalRow_lang($lang,'customer',['cat_id'=>$cat->id]);
        }
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$cat->id]);
            if($get_sub){
                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }
            $config['total_rows'] = $this->MCommon->getTotalRowWithWhereIn_lang($lang,'customer','cat_id',$ids);

        }

        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];

        if($cat->parent_id != "0")
            $list_item = $this->MCommon->getAllRowWithPage_lang($lang,'customer',$config['per_page'],$start,null,['cat_id'=>$cat->id]);
        else{
            $ids = null;
            $ids[] = $cat->id;
            $get_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$cat->id]);
            if($get_sub){

                foreach ($get_sub as $item){
                    $ids[]=$item->id;
                }
            }

            $list_item = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'customer',$config['per_page'],$start,null,'cat_id',$ids);

        }

        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list_item'] = $list_item;



        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        $current_parent_id = $cat->parent_id;
        if($cat->parent_id != 0)
            $current_parent_id = $cat->parent_id;

        $data['current_parent_id'] = $current_parent_id;

        $data['current_slug'] = $slug;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("customer") => 'khach-hang',
            $cat->name => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $cat->name;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;
        $data['bannerimage'] = $cat->image;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

	public function view(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(2);
        $id = (int)get_id($slug);
        $check = $this->MCommon->getRow('customer',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $customer = $this->MCommon->getRow_lang($lang,'customer',['id'=>$id]);
        if(!$customer)
            redirect(site_url(),'refresh');


        //cat
        $cat = $this->MCommon->getRow_lang($lang,'customer_cat',['id'=>$customer->cat_id]);
        if($cat)
            $data['cat'] = $cat;

        //update view
        $this->MCommon->update(['view'=>$customer->view+1],'customer',['id'=>$customer->id]);

        $data['info'] = $customer;


        //cung danh muc
        $cat_related = $this->MCommon->getAllRowByWhere_lang($lang,'customer',['cat_id'=>$cat->id, 'id !='=>$customer->id],3);
        if($cat_related)
            $data['cat_related'] = $cat_related;

        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("customer") => 'khach-hang',
            $cat->name => '/khach-hang/'.$cat->slug,
            max_len($customer->name,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $customer->name;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['bannerimage'] = $cat->image;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function datlichhen(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->load->library('form_validation');
        if(!empty($this->input->post('btnSubmit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Họ và Tên', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'Số điện thoại', 'rules' => 'required'),
                array('field' => 'address', 'label' => 'Địa chỉ', 'rules' => 'required'),
                array('field' => 'sex', 'label' => 'Giới tính', 'rules' => 'required'),
                array('field' => 'age', 'label' => 'Năm Sinh', 'rules' => 'required'),
                array('field' => 'date_booking', 'label' => 'Thời gian hẹn khám', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['phone'] = $post_data['phone'];
                $data_db['address'] = $post_data['address'];
                $data_db['sex'] = $post_data['sex'];
                $data_db['age'] = $post_data['age'];
                $data_db['date_booking'] = $post_data['date_booking'];
                if(!empty($post_data['department_id']))
                    $data_db['department_id'] = $post_data['department_id'];
                if(!empty($post_data['doctor_id']))
                    $data_db['doctor_id'] = $post_data['doctor_id'];
                if(!empty($post_data['email']))
                    $data_db['email'] = $post_data['email'];
                else
                    $data_db['email'] = '';
                if(!empty($post_data['note']))
                    $data_db['note'] = $post_data['note'];
                else
                    $data_db['note'] = '';

                if($this->MCommon->insert($data_db,'booking'))
                {
                    $data_mail = $data_db;

                    $doctor = false;
                    $department = false;
                    if(!empty($post_data['doctor_id']))
                        $doctor = $this->MCommon->getRow_lang('vi','doctor',['id'=>$data_db['doctor_id']]);
                        if($doctor)
                            $data_mail['doctor'] = $doctor->name;
                        else
                            $data_mail['doctor'] = '';

                    if(!empty($post_data['department_id']))
                        $department = $this->MCommon->getRow_lang('vi','doctor_department',['id'=>$data_db['department_id']]);
                        if($department)
                            $data_mail['department'] = $department->name;
                        else
                            $data_mail['department'] = '';

                    if($data_mail['sex'] == 1)
                        $data_mail['sex'] = "Nam";
                    else
                        $data_mail['sex'] = "Nữ";

                    $this->sendMail($data_mail);

                    $this->session->set_flashdata("booking_msg","Lịch hẹn của bạn đã được gửi!");
                    redirect(site_url('/khach-hang/dat-lich-hen'),'refresh');
                    die();
                }
            }
        }


        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $data['menu_cats'] = $list_cat;
        }

        $list = $this->MCommon->getAllRow_lang($lang,'doctor_department');
        if($list){
            $data['cats'] = $list;
        }

        $doctors = $this->MCommon->getAllRow_lang($lang,'doctor');
        if($doctors){
            $data['doctors'] = $doctors;
        }


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking") => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $this->lang->line("booking");
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    private function sendMail($data_mail){
        $email  = $this->MCommon->getRow('config',['k'=>'email']);
        $title  = $this->MCommon->getRow('config',['k'=>'title_en']);

        $time = time();
        $content = '';
        $content .='-<strong>Thời gian nhận</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
        $content .='-<strong>Tên Khách Hàng</strong>: '.$data_mail['name'].'<br /><br />';
        $content .='-<strong>Giới tính</strong>: '.$data_mail['sex'].'<br /><br />';
        $content .='-<strong>Năm sinh</strong>: '.$data_mail['age'].'<br /><br />';
        $content .='-<strong>Số điện thoại</strong>: '.$data_mail['phone'].'<br /><br />';
        $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
        $content .='-<strong>Địa chỉ</strong>: '.$data_mail['address'].'<br /><br />';
        $content .='-<strong>Thời gian muốn khám bệnh</strong>: '.$data_mail['date_booking'].'<br /><br />';
        $content .='-<strong>Bác sỹ yếu cầu</strong>: '.$data_mail['doctor'].'<br /><br />';
        $content .='-<strong>Phòng ban - Khoa</strong>: '.$data_mail['department'].'<br /><br />';
        $content .='-<strong>Ghi chú</strong>: '.$data_mail['note'].'<br /><br />';



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
        $this->email->to($email->value);
        $this->email->subject('Thông tin đặt lịch khám #'.$time);
        $this->email->message($content);
        $this->email->send();


    }
	
	private function sendMailTV($data_mail){
        $email  = $this->MCommon->getRow('config',['k'=>'email']);
        $title  = $this->MCommon->getRow('config',['k'=>'title_en']);

        $time = time();
        $content = '';
        $content .='-<strong>Thời gian nhận</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
        $content .='-<strong>Tên Khách Hàng</strong>: '.$data_mail['name'].'<br /><br />';
        $content .='-<strong>Giới tính</strong>: '.$data_mail['sex'].'<br /><br />';
        $content .='-<strong>Năm sinh</strong>: '.$data_mail['age'].'<br /><br />';
        $content .='-<strong>Số điện thoại</strong>: '.$data_mail['phone'].'<br /><br />';
        $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
        $content .='-<strong>Địa chỉ</strong>: '.$data_mail['address'].'<br /><br /><br />';
        $content .='-<strong>Tiêu đề</strong>: '.$data_mail['title'].'<br /><br />';
        $content .='-<strong>Nội dung câu hỏi</strong>: '.$data_mail['detail'].'<br /><br /><br />';
        $content .='<strong><a href="http://shingmarkhospital.com.vn/admin/customer/advisoryview/'.$data_mail['id'].'">Xem chi tiết câu hỏi</a></strong><br /><br />';
		
		/*
		http://shingmarkhospital.com.vn/admin/customer/advisoryview/15
		
		$data_db['name'] = $post_data['name'];
                $data_db['email'] = $post_data['email'];
                $data_db['age'] = $post_data['age'];
                $data_db['sex'] = $post_data['sex'];
                $data_db['phone'] = $post_data['phone'];
                $data_db['address'] = $post_data['address'];
                $data_db['title'] = $post_data['title'];
                $data_db['detail'] = $post_data['detail'];
				*/



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
        $this->email->to($email->value);
        $this->email->subject('Yêu cầu tư vấn #'.$time);
        $this->email->message($content);
        $this->email->send();


    }


    public function ask(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $fullname = $this->input->post("fullname");
        $email = $this->input->post("email");
        $content = $this->input->post("content");
        if($fullname == ""){
            $repo['error'] = 1;
            $repo['msg'] = "Họ tên không được để trống";
        }
        else if($email == ""){
            $repo['error'] = 1;
            $repo['msg'] = "Email không được để trống";
        }
        else if($content == ""){
            $repo['error'] = 1;
            $repo['msg'] = "Nội dung không được để trống";
        }
        else{
            $this->MCommon->insert(['fullname'=>$fullname,'email'=>$email,'content'=>$content],'ask');
            $repo['error'] = 0;
            $repo['msg'] = "Câu hỏi của bạn đã được gửi đến chúng tôi!";
        }



        echo json_encode($repo);
    }
    private function getFileExt($file)
    {
        $temp = explode(".",$file);
        $file_ext = $temp[count($temp)-1];
        return $file_ext;
    }


    public function upload()
    {

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
        if(!file_exists("public/temp_upload")){
            mkdir("public/temp_upload");
        }

        // initialize FileUploader
        $FileUploader = new FileUploader('files', array(
            'limit' => 10,
            'maxSize' => null,
            'fileMaxSize' => 2,
            'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
            'required' => false,
            'uploadDir' => 'public/temp_upload/',
            'title' => 'name',
            'replace' => $fileuploader_replace,
            'listInput' => true,
            'files' => null
        ));

        // call to upload the files
        $upload = $FileUploader->upload();

        //update database
        /*
        if($upload['hasWarnings'] == false and $upload['isSuccess'] == true){
            $data_db['name'] = $upload['files'][0]['name'];
            $data_db['size'] = $upload['files'][0]['size'];
            $data_db['type'] = $upload['files'][0]['type'];
            $data_db['image'] = 'customer/'.$id.'/'.$data_db['name'];
            $data_db['customer_id'] = $id;

            $this->MCommon->insert($data_db,'customer_image');
        }
        */

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
            $file = 'public/temp_upload/' . $_POST['file'];

            //$this->MCommon->delete('customer_image',['customer_id'=>$id,'name'=>$_POST["file"]]);

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


    public function tuvanhoidap(){
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->config->load('pagination');
        $config['base_url'] = site_url().'khach-hang/tu-van-hoi-dap';
        $config['total_rows'] = $this->MCommon->getTotalRow('advisory',['answer !='=>'']);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list_item = $this->MCommon->getAllRowWithPage('advisory',$config['per_page'],$start,null,['answer !='=>'']);
        $pagination_link = $this->pagination->create_links();

        if($list_item)
            $data['list_item'] = $list_item;

        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        $data['current_parent_id'] = '';

        $data['current_slug'] = '';

        $scripts[] = '<script>var image_list = null;</script>';
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/jquery.fileuploader.js"></script>';
        $scripts[] = '<script type="text/javascript" src="/public/fileuploader/js/custom_advisory.js"></script>';

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("advisory") => '',

        ];


        $scripts[] = '';

        //template
        $data['title'] = $this->lang->line("advisory");
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['breadcrumb'] = $breadcrumb;

        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }


    public function tuvanhoidapview(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);
        $check = $this->MCommon->getRow('advisory',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $advisory = $this->MCommon->getRow('advisory',['id'=>$id]);
        if(!$advisory)
            redirect(site_url(),'refresh');


        $data['info'] = $advisory;


        //cung danh muc
        $cat_related = $this->MCommon->getAllRowByWhere('advisory',['id !='=>$advisory->id,'answer !='=>''],5);
        if($cat_related)
            $data['cat_related'] = $cat_related;

        $list_cat = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>0]);
        if($list_cat){
            $i = 0;
            $list_new = new stdClass();
            foreach ($list_cat as $item){
                $list_new->{$i} = new stdClass();
                $list_new->{$i} = $item;
                $list_sub = $this->MCommon->getAllRowByWhere_lang($lang,'customer_cat',['parent_id'=>$item->id]);
                if($list_sub){
                    $list_new->{$i}->sub = new stdClass();
                    $list_new->{$i}->sub = $list_sub;
                }
                $i++;
            }
            $data['menu_cats'] = $list_new;
        }

        //images
        $images = $this->MCommon->getAllRowByWhere('advisory_image',['advisory_id'=>$id]);
        if($images)
            $data['images'] = $images;


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("advisory") => 'khach-hang/tu-va-hoi-dap',
            max_len($advisory->title,150) => '',

        ];

        $scripts[] = '';

        //template
        $data['title'] = $advisory->title;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }


}
