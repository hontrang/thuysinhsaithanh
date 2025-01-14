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
        $this->load->model('MOrder');
        $this->load->model('MCommon');
    }


	public function tour(){

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $check = $this->MCommon->getRow('tour',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $tour = $this->MCommon->getRow_lang($lang,'tour',['id'=>$id]);
        if(!$tour)
            redirect(site_url(),'refresh');


        $this->load->library('form_validation');
        if(!empty($this->input->post('submit'))) {
            $config = array(
                array('field' => 'name', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_mail['name'] = $post_data['name'];
                $data_mail['email'] = $post_data['email'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                $data_mail['note'] = $post_data['note'];
                $data_mail['url'] = "http://goodsgtravel.com/du-lich/tour-".$tour->slug."-".$tour->id.".html";
                $data_mail['id'] = $tour->id;

                $this->sendMail($data_mail);

            }
        }

        //khoi hanh
        $province = $this->MCommon->getRow('province',['id'=>$tour->province_id]);
        if($province)
            $data['province'] = $province;


        //cat
        $cat = $this->MCommon->getRow_lang($lang,'tour_cat',['id'=>$tour->cat_id]);
        if($cat)
            $data['cat'] = $cat;

        $data['info'] = $tour;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line('booking') => ''

        ];

        $scripts[] = '';

        //template
        $data['title'] = $this->lang->line('booking');
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    public function golf(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);

        $check = $this->MCommon->getRow('golf',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $golf = $this->MCommon->getRow_lang($lang,'golf',['id'=>$id]);
        if(!$golf)
            redirect(site_url(),'refresh');


        $this->load->library('form_validation');
        if(!empty($this->input->post('submit'))) {
            $config = array(
                array('field' => 'name', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_mail['name'] = $post_data['name'];
                $data_mail['email'] = $post_data['email'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                $data_mail['note'] = $post_data['note'];
                $data_mail['url'] = "http://goodsgtravel.com/golf/chi-tiet/".$golf->slug."-".$golf->id.".html";
                $data_mail['id'] = $golf->id;

                $this->sendMail($data_mail);

            }
        }


        $data['info'] = $golf;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking") => ''

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

    public function hotel(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);

        $check = $this->MCommon->getRow('hotel',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $hotel = $this->MCommon->getRow_lang($lang,'hotel',['id'=>$id]);
        if(!$hotel)
            redirect(site_url(),'refresh');


        $this->load->library('form_validation');
        if(!empty($this->input->post('submit'))) {
            $config = array(
                array('field' => 'name', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_mail['name'] = $post_data['name'];
                $data_mail['email'] = $post_data['email'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                $data_mail['note'] = $post_data['note'];
                $data_mail['url'] = "http://goodsgtravel.com/khach-san/chi-tiet/".$hotel->slug."-".$hotel->id.".html";
                $data_mail['id'] = $hotel->id;

                $this->sendMail($data_mail);

            }
        }


        $data['info'] = $hotel;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking") => ''

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

    public function car(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $slug = $this->uri->segment(3);
        $id = (int)get_id($slug);

        $check = $this->MCommon->getRow('car',['id'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $car = $this->MCommon->getRow_lang($lang,'car',['id'=>$id]);
        if(!$car)
            redirect(site_url(),'refresh');


        $this->load->library('form_validation');
        if(!empty($this->input->post('submit'))) {
            $config = array(
                array('field' => 'name', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_mail['name'] = $post_data['name'];
                $data_mail['email'] = $post_data['email'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                $data_mail['note'] = $post_data['note'];
                $data_mail['url'] = "http://goodsgtravel.com/thue-xe/chi-tiet/".$car->slug."-".$car->id.".html";
                $data_mail['id'] = $car->id;

                $this->sendMail($data_mail);

            }
        }


        $data['info'] = $car;

        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking") => ''

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

    public function custom(){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $this->load->library('form_validation');
        if(!empty($this->input->post('submit'))) {
            $config = array(
                array('field' => 'name', 'label' => 'Họ Tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);

                $content = '+ <strong>Xuất phát</strong>: '.$post_data['from'].'<br />';
                $content .= '+ <strong>Nơi đến</strong>: '.$post_data['to'].'<br />';
                $content .= '+ <strong>Ngày khởi hành</strong>: '.$post_data['date'].'<br />';
                $content .= '+ <strong>Giá</strong>: '.($post_data['price']).'<br />';

                $data_mail['name'] = $post_data['name'];
                $data_mail['email'] = $post_data['email'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                $data_mail['note'] = $post_data['note'];
                $data_mail['content'] = $content;
                $data_mail['id'] = '';

                $this->sendMail($data_mail);

            }
        }

            $post = $this->input->post(null);
            if(!isset($post['date']))
                redirect(site_url(),'refresh');
            $from = $this->MCommon->getRow('province',['id'=>$post['from']]);
            if($from)
                $data['from'] = $from->name;
            else
                $data['from'] = $this->lang->line("unknown");

            $to = $this->MCommon->getRow('province',['id'=>$post['to']]);
            if($to)
                $data['to'] = $to->name;
            else
                $data['to'] = $this->lang->line("unknown");

            $cat = $this->MCommon->getRow('tour_cat',['id'=>$post['cat']]);
            if($cat)
                $data['cat'] = $cat->name;
            else
                $data['cat'] = $this->lang->line("unknown");


            $data['date'] = $post['date'];
            $data['price'] = $post['price'];
            $data['fullname'] = $post['name'];
            $data['email'] = $post['email'];
            $data['phone'] = $post['phone'];


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking") => ''

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

    public function success(){


        //breadcrumbx
        $breadcrumb = [
            $this->lang->line("booking_success") => ''

        ];

        $scripts[] = '';

        //template
        $data['title'] = $this->lang->line("booking_success");
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }

    private function sendMail($data_mail){
	    $email  = $this->MCommon->getRow('config',['k'=>'email']);
	    $title  = $this->MCommon->getRow('config',['k'=>'title']);

	    $time = time();
	    $content ='Thông tin đăt chỗ #'.$time.'<br /><br />';
	    $content .='-<strong>Thời gian</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
	    $content .='-<strong>Tên Khách Hàng</strong>: '.$data_mail['name'].'<br /><br />';
	    $content .='-<strong>Số điện thoại</strong>: '.$data_mail['phone'].'<br /><br />';
	    $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
	    $content .='-<strong>Địa chỉ</strong>: '.$data_mail['address'].'<br /><br />';
	    $content .='-<strong>Ghi chú</strong>: '.$data_mail['note'].'<br /><br />';
	    if(isset($data_mail['content']))
            $content .='-<strong>Nội dung đặt chỗ</strong>: <br/>'.$data_mail['content'];
	    else
	        $content .='-<strong>Nội dung đặt chỗ</strong>: <a href="'.$data_mail['url'].'">'.$data_mail['url'].'</a>';



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
        $this->email->subject('Thông tin đăt chỗ #'.$time);
        $this->email->message($content);
        $this->email->send();

        redirect('order/success','refresh');

    }

}
