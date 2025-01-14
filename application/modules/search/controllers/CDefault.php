<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/17/17 10:28 AM
 * Date: 7/28/17 11:05 AM
 *
 */

class CDefault extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MSearch');
        $this->load->model('MCommon');
    }

    public function index()
    {
        //stype=2&scat=0&sprovince=0&sdistrict=0&sward=0&sstreet=0&sMucGia=-1&MucGiamin=&MucGiamax=&sDienTich=-1&DienTichmin=&DienTichmax=
        if($this->input->get('btn-search-map') == 1){
            $this->searchMap();
            die;
        }
        if(empty($this->input->get('btn-search-map')) and empty($this->input->get('btn-search'))){
            $this->router->set_method('showsearchbox');
            $this->showSearchBox();
            die;
        }
        $data = array();
        $data["type"] = (int)$this->input->get('stype');
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
        $config['base_url'] = site_url().'tim-kiem/';
        $config['total_rows'] = $this->MSearch->getTotalRow($data);
        $config['per_page'] = 5;
        $config['uri_segment'] = 2;
        $config['reuse_query_string'] = true;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MSearch->getAll($data,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;

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
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
    public function searchMap()
    {
        $data = array();
        $data["type"] = (int)$this->input->get('stype');
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
        $config['base_url'] = site_url().'tim-kiem-map/';
        $config['total_rows'] = $this->MSearch->getTotalRow($data);
        $config['per_page'] = 50;
        $config['uri_segment'] = 2;
        $config['reuse_query_string'] = true;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(2)?$this->uri->segment(2):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $listBDS = $this->MSearch->getAll($data,$config['per_page'],$start);
        $pagination_link = $this->pagination->create_links();

        if($listBDS)
            $data['listBDS'] = $listBDS;

        //breadcrumb
        $breadcrumb = [
            'Tìm kiếm theo bản đồ' => ''
        ];

        if($this->session->userdata('user_lat') != '' and $this->session->userdata('user_lng') != ''){
            $user_lat = $this->session->userdata('user_lat');
            $user_lng = $this->session->userdata('user_lng');
        }else{
            $user_lat = "15.374152";
            $user_lng = "108.038058";
        }
        $zoom = '13';

        if($data["province"] != 0){
            $province = $this->MCommon->getRow('tinh_thanh',['id'=>$data["province"]]);
            if($province){
                $user_lat = $province->lat;
                $user_lng = $province->lng;
                $zoom = 10;
            }
        }


        //custom script
        $text = "";
        $text_json = null;
        foreach ($data_post as $key => $item)
        {
            $text .= "var s".$key."_id = ".$item."; ";
            $text_json['s'.$key] = $item;
        }
        $scripts[] = '<script>'.$text.'</script>';
        $scripts[] = '<script> var data_search = '.json_encode($text_json).';</script>';
        $scripts[] = '<script>var user_lat = "'.$user_lat.'";var user_lng = "'.$user_lng.'";var map_zoom = '.$zoom.';</script>';
        $scripts[] = '<script>
                $("#stype").val(stype_id).attr("selected","selected").trigger("change");
                $("#sprovince").val(sprovince_id).attr("selected","selected").trigger("change");
                $("#sdirection").val(sdirection_id).attr("selected","selected").trigger("change");
                $("#sbedroom").val(sbedroom_id).attr("selected","selected").trigger("change");
        </script>';

        $scripts[] = '<script type="text/javascript" src="'.base_url('public/templates/user/hoinhadat/js/custom_map_search.js?v=1.1').'"></script>';
        $scripts[] = '<script type="text/javascript">addMarker();</script>';


        //custom
        $totalBDS = $config['total_rows'];

        //template
        $data['title'] = "Tìm kiếm theo bản đồ";
        $data['breadcrumb'] = $breadcrumb;
        $data['totalBDS'] = $totalBDS;
        $data['scripts'] = $scripts;
        $data['pagination_link'] = $pagination_link;
        $data['module'] = $this->router->fetch_module();
        $data['method'] = 'searchMap';
        echo modules::run('template/getlayout/user', $data);
    }

    public function showSearchBox()
    {
        $listtinhthanh = Modules::run('search/Ajax/getTinhThanh');
        $data['listtinhthanh'] = $listtinhthanh;

        //template
        $data['title'] = "Tìm kiếm";
        $data['module'] = $this->router->fetch_module();
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/user', $data);
    }
    public function detailAjax(){
        $id = (int)$this->input->post('id');
        if($id != 0 and $id != ''){
            $info = $this->MCommon->getRow('bds',['id'=>$id]);
            if($info){
                $repo['error'] = 0;
                $area = ($info->area > 0)?number_format($info->area):'Không xác định';
                $street_width = ($info->street_width != "" and $info->street_width != 0)?$info->street_width:"---";
                $facade = ($info->facade != "" and $info->facade != 0)?$info->facade:"---";
                $floor = ($info->floor != "" and $info->floor != 0)?$info->floor:"---";
                $toilet = ($info->toilet != "" and $info->toilet != 0)?$info->toilet:"---";
                $bedroom = ($info->bedroom != "" and $info->bedroom != 0)?$info->bedroom:"---";
                $landlong = ($info->landlong != "" and $info->landlong != 0)?$info->landlong:"-";
                $landwidth = ($info->landwidth != "" and $info->landwidth != 0)?$info->landwidth:"-";
                $repo['data'] = '<div class="row">
                        <div class="col-md-8">
                            <h1 class="title">'.$info->title.'</h1>

                            <div class="detail">
                                <div class="price">Giá: <span>'.price_format($info->price).'</span></div>
                                <div class="bds-detail">'.$info->detail.'</div>
                            </div>
                            
                            <table class="table-bordered table-responsive bds-info">
                            <h4><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin BĐS</h4>
                            <tbody>
                            <tr>
                                <th>Giá</th>
                                <td colspan="3">'.price_format($info->price).'</td>
                            </tr>
                           
                            <tr>
                                <th>Diện tích</th>
                                <td colspan="3">'.$area.' m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th>Kích thước</th>
                                <td colspan="3">'.$landlong.' x '.$landwidth.' m</td>
                            </tr>
                            <tr>
                                <th>Tình trạng pháp lý</th>
                                <td colspan="3">Pháp lý</td>
                            </tr>
                            <tr>
                                <th>Đường trước nhà</th>
                                <td colspan="3">'.$street_width.'</td>
                            </tr>
                            <tr>
                                <th>Hướng</th>
                                <td>Không xác định</td>
                                <td class="font-bold">Mặt tiền</td>
                                <td>'.$facade.'</td>
                            </tr>
                            <tr>
                                <th>Số tầng</th>
                                <td colspan="3">'.$floor.'</td>
                            </tr>
                            <tr>
                                <th>Phòng tắm</th>
                                <td>'.$toilet.'</td>
                                <td class="font-bold">Phòng ngủ</td>
                                <td>'.$bedroom.'</td>
                            </tr>
                            </tbody>
                        </table>
                        <div style="text-align: center; margin-top: 15px">
                            <a onclick="location.href=window.location.href" class="btn btn-info"><i class="fa fa-search"></i> Xem chi tiết</a>
                        </div>
                        </div>
                        <div class="col-md-4 sticker">
                            <div class="contact-info">
                                <h1 class="title">Liên hệ</h1>
                                <form method="POST" id="form-contac-bds">

                                    <div class="form-group">
                                        <label for="pwd">Tên <span class="required">*</span>:</label>
                                        <input name="name" type="text" class="form-control" placeholder="Tên của bạn" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Email:</label>
                                        <input name="email" type="email" class="form-control" placeholder="Email của bạn" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">SĐT <span class="required">*</span>:</label>
                                        <input name="phone" type="text" class="form-control" placeholder="SĐT liên hệ của bạn" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Nội dung liên hệ <span class="required">*</span>:</label>
                                        <textarea name="content" class="form-control" placeholder="Nội dung cần liên hệ" required></textarea>
                                    </div>
                                    <div style="text-align: center">
                                        <button type="submit" name="btnSubmitContact" class="btn btn-primary">Gửi liên hệ</button>
                                    </div>
                                    <div id="contact_repo" style="text-align: center; margin-top: 5px; color: red">
                                        
                                    </div>
                                    
                                </form>
                            </div>

                        </div>
                    </div>';
                    $images_html = null;
                    $images = $this->MCommon->getAllRowByWhere('bds_images',['id_bds'=>$id]);
                    if($images){
                        if($images)foreach ($images as $image){
                            $images_html = $images_html.'<img data-description="" data-image="'.base_url().$image->path.'" src="'.base_url().$image->path.'" />';
                        }
                    }
                    $repo['images'] = $images_html;
            }
        }
        echo json_encode($repo);
        exit;
    }
    public function searchMapAjax(){

        $data = array();
        $data["type"] = (int)$this->input->post('stype');
        $data["cat"] = (int)$this->input->post('scat');
        $data["province"] = (int)$this->input->post('sprovince');
        $data["district"] = (int)$this->input->post('sdistrict');
        $data["ward"] = (int)$this->input->post('sward');
        $data["street"] = (int)$this->input->post('sstreet');
        $data["MucGia"] = (int)$this->input->post('sMucGia');
        $data["MucGiamin"] = (int)$this->input->post('MucGiamin');
        $data["MucGiamax"] = (int)$this->input->post('MucGiamax');
        $data["DienTich"] = (int)$this->input->post('sDienTich');
        $data["DienTichmin"] = (int)$this->input->post('DienTichmin');
        $data["DienTichmax"] = (int)$this->input->post('DienTichmax');
        $data["direction"] = (int)$this->input->post('sdirection');
        $data["bedroom"] = (int)$this->input->post('sbedroom');

        $data["latNW"] = $this->input->post('latNW');
        $data["latSE"] = $this->input->post('latSE');
        $data["lngNW"] = $this->input->post('lngNW');
        $data["lngSE"] = $this->input->post('lngSE');
        $data_post = $data;

        $repo['latNW'] = $data["latNW"];
        $repo['latSE'] = $data["latSE"];
        $repo['lngNW'] = $data["lngNW"];
        $repo['lngSE'] = $data["lngSE"];

        $listBDS = $this->MSearch->getAllAjax($data,200);
        if($listBDS){
            $repo['error'] = 0;
            $repo['data'] = $listBDS;
        }
        else{
            $repo['error'] = 1;
            $repo['msg'] = 'Không có dữ liệu';
        }
        echo json_encode($repo);
        exit;
    }

}
?>