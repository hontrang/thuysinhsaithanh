<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/20/17 9:46 AM
 * Date: 10/3/17 11:26 AM
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
        $this->load->model('MConfig');
        $this->load->model('MCommon');
    }


    public function index()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module . "/" . $this->router->fetch_method();
        modules::run('auth/Permission/check', $permission_id);

        if (!empty($this->input->post('submit'))) {
            $post_data = $this->input->post(null);

            $list = $this->MCommon->getAllRow('config');
            foreach ($list as $item) {
                $data_db = null;
                $data_db['value'] = $post_data[$item->k];
                $this->MCommon->update($data_db, 'config', ['k' => $item->k]);
            }

            //redirect('/admin/config','refresh');
            //die();
        }

        $configs = $this->MCommon->getAllRow('config',null,"orders ASC");
        $data['configs'] = $configs;

        //template
        $data['module'] = $module;
        $data['title'] = "Cấu hình chung";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }


    public function filemanager()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);




        //template
        $data['module'] = $module;
        $data['title'] = "Thư viện";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }

    public function delbank()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/config/listbank','refresh');

        $this->MCommon->delete('bank',['id'=>$id]);

        redirect('/admin/config/listbank','refresh');

    }

    public function changepass()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit')))
        {
            $config = array(
                array('field' => 'oldpass', 'label' => 'Mật khẩu cũ', 'rules' => 'required'),
                array('field' => 'newpass', 'label' => 'Mật khẩu mới', 'rules' => 'required'),
                array('field' => 'renewpass', 'label' => 'Nhập lại mật khẩu', 'rules' => 'required|matches[newpass]')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);

                $oldpass= $post_data['oldpass'];
                $oldpass = md5(md5($oldpass)."datnguyen");
                $check_oldpass = $this->MCommon->getRow('users',['username'=>'admin','password'=>$oldpass]);
                if($check_oldpass){
                    $newpass = $post_data['newpass'];
                    $newpass = md5(md5($newpass)."datnguyen");
                    if($this->MCommon->update(['password'=>$newpass],'users',['username'=>'admin']))
                    {
                        $this->session->set_flashdata('changepass_msg','Đã cập nhật mật khẩu mới!');
                        redirect('/admin/config/changepass/','refresh');
                        die();
                    }
                }
                else{
                    $this->session->set_flashdata('changepass_msg','Mật khẩu cũ không đúng!');
                }


            }
        }

        //template
        $data['module'] = $module;
        $data['title'] = "Thay đổi mật khẩu";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }





}
