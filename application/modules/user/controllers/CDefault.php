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
 * Class Cart
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('bds/MBds');
        $this->load->model('MCommon');
    }


	public function login(){

        $this->load->library('form_validation');
        if(!empty($this->input->post('username'))) {
            $config = array(
                array('field' => 'username', 'label' => 'Tên đăng nhập', 'rules' => 'required'),
                array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $check = $this->MCommon->getRow('users',['username'=>$post_data['username'],'password'=>md5(md5($post_data['password'])."datnguyen"),'is_admin'=>0]);
                if($check){
                    $this->session->set_userdata("is_login",1);
                    $this->session->set_userdata("username",$check->username);
                    $this->session->set_userdata("fullname",$check->fullname);
                    $this->session->set_userdata("address",$check->address);
                    $this->session->set_userdata("phone",$check->phone);
                    $this->session->set_userdata("email",$check->email);
                    $this->session->set_userdata("userid",$check->id);
                    $repo['error'] = 0;
                    $repo['msg'] = 'Đăng nhập thành công!';
                }
                else{
                    $repo['error'] = 1;
                    $repo['msg'] = 'Thông tin tài khoản không chính xác!';
                }
            }
            else{
                $repo['error'] = 1;
                $repo['msg'] = validation_errors();
            }

            echo json_encode($repo);
        }


    }

    public function logout(){

        $this->session->sess_destroy();
        redirect(site_url(),'refresh');
    }

    public function register2(){

        $this->load->library('form_validation');
        if(!empty($this->input->post('username'))) {
            $config = array(
                array('field' => 'fullname', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'username', 'label' => 'Tên đăng nhập', 'rules' => 'required|is_unique[users.username]'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'required'),
                array('field' => 'repassword', 'label' => 'Mật khẩu nhập lại', 'rules' => 'required|matches[password]'),
                array('field' => 'phone', 'label' => 'SĐT', 'rules' => 'required'),
                array('field' => 'birthday', 'label' => 'Ngày sinh', 'rules' => 'required'),
                array('field' => 'gender', 'label' => 'Giới tính', 'rules' => 'required'),
                array('field' => 'address', 'label' => 'Địa chỉ', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('valid_email', '%s không đúng định dạng.');
            $this->form_validation->set_message('is_unique', '%s đã được sử dụng.');
            $this->form_validation->set_message('matches', '%s không khớp.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['fullname'] = $post_data['fullname'];
                $data_db['username'] = $post_data['username'];
                $data_db['email'] = $post_data['email'];
                $data_db['password'] = md5(md5($post_data['password'])."datnguyen");
                $data_db['phone'] = $post_data['phone'];
                $data_db['birthday'] = $post_data['birthday'];
                $data_db['gender'] = $post_data['gender'];
                $data_db['address'] = $post_data['address'];
                if($this->MCommon->insert($data_db,'users')){
                    $this->session->set_userdata("is_login",1);
                    $this->session->set_userdata("fullname",$data_db['fullname']);
                    $this->session->set_userdata("phone",$data_db['phone']);
                    $this->session->set_userdata("email",$data_db['email']);
                    $repo['error'] = 0;
                    $repo['msg'] = 'Đăng ký thành công!';
                }
                else{
                    $repo['error'] = 1;
                    $repo['msg'] = 'Lỗi hệ thống!';
                }
            }
            else{
                $repo['error'] = 1;
                $repo['msg'] = validation_errors();
            }
            echo json_encode($repo);
        }


    }
	
	
	public function userinfo(){

        if($this->session->userdata("userid") == "")
            redirect(site_url('dang-nhap'),'refresh');

        if($this->input->post("btnSubmit") != "") {

            $this->load->library('form_validation');
            $config = array(
                array('field' => 'fullname', 'label' => 'Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
                array('field' => 'phone', 'label' => 'Số điện thoại', 'rules' => 'required|integer')

            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('matches', 'Mật khẩu xác nhận không khớp.');
            $this->form_validation->set_message('valid_email', '%s không đúng định dạng email. vd: abc@gmail.com');
            $this->form_validation->set_message('is_unique', '%s đã được sử dụng.');
            $this->form_validation->set_message('integer', '%s Sai định dạng.');
            $this->form_validation->set_message('regex_match', '%s định dạng sai. VD: 07/01/1990');


            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['email'] = $post_data['email'];
                $data_db['fullname'] = $post_data['fullname'];
                $data_db['gender'] = $post_data['gender'];
                $data_db['phone'] = $post_data['phone'];
                $data_db['address'] = $post_data['address'];
                if($post_data['password'] != ""){
                    $data_db['password'] = $post_data['password'];
                    $data_db['password'] = md5(md5($data_db['password'])."datnguyen");
                }


                if($this->MCommon->update($data_db,"users",['id'=>$this->session->userdata("userid")]))
                {
                   

                     $this->session->set_flashdata("userinfo","Cập nhật thành công!");


                }
                else{
                    $this->session->set_flashdata("userinfo","Có lỗi xảy ra!");
                }
            }

        }

        $user = $this->MCommon->getRow('users',['id'=>$this->session->userdata("userid")]);
        if(!$user)
            redirect(site_url(),'refresh');
        $data['user'] = $user;

        $breadcrumb = [
            'Thông tin tài khoản' => ''
        ];

        //template
        $data['title'] = "Thông tin tài khoản";
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
	
	
	public function dstin()
    {


        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/user/dstin';
        $config['total_rows'] = $this->MBds->getTotalRowListBDSUser($this->session->userdata("userid"));
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MBds->getListBDSUser($config['per_page'],$start,$this->session->userdata("userid"));
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;
		
		$breadcrumb = [
            'Tin đã đăng' => ''
        ];

        //template
        $data['title'] = "Thông tin tài khoản";
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }



}
