<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('MCart');
        $this->load->model('MCommon');
		$this->load->library('cart');

    }
    public function index()
	{

	    //breadcrumb
         $breadcrumb = [
            'Giỏ hàng' => ''
        ];

        //template
        $data['title'] = "Giỏ hàng";

        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
	}


	public function add(){


        $soluong = (int)$this->input->post('quantity');
        $id = (int)$this->input->post('product_id');
        if($id == 0 or $id == ""){
            exit;
        }

        //kiem tra id hop le
        $product = $this->MCommon->getRow_lang('vi','product',['id'=>$id]);
        if(!$product)
            exit;

        $qty = 1;
        if($soluong != 0)
            $qty = (int)$soluong;

        $datacart = array(
            'id'      => $product->id,
            'product_id'      => $product->id,
            'qty'     => $qty,
            'price'   => $product->price,
            'price_old'   => $product->price_old,
            'name'    => $product->name,
            'image' => $product->image
        );




        $this->cart->product_name_rules = '\d\D';
        $this->cart->insert($datacart);


        $repo['success'] = 'Thành công: Bạn đã thêm <a href="/san-pham/'.$product->slug.'-'.$product->id.'.html">'.$product->name.'</a> vào <a href="/gio-hang.html">giỏ hàng</a>!';
        $repo['total'] = $this->cart->total_items(). " sản phẩm trong giỏ hàng";
        echo json_encode($repo);
        exit;
    }

    public function info(){



        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/ajax', $data);
    }

    public function update(){

        $id = $this->uri->segment(3);
        if($id == "")
            redirect(site_url('gio-hang'),'refresh');

        $data = array(
            'rowid' => $id,
            'qty'   => 0
        );
        $this->cart->product_name_rules = '\d\D';
        $this->cart->update($data);
        redirect(site_url('gio-hang'),'refresh');
    }
    public function remove(){
        $key = $this->input->post('key');
        $data = array(
            'rowid' => $key,
            'qty'   => 0
        );
        $this->cart->product_name_rules = '\d\D';
        $this->cart->update($data);

        $repo['success'] = 'Thành công: Bạn đã sửa đổi giỏ hàng của bạn!';
        $repo['total'] = $this->cart->total_items(). " sản phẩm trong giỏ hàng";
        echo json_encode($repo);
        exit;
    }
	public function delete(){

        $id = $this->uri->segment(3);
        if($id == "")
            redirect(site_url('tao-hoa-don'),'refresh');

        $data = array(
            'rowid' => $id,
            'qty'   => 0
        );
        $this->cart->product_name_rules = '\d\D';
        $this->cart->update($data);
        redirect(site_url('tao-hoa-don'),'refresh');
    }

    public function updateQty(){

        $rowid = $this->input->post("id");
        $qty = $this->input->post("qty");

        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->product_name_rules = '\d\D';
        $this->cart->update($data);
        exit;
    }
    public function discount_unset(){

        $this->session->set_userdata('discount','');
        $this->session->set_userdata('discount_code','');
        redirect(site_url('gio-hang'),'refresh');
    }

    public function sendMail($data_mail){
        $time = time();

        $noidung = '<table border=1 cellspacing=0 cellpadding=0><tr style=\'background-color: #d1c515; color:white\'><td>ID</td><td>Tên SP</td><td>Kích thước</td><td>Số lượng</td><td>Giá</td><td>Thành tiền</td></tr>';

        foreach ($this->cart->contents() as $items){
            $noidung.='<tr><td>'.$items['product_id'].'</td><td>'.$items['name'].'</td><td>'.$items['size'].'</td><td>'.$items['qty'].'</td><td>'.number_format($items['price']).'</td><td>'.number_format($items['subtotal']).'</td></tr>';
        }
        $noidung .= '</table>';
		
		

        $content ='Thông tin đặt hàng #'.$time.'<br /><br />';
        $content .='-<strong>Thời gian</strong>: '.date("d/m/Y H:s:i").'<br /><br />';
        $content .='-<strong>Tên Khách Hàng</strong>: '.$data_mail['name'].'<br /><br />';
        $content .='-<strong>Số điện thoại</strong>: '.$data_mail['phone'].'<br /><br />';
        $content .='-<strong>Email</strong>: '.$data_mail['email'].'<br /><br />';
        $content .='-<strong>Địa chỉ</strong>: '.$data_mail['address'].'<br /><br />';
        $content .='-<strong>Ghi chú</strong>: '.$data_mail['note'].'<br /><br />';
        $content .='-<strong>Nội dung: </strong>: <br /><br />';
        $content .=$noidung;
        $content .='-<strong>Tổng hóa đơn</strong>: '.number_format($data_mail['price']).'<br /><br />';
		
		$email_to = $this->MCommon->getRow('config',['k'=>'email'])->value;

		
		//code connect tai khoan gmail bang giao thuc smtp
        $this->load->library('email');
        $config['smtp_host'] = 'smtp.gmail.com'; //dia chi host mail
        $config['smtp_port'] = 587;            //cong port smtp: 25, 465, 587
        $config['smtp_user'] = 'sender@dos.vn'; 
        $config['_smtp_auth'] = TRUE;
        $config['smtp_pass'] = 'hfustfmgznxndnro';
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['send_multipart'] = FALSE;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        //ket thuc

        $this->email->initialize($config);
        $this->email->from('sender@dos.vn',"Sam Long Hop");
		$this->email->cc('danggia86@gmail.com');
        $this->email->to($email_to);
        $this->email->subject('Thông tin đặt hàng #'.$time);
        $this->email->message($content);
        $this->email->send();



    }


	public function get_token(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://thayleedeptrai.vn/mail/?/Api/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => 'Module=Core&Method=Login&Parameters={"Login":"sales@topfitvietnam.vn","Password":"556879314"}',
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded"
		  ),
		));

		$key = curl_exec($curl);
		curl_close($curl);
		$key = json_decode($key);
		$token = $key->Result->AuthToken;
		return $token;
	}

    public function checkout(){
        $this->load->library('form_validation');


		$discount_price = 0;
		if($this->session->userdata("discount") != ""){
			$code = $this->session->userdata("discount_code");
			$checkcode = $this->MCommon->getRow('code',['code'=>$code,'used'=>0]);
			if(!$checkcode){
				$this->session->set_flashdata("code_msg","Mã này không tồn tại hoặc đã được sử dụng!");
				$this->session->set_userdata("discount","");
				$this->session->set_userdata("discount_code","");
				$discount_price = 0;
			}else{
				$this->session->set_userdata("discount",$checkcode->discount);
				$this->session->set_userdata("discount_code",$checkcode->code);
				$discount_price = round(($this->cart->total()*$checkcode->discount)/100);
			}
		}


		if(!empty($this->input->post('btnDiscount')))
        {
			$code = $this->input->post('code');
			$checkcode = $this->MCommon->getRow('code',['code'=>$code,'used'=>0]);
			if(!$checkcode){
				$this->session->set_flashdata("code_msg","Mã này không tồn tại hoặc đã được sử dụng!");
				$this->session->set_userdata("discount","");
				$this->session->set_userdata("discount_code","");
				$discount_price = 0;
			}else{
				$this->session->set_userdata("discount",$checkcode->discount);
				$this->session->set_userdata("discount_code",$checkcode->code);
				$discount_price = round(($this->cart->total()*$checkcode->discount)/100);
			}
		}


		$data['discount_price'] = $discount_price;




        if(!empty($this->input->post('btnSubmit')))
        {
            $config = array(
                array('field' => 'name', 'label' => 'Tên người nhận', 'rules' => 'required'),
                array('field' => 'phone', 'label' => 'Số điện thoại', 'rules' => 'required'),
                array('field' => 'address', 'label' => 'Địa chỉ', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống.');

            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_mail['name'] = $post_data['name'];
                $data_mail['phone'] = $post_data['phone'];
                $data_mail['address'] = $post_data['address'];
                if(isset($post_data['note']))
                    $data_mail['note'] = $post_data['note'];

				$ship = 0;
				if($this->cart->total_items()>=3)
					$ship = 0;

                $data_mail['content'] = json_encode($this->cart->contents());
                $data_mail['ship'] = $ship;
                $data_mail['khuyenmai'] = $discount_price;
                $data_mail['price'] = ($this->cart->total()+$ship)-$discount_price;



                if($this->MCommon->insert($data_mail,'orders')){
					$id_invoice = $this->db->insert_id();
					//update mã
					$this->MCommon->update(['used'=>1,'used_time'=>date("Y-m-d H:i:s"),'invoice'=>$id_invoice],'code',['code'=>$this->session->userdata("discount_code")]);
					$this->session->set_userdata("discount","");
					$this->session->set_userdata("discount_code","");
					$data_mail['invoice'] = $id_invoice;
                    $this->sendMail($data_mail);
                    //exit;
                    $this->cart->destroy();
                    redirect('/gio-hang/thanh-cong','refresh');
                }
                else{
                    redirect('/gio-hang/error','refresh');
                }

            }
        }







        //breadcrumb
        $breadcrumb = [
            'Thanh toán' => ''
        ];

        //template
        $data['title'] = "Thanh toán";

        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }

    public function finish(){


        //breadcrumb
        $breadcrumb = [
            'Hoàn thành đơn hàng' => ''
        ];

		$this->cart->destroy();


        //template
        $data['title'] = "Hoàn thành đơn hàng";

        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }

	public function taonut(){


        //breadcrumb
        $breadcrumb = [
            'Hoàn thành đơn hàng' => ''
        ];

		$this->cart->destroy();


        //template
        $data['title'] = "Hoàn thành đơn hàng";

        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);

    }

	public $token = "EAAa0R3m7U7gBAHV9ZBNNO7cLbosUbmwUiAKKlelbPpnBshyKWWoPQyhGEcUHcfk3UveeEYdU5vgSf5BDZCI1jQYsH8Bz3ljEsSL9r5tSv6JSvOdXdICW1dfnXBYJsPzD7RRg9TVDRZCRSA13qUUGhQgCLnBVzdqbycdUtvr1dwOIaASXTZBP";

	public function post($data)
	{
		$token = $this->token;

		$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$token;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


		$result = curl_exec($ch);

		//ghilog(print_r($result,true));
		curl_close($ch);
		return $result;
	}
	public function sendtext($idface,$traloi)
	{

	 $data = '{
		"recipient":{
			"id":"'.$idface.'"
		  },
		"message":{
			"text":"'.$traloi.'"
		  }
	 }';

	return $this->post($data);
	}

	public function getGioiTinh($text)
	{

	 if($text == "female")
		 $t = "Chị";
	 else if($text == "male")
		$t = "Anh";
		else
			$t = "Anh/Chị";

	return $t;
	}

	public function timkhachhang(){
		$key = $this->input->get('q');
		$list = $this->MCart->TimKhachHang($key);
		if($list){
			$repo['items'] = $list;
		}
		else{
			$repo['items'] = [];
		}
		echo json_encode($repo);
		exit;
	}


	public function taohoadon(){

		if(!empty($this->input->post('btnsend')))
        {
			if(count($this->cart->contents()) > 0){

			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$idface = $this->input->post('idface');
			$user_info = $this->MCommon->getRow('userbot',['idface'=>$idface]);
			$ship = $this->input->post('ship');
			$discount = $this->input->post('discount');
			$phone = $this->input->post('phone');
			$note = $this->input->post('note');
			$realname = $this->input->post('realname');

			$tongtien = ($this->cart->total()+$ship)-$discount;

			//luu database
			$data_db['ship'] = $ship;
			$data_db['discount'] = $discount;
			$data_db['customer_realname'] = $realname;
			$data_db['customer_name'] = $user_info->name;
			$data_db['customer_psid'] = $idface;
			$data_db['customer_phone'] = $phone;
			$data_db['address'] = $address;
			$data_db['thanhpho'] = $city;
			$data_db['tinh'] = $state;
			$data_db['price'] = $tongtien;
			$data_db['note'] = $note;
			$data_db['qty'] = $this->cart->total_items();
			$data_db['content'] = json_encode($this->cart->contents());
			$this->MCommon->insert($data_db,'invoice');
			$invoice_id = $this->db->insert_id();

			//luu thong tin
			$this->MCommon->update(['realname'=>$realname,'address'=>$address,'thanhpho'=>$city,'tinh'=>$state,'phone'=>$phone],'userbot',['idface'=>$idface]);

			$textgiamgia = '';
			if($discount > 0){
				$textgiamgia = '"adjustments":[
    {
      "name": "Giảm giá",
      "amount": '.$discount.'
    }
  ],';
			}

			$noidung = '';
			foreach ($this->cart->contents() as $items){
				$noidung .='{
							"title":"'.$items['name'].'",
							"subtitle":"Size: '.$items['size'].'",
							"quantity":'.$items['qty'].',
							"price":'.$items['price'].',
							"currency":"VND",
							"image_url":"'.base_url("public/userfiles/".$items['image']).'"
						  },';
			}

			$datapost = '{
  "recipient":{
    "id":"'.$idface.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"receipt",
        "recipient_name":"'.$realname.'",
        "order_number":"'.$invoice_id.'",
        "currency":"VND",
        "payment_method":"Thanh toán khi nhận hàng (COD)",        
        "order_url":"https://topfitvietnam.com",
        "timestamp":"'.time().'",  
        "address":{
          "street_1":"'.$address.'",
          "street_2":"",
          "city":"'.$city.'",
          "postal_code":"00084",
          "state":"'.$state.'",
          "country":"VN"
        },
        "summary":{
          "subtotal":'.($this->cart->total()).',
          "shipping_cost":'.($ship).',
          "total_tax":0,
          "total_cost":'.($tongtien).'
        },
		'.$textgiamgia.'
        "elements":[
          '.$noidung.'
        ]
      }
    }
  }
}';
			$repopost = json_decode($this->post($datapost));
			if(isset($repopost->recipient_id)){
				$this->sendtext($idface,"Shop đã chốt đơn hàng của ".$this->getGioiTinh($user_info->gender).".".$this->getGioiTinh($user_info->gender)." có thể nhấn vào hóa đơn phía trên để xem chi tiết đơn hàng. Shop sẽ ship cho ".$this->getGioiTinh($user_info->gender)." trong thời gian sớm nhất có thể. Cảm ơn ".$this->getGioiTinh($user_info->gender)." đã ủng hộ shop <3");
				$this->cart->destroy();
				$this->session->set_flashdata("msg","Đã gửi hóa đơn! Mã hóa đơn #".$invoice_id);
			}
			else{
				$this->session->set_flashdata("msg","Lỗi! Vui lòng liên hệ admin.");
			}
		}
		}

		if(!empty($this->input->post('btnaddproduct')))
        {
			$product_id = $this->input->post('product_id');
			$size = $this->input->post('size');

			//kiem tra id hop le
			$product = $this->MCommon->getRow_lang('vi','product',['id'=>$product_id]);
			if(!$product)
				redirect(site_url('tao-hoa-don'),'refresh');


			$qty = 1;
			if($this->input->post("qty") != "")
				$qty = (int)$this->input->post("qty");

			$datacart = array(
				'id'      => $product->id.'-'.$size,
				'product_id'      => $product->id,
				'product_code'      => $product->code,
				'size'     => $size,
				'qty'     => $qty,
				'price'   => $product->price,
				'price_old'   => $product->price_old,
				'name'    => $product->name,
				'image' => $product->image
			);




			$this->cart->product_name_rules = '\d\D';
			$this->cart->insert($datacart);
			redirect(site_url('tao-hoa-don'),'refresh');
			exit;

		}


		$listkhachhang = $this->MCommon->getAllRowByWhere('userbot',[],100,"last_active DESC, id DESC");
		$data['listkhachhang'] = $listkhachhang;

		$products = $this->MCommon->getAllRowByWhere_lang('vi','product',[],null,"cat_id DESC");
		$data['products'] = $products;



        //breadcrumb
        $breadcrumb = [
            'Tạo hóa đơn' => ''
        ];

		$scripts[] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>';


        //template
        $data['title'] = "Tạo hóa đơn";

        $data['breadcrumb'] = $breadcrumb;
        $data['scripts'] = $scripts;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/full', $data);

    }

	public function timthongtinkhach(){
		$idface = $this->input->post('id');
		if($idface == "")
			exit;
		$check = $this->MCommon->getRow('userbot',['idface'=>$idface]);
		if($check){
			$repo['error']= 0;
			$repo['realname']= $check->realname;
			$repo['phone']= $check->phone;
			$repo['address']= $check->address;
			$repo['thanhpho']= $check->thanhpho;
			$repo['tinh']= $check->tinh;
		}
		else{
			$repo['error']= 1;
		}
		echo json_encode($repo);
		exit;
	}

}
