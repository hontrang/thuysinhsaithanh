<?php
/**
 * Class Cart
 * @property CDefault $CDefault landsale module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MCommon');
        $this->load->model('MLandSale');
        $this->load->model('MSearch');
    }

    public function index()
	{
		$this->config->load('pagination');
        $config['base_url'] = site_url().'bds/';
        $config['total_rows'] = $this->MLandSale->getTotalRow();
        $config['per_page'] = 5;
        $config['uri_segment'] = 2;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MLandSale->getAll($config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;
        
        //breadcrumb
         $breadcrumb = [
            'Đất nền' => ''
        ];
		
		

        //template
        $data['title'] = "Đất nền";
        $data['breadcrumb'] = $breadcrumb;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
	}
	
    public function listbycat()	{
		$slug = $this->uri->segment(2);
        $catInfo = $this->MLandSale->getCatInfo($slug);
        if(!$catInfo)
            redirect('bds','refresh');

        $this->config->load('pagination');
        $config['base_url'] = site_url().'bds/'.$catInfo->slug.'/';
        $config['total_rows'] = $this->MLandSale->getTotalRowCat($catInfo->id);
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MLandSale->getByCatID($catInfo->id,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //breadcrumb
         $breadcrumb = [
            'Bất động sản' => 'bds',
            $catInfo->name => ''

        ];

        $current_parent_id = $catInfo->id;

        $data['current_parent_id'] = $current_parent_id;

        $data['current_slug'] = $slug;
        
        //template
        $data['title'] = $catInfo->name;
        $data['breadcrumb'] = $breadcrumb;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'index';
        echo modules::run('template/getlayout/user', $data);
	}

    public function search()	{
        $data = array();
        $data["cat"] = (int)$this->input->get('scat');
        $data["province"] = (int)$this->input->get('sprovince');
        $data["district"] = (int)$this->input->get('sdistrict');
        $data["ward"] = (int)$this->input->get('sward');
        $data["street"] = (int)$this->input->get('sstreet');
        $data["MucGia"] = (int)$this->input->get('sMucGia');
        $data["MucGiamin"] = (int)$this->input->get('MucGiamin');
        $data["MucGiamax"] = (int)$this->input->get('MucGiamax');
        $data["DienTich"] = (int)$this->input->get('sDienTich');
        $data["DienTichmin"] = (int)$this->input->get('DienTichmin');
        $data["DienTichmax"] = (int)$this->input->get('DienTichmax');
        $data["direction"] = (int)$this->input->get('sdirection');
        $data["bedroom"] = (int)$this->input->get('sbedroom');

        $data_post = $data;

        $this->config->load('pagination');
        $config['base_url'] = site_url().'bds/tim-kiem/';
        $config['total_rows'] = $this->MSearch->getTotalRow($data);
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = true;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MSearch->getAll($data,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($list)
            $data['list'] = $list;

        //breadcrumb
        $breadcrumb = [
            'Tìm kiếm' => ''
        ];

        //custom script
        $text = "";
        foreach ($data_post as $key => $item)
        {
            $text .= "var s".$key."_id = ".$item."; ";
        }
        $scripts[] = '<script>'.$text.'</script>';
        $scripts[] = '<script>
                $("#stype").val(stype_id).attr("selected","selected").trigger("change");
                $("#sprovince").val(sprovince_id).attr("selected","selected").trigger("change");
                $("#sdirection").val(sdirection_id).attr("selected","selected").trigger("change");
                $("#sbedroom").val(sbedroom_id).attr("selected","selected").trigger("change");
        </script>';
        //template
        $data['title'] = "Tìm kiếm";
        $data['breadcrumb'] = $breadcrumb;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'index';
        echo modules::run('template/getlayout/user', $data);
    }

    public function listByArea()	{
        $slug = $this->uri->segment(1);
        $catInfo = $this->MLandSale->getCatInfo($slug);
        if(!$catInfo)
            redirect('bds','refresh');

        $this->config->load('pagination');
        $config['base_url'] = site_url().'bds/'.$catInfo->slug.'/';
        $config['total_rows'] = $this->MLandSale->getTotalRowCat($catInfo->id);
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(3)?$this->uri->segment(3):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MLandSale->getByCatID($catInfo->id,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;

        //breadcrumb
        $breadcrumb = [
            'Nhà đất bán' => 'bds',
            $catInfo->ten => ''

        ];

        //template
        $data['title'] = $catInfo->ten;
        $data['breadcrumb'] = $breadcrumb;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'index';
        echo modules::run('template/getlayout/user', $data);
    }

	public function detail(){

        $slug = $this->uri->segment(2);
        $idbds = get_id($slug);
        if($idbds == 0) {
			redirect(site_url(), 'refresh');
		}


        $bds = $this->MLandSale->getByID($idbds);
		
        if(!$bds)
            redirect(site_url(),'refresh');

        $data['bds'] = $bds;

        //get imgage
        if($bds){
            $images = $this->MLandSale->getImgByID($idbds);
            $data['images'] = $images;
        }

        //vi tri ban do
        $map_lat = $bds->map_lat;
        $map_lng = $bds->map_lng;

        //breadcrumbx
        $breadcrumb = [
            'Đất nền' => 'bds',
            $bds->title => ''

        ];
		
		$user_post = $this->MCommon->getRow('users',['id'=>$bds->user_id]);
		if($user_post)
			$data['user_post'] = $user_post;



        //custom script
        $scripts[] = '<script> var map_lat = "'.$map_lat.'";var map_lng = "'.$map_lng.'";</script>';
        $scripts[] = '<script type="text/javascript" src="'.base_url('public/templates/user/default/js/custom_map_view.js').'"></script>';
		
        //template
        $data['title'] = $bds->title;
        $data['map_lat'] = $map_lat;
        $data['map_lng'] = $map_lng;
        $data['scripts'] = $scripts;
        $data['breadcrumb'] = $breadcrumb;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
	
	private function getFileExt($file)
    {
        $temp = explode(".",$file);
        $file_ext = $temp[count($temp)-1];
        return $file_ext;
    }
	
	public function dangtin(){
        //kiem tra user
        if ($this->session->userdata('userid') == "")
            redirect('bds','refresh');
        

        //get type default
        if($this->input->get('type') == "2")
            $type_default = 2;
        else
            $type_default = 1;

        $data['type_default'] = $type_default;

        //POST method
        if($this->input->post("btnSubmit") != "")
        {
            $this->load->library('form_validation');
            $config = array(
                array( 'field' => 'cat', 'label' => 'Danh mục', 'rules' => 'required'),
                array( 'field' => 'title', 'label' => 'Tiêu đề', 'rules' => 'required'),
                array( 'field' => 'province', 'label' => 'Tỉnh/Thành phố', 'rules' => 'required|integer' ),
                array( 'field' => 'district', 'label' => 'Quận/Huyện', 'rules' => 'required|integer' ),
                array( 'field' => 'ward', 'label' => 'Phường/Xã', 'rules' => 'integer' ),
                array( 'field' => 'address', 'label' => 'Địa chỉ', 'rules' => 'required' ),
                array( 'field' => 'street', 'label' => 'Đường', 'rules' => 'integer' ),
                array( 'field' => 'unit', 'label' => 'Đơn vị', 'rules' => 'integer' ),
                array( 'field' => 'detail', 'label' => 'Mô tả', 'rules' => 'required' ),
                //thong tin chi tiet
                array( 'field' => 'long', 'label' => 'Chiều dài', 'rules' => 'numeric' ),
                array( 'field' => 'width', 'label' => 'Chiều rộng', 'rules' => 'numeric' ),
                array( 'field' => 'street_width', 'label' => 'Đường trước nhà', 'rules' => 'numeric' ),
                array( 'field' => 'direction', 'label' => 'Hướng nhà', 'rules' => 'integer' ),
                array( 'field' => 'floor', 'label' => 'Số tầng', 'rules' => 'integer' ),
                array( 'field' => 'bedroom', 'label' => 'Số Phòng ngủ', 'rules' => 'integer' ),
                array( 'field' => 'facade', 'label' => 'Mặt tiền', 'rules' => 'numeric' ),
                array( 'field' => 'toilet', 'label' => 'Số Toilet', 'rules' => 'integer' ),
                array( 'field' => 'juridical', 'label' => 'Pháp lý', 'rules' => 'integer' ),
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '%s không được để trống');
            $this->form_validation->set_message('integer', '%s phải là một số nguyên');
            $this->form_validation->set_message('numeric', '%s phải là một số');
            $this->form_validation->set_message('valid_email', '%s không đúng định dạng email. vd: abc@gmail.com');


            if ($this->form_validation->run()) {
                $post_data = $this->input->post(null);
                $data_db['title'] = $post_data['title'];
                $data_db['type'] = 1;
                $data_db['cat'] = $post_data['cat'];
                $data_db['province'] = $post_data['province'];
                $data_db['district'] = $post_data['district'];
                $data_db['ward'] = $post_data['ward'];
                $data_db['address'] = $post_data['address'];
                $data_db['area'] = (float)$post_data['area'];
                $data_db['street'] = $post_data['street'];
                $data_db['price'] = (int)$post_data['price'];
                $data_db['unit'] = $post_data['unit'];
                $data_db['detail'] = $post_data['detail'];
                //thong tin chi tiet
                $data_db['landlong'] = $post_data['landlong'];
                $data_db['landwidth'] = $post_data['landwidth'];
                $data_db['street_width'] = $post_data['street_width'];
                $data_db['direction'] = $post_data['direction'];
                $data_db['floor'] = $post_data['floor'];
                $data_db['bedroom'] = $post_data['bedroom'];
                $data_db['facade'] = $post_data['facade'];
                $data_db['toilet'] = $post_data['toilet'];
                $data_db['juridical'] = $post_data['juridical'];

                //map
                $data_db['map_lat'] = $post_data['map_lat'];
                $data_db['map_lng'] = $post_data['map_lng'];


                $data_db['user_id'] = $this->session->userdata('userid');

                //chưa đăng nhập
                $insert = $this->MCommon->insert($data_db,'bds');
                if ($insert > 0) {
                    $idbds = $this->db->insert_id();
                    //insert hình ảnh
                    if (!empty($post_data['fileuploader-list-files'])) {
						include('public/fileuploader/class.fileuploader.php');
						$FileUploader = new FileUploader('files');

                        $json = json_decode($post_data['fileuploader-list-files']);
						@mkdir("public/small/bds");
						@mkdir("public/userfiles/bds");
                        @mkdir("public/userfiles/bds/$idbds");
                        @mkdir("public/small/bds/$idbds");
                        $i = 1;

                        foreach($json as $item){
                            $image = str_replace("0:/","",$item->file);
                            //chuyen bi file moi
                            $path = "public/temp_upload/";
                            $new_path = "public/userfiles/bds/$idbds/";
                            $new_path_small = "public/small/bds/$idbds/";
							$db_path = "bds/$idbds/";
                            $ext = $this->getFileExt($image);
                            $new_name = create_slug($data_db['title']) . "-" . $i . "." . $ext;

                            //di chuyen file
                            if(copy($path . $image, $new_path . $new_name)){
								FileUploader::resize($new_path . $new_name, $width = 500, $height = 500, $destination = $new_path_small . $new_name, $crop = false, $quality = 90, $rotation = 0);

							}

                            //water mark
							/*
                            $imgConfig = array();

                            $imgConfig['image_library'] = 'GD2';

                            $imgConfig['source_image']  = $new_path . $new_name;
                            $imgConfig['wm_type']       = 'overlay';
                            $imgConfig['wm_hor_alignment']       = 'right';

                            $imgConfig['wm_overlay_path'] = 'public/userfiles/logo-default.png';

                            $this->load->library('image_lib', $imgConfig);

                            $this->image_lib->initialize($imgConfig);

                            $this->image_lib->watermark();
							*/

                            //tìm defaule image
                            if ($i == 1) {
                                $default_image = $db_path . $new_name;
                            }

                            if (!empty($post_data['default_image'])) {
                                if ($post_data['default_image'] == $image) {
                                    $default_image = $db_path . $new_name;
                                }
                            }

                            //insert database
                            $data_image = ["path" => $db_path . $new_name, "id_bds" => $idbds];
                            $this->MCommon->insert($data_image,'bds_images');

                            //update defaule image
                            $this->MCommon->update(['default_image'=>$default_image],'bds',['id'=>$idbds]);
                            $i++;

                        }
						
                    }

                    redirect('tin-da-dang', 'refresh');
                }
            }


        }

        $listcat = $this->MCommon->getAllRowByWhere('bds_cat',[],null,'orders ASC');
        if($listcat)
            $data['listcat'] = $listcat;
		
		$listtinhthanh = $this->MCommon->getAllRow('tinh_thanh');
		if($listtinhthanh)
			$data['listtinhthanh'] = $listtinhthanh;
		
        //breadcrumb
        $breadcrumb = [
            'Đăng tin bất động sản, bán, cho thuê' => ''
        ];

        //custom script
        $scripts[] = '<script type="text/javascript" src="'.base_url('public/templates/user/default/js/custom_map.js').'"></script>';
        $scripts[] = '<script type="text/javascript" src="'.base_url('public/fileuploader/js/jquery.fileuploader.js').'"></script>';
        $scripts[] = '<script>var image_list = [];</script>';
        $scripts[] = '<script type="text/javascript" src="'.base_url('public/fileuploader/js/custom_dangtin.js?v=1.0').'"></script>';

        //template
        $data['title'] = "Đăng tin bất động sản, bán, cho thuê";
        $data['breadcrumb'] = $breadcrumb;
        $data['scripts'] = $scripts;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
}
