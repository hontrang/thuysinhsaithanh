<?php
class Ajax extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MSearch');
        $this->load->model('MCommon');
    }
    public function getTinhThanh()
    {
       $this->load->model('MAjax');
       $listtinhthanh = $this->MAjax->getTinhThanh();
       return $listtinhthanh;
    }

    public function getQuanHuyen($id_tinh_thanh = 0)
    {
        if($id_tinh_thanh == 0)
            $id_tinh_thanh = $this->input->post('data');
        $this->load->model('MAjax');
        $list = $this->MAjax->getQuanHuyen($id_tinh_thanh);

        $data = array();
        $i = 0;
        foreach($list as $item)
        {
            $data[$i]['id'] = $item->id;
            $data[$i]['name'] = $item->loai." ".$item->name;
            $i++;
        }
        echo $json = json_encode($data);
    }

    public function getPhuongXa($id_quan_huyen = 0)
    {
       if($id_quan_huyen == 0)
        $id_quan_huyen = $this->input->post('data');
       $this->load->model('MAjax');
       $list = $this->MAjax->getPhuongXa($id_quan_huyen);

       $data = array();
       $i = 0;
       foreach($list as $item)
       {
            $data[$i]['id'] = $item->id;
            $data[$i]['name'] = $item->loai." ".$item->name;
            $i++;
       }
       echo $json = json_encode($data);
    }

    public function getDuong($id_quan_huyen = 0)
    {
       if($id_quan_huyen == 0)
        $id_quan_huyen = $this->input->post('data');
       $this->load->model('MAjax');
       $list = $this->MAjax->getDuong($id_quan_huyen);

       $data = array();
       $i = 0;
       foreach($list as $item)
       {
            $data[$i]['id'] = $item->id;
            $data[$i]['name'] = $item->loai." ".$item->name;
            $i++;
       }
       echo $json = json_encode($data);
    }

    public function getCatbyType($type_id = 0)
    {
       if($type_id == 0)
        $type_id = $this->input->post('data');
       $this->load->model('MAjax');
       $list = $this->MAjax->getCatbyType($type_id);

       $data = array();
       $i = 0;
       foreach($list as $item)
       {
            $data[$i]['id'] = $item->id;
            $data[$i]['name'] = $item->ten;
            $i++;
       }
       echo $json = json_encode($data);
    }


    public function getPlaces()
    {
        //'radius=' + radius_set +'&lat=' + map_lat + '&lng=' + map_lng + '&type=' + places_set,
        $radius = (int)$this->input->post('radius');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $type = $this->input->post('type');


        if($radius == 0)
            $radius = 500;

        $text = "";
        $temp = explode(",",$type);
        foreach ($temp as $value)
        {
            if($value != ""){
                $text .= $this->getType($value);
            }
        }
        $data = array();

        $datatemp = array();

        $temp2 = explode(",",$text);

        foreach ($temp2 as $t)
        {
            //$this->getPlaceByRadius($lat,$lng,$radius,$t);
            $datatemp = null;
            if($t != ""){
                $datatemp = $this->getDataMap($lat,$lng,$radius,$t,"",[]);
                //echo var_dump($datatemp);
                $data = ((array)$datatemp + (array)$data);
            }
        }
        echo json_encode($data);

    }
    private function getDataMap($lat,$lng,$radius,$type,$pagetoken,$data){
        for($i=0;$i<9999;$i++)
        {
            $a = $this->getPlaceByRadius($lat,$lng,$radius,$type,$pagetoken,$data);
            if($a['next'] == 1)
            {
                $pagetoken = $a['next_page_token'];
                $data = $a['data'];
            }
            else{
                $data = $a['data'];
                break;
            }
        }
        return $data;
    }

    private  function getPlaceByRadius($lat,$lng,$radius,$type,$pagetoken = "",$data = array()){

        $temp1 = explode(":",$type);
        $typeid = $temp1[1];
        $type = $temp1[0];
        $latlng = urlencode("$lat,$lng");
        if($pagetoken != "")
        {
            $pagetoken = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyCAsGQLijLcDJebmWNbKF5GM8OmWQT1_Yw&pagetoken=$pagetoken";
        }
        else{
            $pagetoken = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$latlng&radius=$radius&type=$type&language=vi&key=AIzaSyCAsGQLijLcDJebmWNbKF5GM8OmWQT1_Yw";
        }
        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => $pagetoken,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if (!$err) {
            $repo = json_decode($response);


            $next_page_token = "";
            if(isset($repo->next_page_token))
                $next_page_token = $repo->next_page_token;


            foreach ($repo->results as $place)
            {

                $key = $place->place_id;
                $data[$key]['lat'] = $place->geometry->location->lat;
                $data[$key]['lng'] = $place->geometry->location->lng;
                $data[$key]['name'] = $place->name;
                $data[$key]['vicinity'] = $place->vicinity;
                $data[$key]['type'] = $typeid;
                $data[$key]['distance'] = $this->calculate_distance($lat,$lng,$place->geometry->location->lat,$place->geometry->location->lng);
            }

        }

        if($next_page_token != "")
        {
            //echo "-".$next_page_token."<br />";
            //sleep(4);
            //getPlaceByRadius($lat,$lng,$radius,$type,$next_page_token,$data);
            $repo2['next'] = 1;
            $repo2['next_page_token'] = $next_page_token;
            $repo2['data'] = $data;

        }
        else{
            $repo2['next'] = 0;
            $repo2['data'] = $data;
        }

        return $repo2;
    }

    private function getType($id){
        $text = "";
        switch ($id) {
            case 1:
                $text .= "school:$id,";
                $text .= "university:$id,";
                break;
            case 2:
                $text .= "bus_station:$id,";
                $text .= "subway_station:$id,";
                $text .= "train_station:$id,";
                $text .= "transit_station:$id,";
                break;
            case 3:
                $text .= "restaurant:$id,";
                break;
            case 4:
                $text .= "";
                break;
            case 5:
                $text .= "atm:$id,";
                break;
            case 6:
                $text .= "shopping_mall:$id,";
                $text .= "store:$id,";
                $text .= "hardware_store:$id,";
                $text .= "electronics_store:$id,";
                $text .= "electrician:$id,";
                $text .= "pet_store:$id,";
                break;
            case 7:
                $text .= "spa:$id,";
                break;
            case 8:
                $text .= "stadium:$id,";
                $text .= "museum:$id,";
                $text .= "library:$id,";
                $text .= "museum:$id,";
                $text .= "park:$id,";
                $text .= "church:$id,";
                break;


        }

        return $text;
    }

    private function calculate_distance($lat1, $lon1, $lat2, $lon2, $unit='N')
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    public function checkOffice()
    {
        $this->load->model('MAjax');
        $id_tinh_thanh = $this->input->post('data');
        $check = $this->MAjax->checkOffice($id_tinh_thanh);
        if($check)
            $data['error'] = 0;
        else
            $data['error'] = 1;

        echo json_encode($data);
    }


    public function getinfo()
    {
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?latlng=".urlencode("$lat,$lng")."&key=AIzaSyBWqQ3jrr5kabzGhOb8e_Q_HFM80zU0XQM");
        curl_setopt($c, CURLOPT_HEADER, false);
        curl_setopt($c, CURLOPT_TIMEOUT, 30);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        $geoinfo = curl_exec($c);
        curl_close($c);
        $geoinfo = json_decode($geoinfo);
        if(isset($geoinfo->results))
        {
            $results= $geoinfo->results;
            print_r($results);
            exit;
            $vitri = count($results[0]->address_components);
            $tinh = $results[0]->address_components[$vitri-2]->long_name;
            $this->load->model('MCommon');
            $tinhinfo = $this->MCommon->getIDTinhByName($tinh);

            $this->session->set_userdata('user_lat',$lat);
            $this->session->set_userdata('user_lng',$lng);
            $this->session->set_userdata('user_id_tinh',$tinhinfo->id);

            $repo['error'] = 0;
            $repo['lat'] = $lat;
            $repo['lng'] = $lng;
            $repo['id_tinh'] = $tinhinfo->id;
            $repo['reset'] = 1;

        }
        else{
            $this->session->set_userdata('user_lat','10.9743403');
            $this->session->set_userdata('user_lng','106.8001511');
            $this->session->set_userdata('user_id_tinh',5);
            $repo['error'] = 1;
            $repo['reset'] = 1;
        }
        echo json_encode($repo);

    }


    public function build_tinh(){
        $list = $this->MCommon->getAllRow("tinh_thanh");
        if($list){
            foreach ($list as $item){
                $data = null;
                $search = urlencode($item->name.", Việt Nam");
                $data = json_decode($this->_cURL("https://maps.googleapis.com/maps/api/geocode/json?address=$search&key=AIzaSyCAsGQLijLcDJebmWNbKF5GM8OmWQT1_Yw"));
                if(isset($data->status) and $data->status == 'OK'){
                    $lat = $data->results[0]->geometry->location->lat;
                    $lng = $data->results[0]->geometry->location->lng;
                    $this->MCommon->update(['lat'=>$lat, 'lng'=>$lng],'tinh_thanh',['id'=>$item->id]);
                }
            }
        }
    }

    private function _cURL($url,$postdata = "",$header = ""){

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        if($postdata != ''){
            curl_setopt($c, CURLOPT_POST, true);
            curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
        }
        if($header != '') {
            curl_setopt($c, CURLOPT_HTTPHEADER, $header);
        }
        $page = curl_exec($c);
        curl_close($c);
        return $page;
    }
}

