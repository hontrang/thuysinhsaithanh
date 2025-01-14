<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/26/17 3:24 PM
 * Date: 7/28/17 11:09 AM
 *
 */

/**
 * Class Cart
 * @property MSearch $MSearch search module
 */
class MSearch extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    //$limit,$offset
    public function getAll($data,$limit,$offset){
        $this->db->select('bds.*,
                                bds_cat.slug as cat_slug,
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->where("status",1);
        $this->db->join('bds_cat', 'bds_cat.id = bds.cat', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');

        if($data['cat'] != 0)
            $this->db->where("cat",$data['cat']);

        if($data['province'] != 0)
            $this->db->where("province",$data['province']);

        if($data['district'] != 0)
            $this->db->where("district",$data['district']);

        if($data['ward'] != 0)
            $this->db->where("ward",$data['ward']);

        if($data['street'] != 0)
            $this->db->where("street",$data['street']);

        if($data['direction'] != 0)
            $this->db->where("direction",$data['direction']);

        if($data['bedroom'] != 0)
            $this->db->where("bedroom",$data['bedroom']);

        if($data['MucGia'] == 0){
            if($data['MucGiamax'] != 0)
                $this->db->where(["price >=" => $data['MucGiamin']*1000000,"price <=" => $data['MucGiamax']*1000000]);
        }
        else{
            if($data['MucGia'] == 1){
                $this->db->where("price", 0);
            }
            if($data['MucGia'] == 2){
                $this->db->where("price <=", 500000000);
            }
            if($data['MucGia'] == 3){
                $this->db->where(["price >=" => 500000000,"price <=" => 800000000]);
            }
            if($data['MucGia'] == 4){
                $this->db->where(["price >=" => 800000000,"price <=" => 1000000000]);
            }
            if($data['MucGia'] == 5){
                $this->db->where(["price >=" => 1000000000,"price <=" => 2000000000]);
            }
            if($data['MucGia'] == 6){
                $this->db->where("price >=", 2000000000);
            }
        }

        if($data['DienTich'] == 0){
            if($data['DienTichmax'] != 0)
                $this->db->where(["area >=" => $data['DienTichmin'],"area <=" => $data['DienTichmax']]);
        }
        else{
            if($data['DienTich'] == 1){
                $this->db->where("area <=", 50);
            }
            if($data['DienTich'] == 2){
                $this->db->where(["area >=" => 50,"area <=" => 100]);
            }
            if($data['DienTich'] == 3){
                $this->db->where(["area >=" => 100,"area <=" => 150]);
            }
            if($data['DienTich'] == 4){
                $this->db->where(["area >=" => 150,"area <=" => 250]);
            }
            if($data['DienTich'] == 6){
                $this->db->where("area >=", 250);
            }
        }

        $this->db->order_by('vip_type','desc');
        $this->db->order_by('id','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;   
    }
    /*
     *
     *  $data["latNW"] = (int)$this->input->get('latNW');
        $data["latSE"] = (int)$this->input->get('latSE');
        $data["lngNW"] = (int)$this->input->get('lngNW');
        $data["lngSE"] = (int)$this->input->get('lngSE');
     */

    public function getAllAjax($data,$limit){
        $this->db->select('bds.*,
                                bds_cat.slug as cat_slug,
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->where("status",1);
        $curent_time = date('Y-m-d H:i:s');
        $this->db->where("date_to >=",$curent_time);
        $this->db->where("bds.map_lat >=",$data["latSE"]);
        $this->db->where("bds.map_lat <=",$data["latNW"]);
        $this->db->where("bds.map_lng >=",$data["lngNW"]);
        $this->db->where("bds.map_lng <=",$data["lngSE"]);
        $this->db->join('bds_cat', 'bds_cat.id = bds.cat', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');

        if($data['type'] != 0)
            $this->db->where("type",$data['type']);

        if($data['cat'] != 0)
            $this->db->where("cat",$data['cat']);

        if($data['province'] != 0)
            $this->db->where("province",$data['province']);

        if($data['district'] != 0)
            $this->db->where("district",$data['district']);

        if($data['ward'] != 0)
            $this->db->where("ward",$data['ward']);

        if($data['street'] != 0)
            $this->db->where("street",$data['street']);

        if($data['direction'] != 0)
            $this->db->where("direction",$data['direction']);

        if($data['bedroom'] != 0)
            $this->db->where("bedroom",$data['bedroom']);

        if($data['MucGia'] == 0){
            if($data['MucGiamax'] != 0)
                $this->db->where(["price >=" => $data['MucGiamin']*1000000,"price <=" => $data['MucGiamax']*1000000]);
        }
        else{
            if($data['MucGia'] == 1){
                $this->db->where("price", 0);
            }
            if($data['MucGia'] == 2){
                $this->db->where("price <=", 500000000);
            }
            if($data['MucGia'] == 3){
                $this->db->where(["price >=" => 500000000,"price <=" => 800000000]);
            }
            if($data['MucGia'] == 4){
                $this->db->where(["price >=" => 800000000,"price <=" => 1000000000]);
            }
            if($data['MucGia'] == 5){
                $this->db->where(["price >=" => 1000000000,"price <=" => 2000000000]);
            }
            if($data['MucGia'] == 6){
                $this->db->where("price >=", 2000000000);
            }
        }

        if($data['DienTich'] == 0){
            if($data['DienTichmax'] != 0)
                $this->db->where(["area >=" => $data['DienTichmin'],"area <=" => $data['DienTichmax']]);
        }
        else{
            if($data['DienTich'] == 1){
                $this->db->where("area <=", 50);
            }
            if($data['DienTich'] == 2){
                $this->db->where(["area >=" => 50,"area <=" => 100]);
            }
            if($data['DienTich'] == 3){
                $this->db->where(["area >=" => 100,"area <=" => 150]);
            }
            if($data['DienTich'] == 4){
                $this->db->where(["area >=" => 150,"area <=" => 250]);
            }
            if($data['DienTich'] == 6){
                $this->db->where("area >=", 250);
            }
        }


        $this->db->order_by('vip_type','desc');
        $this->db->order_by('id','desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


    public function getTotalRow($data){
        $this->db->select('bds.*,
                                bds_cat.slug as cat_slug,
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->where("status",1);
        $this->db->join('bds_cat', 'bds_cat.id = bds.cat', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');

        if($data['cat'] != 0)
            $this->db->where("cat",$data['cat']);

        if($data['province'] != 0)
            $this->db->where("province",$data['province']);

        if($data['district'] != 0)
            $this->db->where("district",$data['district']);

        if($data['ward'] != 0)
            $this->db->where("ward",$data['ward']);

        if($data['street'] != 0)
            $this->db->where("street",$data['street']);

        if($data['direction'] != 0)
            $this->db->where("direction",$data['direction']);

        if($data['bedroom'] != 0)
            $this->db->where("bedroom",$data['bedroom']);

        if($data['MucGia'] == 0){
            if($data['MucGiamax'] != 0)
                $this->db->where(["price >=" => $data['MucGiamin'],"price <=" => $data['MucGiamax']]);
        }
        else{
            if($data['MucGia'] == 1){
                $this->db->where("price", 0);
            }
            if($data['MucGia'] == 2){
                $this->db->where("price <=", 500000000);
            }
            if($data['MucGia'] == 3){
                $this->db->where(["price >=" => 500000000,"price <=" => 800000000]);
            }
            if($data['MucGia'] == 4){
                $this->db->where(["price >=" => 800000000,"price <=" => 1000000000]);
            }
            if($data['MucGia'] == 5){
                $this->db->where(["price >=" => 1000000000,"price <=" => 2000000000]);
            }
            if($data['MucGia'] == 6){
                $this->db->where("price >=", 2000000000);
            }
        }

        if($data['DienTich'] == 0){
            if($data['DienTichmax'] != 0)
                $this->db->where(["area >=" => $data['DienTichmin'],"area <=" => $data['DienTichmax']]);
        }
        else{
            if($data['DienTich'] == 1){
                $this->db->where("area <=", 50);
            }
            if($data['DienTich'] == 2){
                $this->db->where(["area >=" => 50,"area <=" => 100]);
            }
            if($data['DienTich'] == 3){
                $this->db->where(["area >=" => 100,"area <=" => 150]);
            }
            if($data['DienTich'] == 4){
                $this->db->where(["area >=" => 150,"area <=" => 250]);
            }
            if($data['DienTich'] == 6){
                $this->db->where("area >=", 250);
            }
        }


        $this->db->order_by('vip_type','desc');
        $this->db->order_by('id','desc');
        //$this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->num_rows();   
    }


}
