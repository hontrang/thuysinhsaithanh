<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/31/17 2:22 PM
 * Date: 8/4/17 9:01 AM
 *
 */

/**
 * Class Cart
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MAuth');

    }
    public function login()
    {

        if($this->input->post("btnSubmit") != "") {

            $this->load->library('form_validation');
            $config = array(
                array('field' => 'email', 'label' => 'Email đăng nhập', 'rules' => 'required'),
                array('field' => 'password', 'label' => 'Mật khẩu', 'rules' => 'required')

            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['username'] = $post_data['email'];
                $data_db['password'] = $post_data['password'];
                $data_db['password'] = md5(md5($data_db['password'])."datnguyen");
                $userinfo = $this->MAuth->checkLogin($data_db['username'], $data_db['password']);
                if($userinfo)
                {
                    $userid = $userinfo->id;
                    $email = $userinfo->email;
                    $name = $userinfo->fullname;
                    $type = $userinfo->type;
                    $this->session->set_userdata([
                        "userid" => $userid,
                        "email" => $email,
                        "name" => $name,
                        "type" => $type
                    ]);

                    redirect('admin','refresh');
                }
                else{
                    $data['error'] = "Sai thông tin đăng nhập! hoặc bạn không có quyền truy cập trang này.";
                }
            }

        }

        //template
        $data['title'] = "Đăng nhập";
        echo modules::run('template/Getlayout/login', $data);
    }

    public function error()
    {
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }

    public function logout()
    {
        //check đăng nhập
        $this->session->sess_destroy();
        redirect('admin/login','refresh');
    }

    public function check($permission_id="")
    {
        //check login
        if($this->session->userdata('type') != "1" or $this->session->userdata('userid') == "")
        {
            redirect('admin/login','refresh');
        }

        //check quyen
        /*
        $groupid = $this->session->userdata('groupid');
        $current_per_list = [];
        $current_per = $this->MAuth->getCurrentPermission($groupid);
        if($current_per)
        {
            foreach ($current_per as $per)
                $current_per_list[] = $per->permission_id;
        }

        if(!in_array($permission_id,$current_per_list))
            redirect('admin/auth/error','refresh');
         */

    }

    public function listpremission()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->model('user/MUser');
        $act = "";
        if($this->input->get("act") != "")
            $act = $this->input->get("act");

        if($act == "edit")
        {
            $this->load->library('form_validation');
            $id = (int)$this->input->get('id');
            if($id =="" or  $id == 0)
            {
                redirect('/admin/auth/permission','refresh');
            }

            if(!empty($this->input->post('submit')))
            {
                $data = [];
                if(count($this->input->post('list_permission')) > 0)
                {
                    foreach ($this->input->post('list_permission') as $list)
                        {
                            $data[] = ['groupid' => $id,'permission_id' => $list];
                        }
                }


                $this->MAuth->editPermission($data,$id);

            }

            $current_per_list = [];
            $current_per = $this->MAuth->getCurrentPermission($id);
            if($current_per)
            {
                foreach ($current_per as $per)
                    $current_per_list[] = $per->permission_id;

            }




            $data['info'] = $this->MUser->getGroupByID($id);
            $data['current_per_list'] = $current_per_list;

        }


        $data['list'] = $this->MUser->getListGroup();

        $data['list_permission'] = $this->MAuth->getListPermission();

        //template
        $data['module'] = $module;
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);


    }

}
