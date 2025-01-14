<?php
class Getlayout extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MCommon');
    }
    public function ajax($data)
    {
        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");
		
		
		$cats = $this->MCommon->getAllRowByWhere('product_cat',[]);
		$discount_cat = [];
		if($cats)foreach($cats as $cat){
			$discount_cat[$cat->id] = $cat->discount;
			
		}
		$data['discount_cat'] = $discount_cat;

        $data['lang'] = $lang;
        $data['current_module'] = $data['module'];
        $this->load->view('user/default/'.$data['module'].'/'.$data['method'],$data);
    }

    public function user($data)
    {
        //load config
        $list_config = $this->MCommon->getAllRow('config');
        $site_config = null;
        foreach ($list_config as $c){
            $site_config[$c->k] = $c->value;
        }
        $data['site_config'] = $site_config;
		
		$cats = $this->MCommon->getAllRowByWhere('product_cat',[]);
		$discount_cat = [];
		if($cats)foreach($cats as $cat){
			$discount_cat[$cat->id] = $cat->discount;
			
		}
		$data['discount_cat'] = $discount_cat;

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $data['lang'] = $lang;
        $current_template = "default";
        $data['current_template'] = $current_template;
        $data['current_module'] = $data['module'];
        $this->load->view('user/'.$current_template.'/main',$data);
    }


    public function admin($data)
    {
        $current_template = "default";
        $data['current_module'] = $data['module'];
        $data['current_template'] = $current_template;
        $this->load->view('admin/'.$current_template.'/main',$data);
    }

    public function login($data)
    {
        //load config
        $list_config = $this->MCommon->getAllRow('config');
        $site_config = null;
        foreach ($list_config as $c){
            $site_config[$c->k] = $c->value;
        }
        $data['site_config'] = $site_config;

        $current_template = "default";
        $data['current_template'] = $current_template;
        $this->load->view('admin/'.$current_template.'/auth/login',$data);
    }

    public function fullwidth($name,$data)
    {

        $current_template = "goodsaigon";
        $data['current_template'] = $current_template;
        $this->load->view('user/'.$current_template.'/fullwidth/'.$name,$data);
    }

    public function fullsize($data)
    {

        $current_template = "goodsaigon";
        $data['current_template'] = $current_template;
        $this->load->view('user/'.$current_template.'/fullsize',$data);
    }

    public function test($data)
    {
        echo "awdawd";
    }
}



?>
