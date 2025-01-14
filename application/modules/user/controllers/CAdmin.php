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
        $this->load->model('MUser');
        $this->load->model('MCommon');
    }

    public function listuser()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/user/listuser/';
        $config['total_rows'] = $this->MCommon->getTotalRow('users');
        $config['per_page'] = 2000;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);
		
        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('users',$config['per_page'],$start,"id desc");
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_project'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách thành viên";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	public function add()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        if($this->input->post("btnSubmit") != "") {

            $this->load->library('form_validation');
            $config = array(
                array('field' => 'username', 'label' => 'Tên đăng nhập', 'rules' => 'required|is_unique[users.username]'),
                array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'required'),
                array('field' => 'repassword', 'label' => 'Mật khẩu nhập lại', 'rules' => 'required|matches[password]'),
                array('field' => 'fullname', 'label' => 'Tên đầy đủ', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'phone', 'label' => 'SĐT', 'rules' => 'required|is_unique[users.phone]'),

            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('matches', 'Mật khẩu và nhập lại mật khẩu không giống nhau.');
            $this->form_validation->set_message('valid_email', '%s không đúng định dạng email. vd: abc@gmail.com');
            $this->form_validation->set_message('is_unique', '%s đã được sử dụng.');


            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['username'] = $post_data['username'];
                $data_db['password'] = $post_data['password'];
                $data_db['fullname'] = $post_data['fullname'];
                $data_db['email'] = $post_data['email'];
                $data_db['phone'] = $post_data['phone'];
               
                $data_db['password'] = md5(md5($data_db['password'])."datnguyen");
                if($this->MCommon->insert($data_db,'users') > 0)
                {
                    redirect('/admin/user/listuser','refresh');
                    die();
                }
            }

        }


        //template
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	public function quickadd()
    {
		exit;
		$this->load->library('XLSXReader','2.xlsx');
		$xlsx = new XLSXReader('2.xlsx');
		$sheet = $xlsx->getSheet('All');
		
		foreach($sheet->getData() as $row) {
			$name = $row[0];
			$phone = $row[1];
			$pass = $row[2];
			$email = $row[3];
			$count = strlen($phone);
			if($count < 10){
				$phone = '0'.$phone;
			}
			
			$data_db = [];
			$data_db['username'] = $phone;
			$data_db['password'] = md5(md5($pass)."datnguyen");
			$data_db['fullname'] = $name;
			$data_db['email'] = $email;
			$data_db['phone'] = $phone;
			$this->MCommon->insert($data_db,'users');
		}
		
	}

	public function escape($string) {
		return htmlspecialchars($string, ENT_QUOTES);
	}
	
	public function fix()
    {
		$users = $this->MCommon->getAllRow('users');
		foreach($users as $user){
			$phone = $user->phone;
			$count = strlen($phone);
			if($count < 10){
				$this->MCommon->update(['username'=>'0'.$phone,'phone'=>'0'.$phone],'users',['id'=>$user->id]);
			}
		}
	}
	
	
	
	
	public function search()
    {
        $module = $this->router->fetch_module();
		$semail = $this->input->post('semail');
		$sname = $this->input->post('sname');
		$saddress = $this->input->post('saddress');
		$sphone = $this->input->post('sphone');
        
		$list = $this->MUser->searchUser($semail,$sname,$saddress,$sphone);
        if($list)
            $data['list'] = $list;

        //template
        $data['module'] = $module;
        $data['title'] = "Tìm kiếm";
        $data['method'] = 'listuser';
        echo modules::run('template/getlayout/admin', $data);
    }
	
    public function edit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);
        $id = (int)$this->uri->segment(4);
        if($id == "" or $id == 0)
            redirect('/admin/user/listall','refresh');

        if($this->input->post("btnSubmit") != "") {

            $this->load->library('form_validation');
            $config = array(
                array('field' => 'username', 'label' => 'Tên đăng nhập', 'rules' => 'required'),
                array('field' => 'fullname', 'label' => 'Tên đầy đủ', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
                array('field' => 'phone', 'label' => 'SĐT', 'rules' => 'required'),

            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('matches', 'Mật khẩu và nhập lại mật khẩu không giống nhau.');
            $this->form_validation->set_message('valid_email', '%s không đúng định dạng email. vd: abc@gmail.com');
            $this->form_validation->set_message('is_unique', '%s đã được sử dụng.');


            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['username'] = $post_data['username'];
                $data_db['password'] = $post_data['password'];
                $data_db['fullname'] = $post_data['fullname'];
                $data_db['email'] = $post_data['email'];
                $data_db['phone'] = $post_data['phone'];
				
                if($post_data['password'] != ""){
                    $data_db['password'] = $post_data['password'];
                    $data_db['password'] = md5(md5($data_db['password'])."datnguyen");
                }

                


                if($this->MCommon->update($data_db,"users",['id'=>$id]))
                {

                    $this->session->set_flashdata("userinfo","Cập nhật thành công!");

                }
                else{
                    $this->session->set_flashdata("userinfo","Có lỗi xảy ra!");
                }
            }

        }

        $userinfo = $this->MCommon->getRow('users',['id'=>$id]);
        if(!$userinfo)
            redirect('/admin/user/listall','refresh');

        $data['userinfo'] = $userinfo;


        //template
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function del()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id == 0)
            redirect('/admin/user/listall','refresh');
        $this->MCommon->delete('users',['id'=>$id]);
        if($this->input->server('HTTP_REFERER') != "")
        {
            redirect($this->input->server('HTTP_REFERER'),'refresh');
        }

    }


    
}
