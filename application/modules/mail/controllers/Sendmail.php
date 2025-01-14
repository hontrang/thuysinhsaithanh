<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MCommon');
    }


    public function send()
    {


        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'thayleedeptrai.vn';
        $config['smtp_port'] = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = "contact@thayleedeptrai.vn";
        $config['smtp_pass'] = "thaylee!@#123";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        //config['validation'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('contact@thayleedeptrai.vn','Thầy Lee Đẹp Trãi'); //mail nguoi gui
        $this->email->to("dat19802004@gmail.com");
        $this->email->subject('Đơn đặt hàng của khách hàng');
        $this->email->message($this->tao_noi_dung());
        $this->email->send();
        echo $this->email->print_debugger();

    }

    public function tao_noi_dung()
    {
        $noi_dung='<p>Kiem tra gui thu email</p>';
        return $noi_dung;
    }
//SMTP Username:AKIAJJQFWAWSYTLWTGTQ
//SMTP Password:AjjBuX8fY2+qnyBzx/BZpXrJLssZpBwZRENcBl5OOkK/

}
