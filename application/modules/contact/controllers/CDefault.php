<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/4/17 2:09 PM
 * Date: 10/4/17 2:10 PM
 *
 */

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
        $this->load->model('MContact');
        $this->load->model('MCommon');
    }

    /**
     *
     */
    public function index()
    {
        $this->load->library('form_validation');
        if(!empty($this->input->post('btnSubmit')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Họ tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
                array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['email'] = $post_data['email'];
                $data_db['title'] = $post_data['title'];
                if(!empty($post_data['phone']))
                    $data_db['phone'] = $post_data['phone'];
                else
                    $data_db['phone'] = '';
                $data_db['content'] = $post_data['content'];

                if($this->MCommon->insert($data_db,"contact"))
                {
                    $data_mail = $data_db;
                    $this->sendMail2($data_mail);

                    $this->session->set_flashdata("contact_msg","Gửi thông tin liên hệ thành công! Chúng tôi sẽ liên lạc với bạn sớm nhất có thể!");
                    redirect('/lien-he','refresh');
                    die();
                }
            }
        }


        $breadcrumb = [
            $this->lang->line('contact') => ''
        ];
        $lat = $this->MCommon->getRow('config',['k'=>'lat']);
        $long = $this->MCommon->getRow('config',['k'=>'long']);
        $title = $this->MCommon->getRow('config',['k'=>'title_vi']);
        $address = $this->MCommon->getRow('config',['k'=>'address_vi']);

        $scripts[] = '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATN3JD4c35Uy-2JmU1t0u8x8qE35WWdwY"></script>
        <script>
            var initLatitude = '.$lat->value.';
			var initLongitude = '.$long->value.';
			
			var mapMarkers = [{
				latitude: initLatitude,
				longitude: initLongitude,
				html: "<strong>'.$title->value.'</strong><br>'.$address->value.'",
				icon: {
					image: "/public/templates/user/default/img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				},
				popup: true
			}];

			// Map Initial Location
			

			// Map Extended Settings
			var mapSettings = {
				controls: {
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 16
			};

			var map = $(\'#googlemaps\').gMap(mapSettings);

			// Map Center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$(\'#googlemaps\').gMap("centerAt", options);
			}

		</script>';

        //template
        $data['title'] = $this->lang->line('contact');
        $data['breadcrumb'] = $breadcrumb;
        $data['scripts'] = $scripts;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }
    public function sendcontact()
    {
        $this->load->library('form_validation');
        if(!empty($this->input->post('name')))
        {
            $this->load->library('form_validation');
            $config = array(
                array('field' => 'name', 'label' => 'Họ tên', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'Số điện thoại', 'rules' => 'required'),
                array('field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array('field' => 'content', 'label' => 'Nội dung', 'rules' => 'required')
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['name'] = $post_data['name'];
                $data_db['email'] = $post_data['email'];
                $data_db['title'] = $post_data['title'];
                if(!empty($post_data['phone']))
                    $data_db['phone'] = $post_data['phone'];
                else
                    $data_db['phone'] = '';
                $data_db['content'] = $post_data['content'];

                if($this->MCommon->insert($data_db,"contact"))
                {
                    $data_mail = $data_db;
                    //$this->sendMail2($data_mail);
                    $repo['error'] = 0;
                    $repo['msg'] = 'Liên hệ của bạn đã được gửi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất!';

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
    public function subscribe()
    {
        $email = $this->input->post("email");
       if($email == ""){
            $repo['error'] = 1;
            $repo['msg'] = "Email không được để trống";
        }
        else{
            //kiem tra trung
            $check = $this->MCommon->getRow('subscribe',['email'=>$email]);
            if($check){
                $repo['error'] = 1;
                $repo['msg'] = "Email này đã được đăng ký!";
            }
            else{
                $this->MCommon->insert(['ip'=>$this->input->ip_address(),'email'=>$email],'subscribe');
                $repo['error'] = 0;
                $repo['msg'] = "Chúng tôi đã nhận được email của bạn!";
            }

        }
        echo json_encode($repo);

    }


    private function sendMail($data_mail){
        $email  = $this->MCommon->getRow('config',['k'=>'email']);
        $title  = $this->MCommon->getRow('config',['k'=>'title_en']);

        $time = time();
        $content = '';
        $content .='-<strong>Thời gian nhận</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
        $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
        $content .='-<strong>IP</strong>: '.$data_mail['ip'].'<br /><br />';
        $content .='-<strong>Nội dung</strong>: Đăng kí nhận tin tức mới<br /><br />';



       //code connect tai khoan gmail bang giao thuc smtp
        $this->load->library('email');
        $config['smtp_host'] = 'smtp.gmail.com'; //dia chi host mail
        $config['smtp_port'] = 587;            //cong port smtp: 25, 465, 587
        $config['smtp_user'] = 'danggia86@gmail.com'; 
        $config['_smtp_auth'] = TRUE;
        $config['smtp_pass'] = 'azwkzjxvupuvafip';
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['send_multipart'] = FALSE;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        //ket thuc

        $this->email->initialize($config);
        $this->email->from('sender@dos.vn',$title->value);
        $this->email->to($email->value);
        $this->email->subject('Đăng ký nhận tin tức mới #'.$time);
        $this->email->message($content);
        $this->email->send();


    }
	
	private function sendMail2($data_mail){
        $email  = $this->MCommon->getRow('config',['k'=>'email']);
        $title  = $this->MCommon->getRow('config',['k'=>'title_en']);

        $time = time();
        $content = '';
        $content .='-<strong>Thời gian nhận</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
        $content .='-<strong>Họ Tên</strong>: '.$data_mail['name'].'<br /><br />';
        $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
        $content .='-<strong>SĐT</strong>: '.$data_mail['phone'].'<br /><br />';
        $content .='-<strong>Tiêu đề</strong>: '.$data_mail['title'].'<br /><br />';
        $content .='-<strong>Nội dung</strong>: '.$data_mail['content'].'<br /><br />';



        //code connect tai khoan gmail bang giao thuc smtp
        $this->load->library('email');
        $config['smtp_host'] = 'smtp.gmail.com'; //dia chi host mail
        $config['smtp_port'] = 587;            //cong port smtp: 25, 465, 587
        $config['smtp_user'] = 'danggia86@gmail.com'; 
        $config['_smtp_auth'] = TRUE;
        $config['smtp_pass'] = 'azwkzjxvupuvafip';
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['send_multipart'] = FALSE;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        //ket thuc

        $this->email->initialize($config);
        $this->email->from('sender@dos.vn',$title->value);
        $this->email->to($email->value);
        $this->email->subject('Thông tin liên hệ từ website #'.$time);
        $this->email->message($content);
        $this->email->send();


    }



}
