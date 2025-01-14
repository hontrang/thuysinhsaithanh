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
        $this->load->model('MLanguage');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $filter = $this->uri->segment(4);


        $list = $this->MCommon->getAllRowByWhere('language',['language'=>$filter],null,"key ASC");
        if($list)
            $data['list'] = $list;

        $langs = $this->MCommon->getAllRowByWhere('language_list');
        if($langs)
            $data['langs'] = $langs;

        //template
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
                array('field' => 'set', 'label' => 'Module', 'rules' => 'required'),
                array('field' => 'key', 'label' => 'key', 'rules' => 'required'),
                array('field' => 'text', 'label' => 'Tiếng việt', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['set'] = $post_data['set'];
                $data_db['key'] = create_slug($post_data['key']);
                $data_db['sample'] = $post_data['text'];
                $data_db['text'] = $post_data['text'];
                $data_db['language'] = 'vi';

                $this->session->set_userdata("set_home",$data_db['set']);

                //kiem tra trung
                $check = $this->MCommon->getRow('language',['set'=>$post_data['set'],'key'=>$data_db['key'],'language'=>'vi']);
                if(!$check){
                    if($this->MCommon->insert($data_db,'language'))
                    {
						$this->build();
                        redirect('/admin/language/add','refresh');
                        die();
                    }
                }
                else{
                    $this->session->set_flashdata("error","Trùng key!");
                }

            }
        }
        //template
        $data['module'] = $module;
        $data['title'] = "Thêm";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);

    }



    public function build()
    {

        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $listmau = $this->MCommon->getAllRow('language',null,null,null,['language'=>'vi']);

        $list = $this->MCommon->getAllRow('language_list',null,null,null,['lang !='=>'vi']);
        if($list){
            foreach ($list as $item){

                foreach ($listmau as $mau){
                    //kiem tra xem co chua
                    $check = $this->MCommon->getRow("language",['language'=>$item->lang,'key'=>$mau->key,'set'=>$mau->set]);
                    if(!$check)
                        $this->MCommon->insert(['language'=>$item->lang,'key'=>$mau->key,'set'=>$mau->set,'text'=>$mau->text,'sample'=>$mau->sample],'language');
                }
            }
        }



    }

    public function edit()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->input->post("id");
        $text = $this->input->post("text");
        if($this->MCommon->update(['text'=>$text],'language',['id'=>$id])){
            $data['error'] = 0;
        }
        else{
            $data['error'] = 1;
        }
        echo json_encode($data);
        exit;



    }

    public function del()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->input->post("id");
        $text = $this->input->post("text");
        if($this->MCommon->delete('language',['id'=>$id])){
            $data['error'] = 0;
        }
        else{
            $data['error'] = 1;
        }
        echo json_encode($data);
        exit;



    }

}
