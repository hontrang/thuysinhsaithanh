<?php
class CDefault extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MHome');
        $this->load->model('MCommon');
        //$this->load->model('courcefree/MCourcefree');

    }

    public function index()
    {

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

     

        $about = $this->MCommon->getRow_lang($lang,'about',['orders'=>0]);
        if($about)
            $data['about'] = $about;

       
   

        $news = $this->MCommon->getAllRowByWhere_lang($lang,'news',['cat_id'=>17],5,"id DESC");
        if($news)
            $data['news'] = $news;

        $brand = $this->MCommon->getAllRowByWhere('product_brand',[],15,"id DESC");
        if($brand)
            $data['brand'] = $brand;


        $product_cat_list = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['show_home'=>1],null,'orders ASC, id ASC');
        if($product_cat_list){
            $data['product_cats_home'] = $product_cat_list;
        }

        
		$services = $this->MCommon->getAllRowByWhere_lang('vi','services',['show_home'=>1],6,"orders ASC");
        if($services)
            $data['services'] = $services;
        

        //template
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
    private function getContentCat($table,$parent_id){

        $lang = 'vi';
        if($this->session->userdata("lang") != "")
            $lang = $this->session->userdata("lang");

        $get_sub = $this->MCommon->getAllRowByWhere($table.'_cat',['parent_id'=>$parent_id]);
        $ids = null;
        $ids[] = $parent_id;
        if($get_sub){
            foreach ($get_sub as $item){
                $ids[]=$item->id;
            }
        }

        // getAllRowWithPageWhereIn_lang($lang,$table,$limit,$offset,$order= "",$where ='',$where_value=''){
        $dataR = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,$table,6,0,null,'cat_id',$ids);
        if($dataR)
            return $dataR;
        else
            return false;
    }

}
?>
