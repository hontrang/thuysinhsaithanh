<?php
/**
 * Class Cart
 * @property MLandSale $MLandSale landsale module
 */
class MLandSale extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
      
    public function getAll($limit,$offset){
        $this->db->select('bds.*,
                                
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        
        $this->db->where("status",1);
        
        
        $this->db->from('bds');
        
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->order_by('vip_type','desc');
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;   
    }

    public function getByCatID($id,$limit,$offset){
        $this->db->select('bds.*,
                                bds_cat.id as cat_id, bds_cat.name as cat_name,
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->where("status",1);
        $this->db->where("bds.cat",$id);

        
        $this->db->from('bds');
        
        $this->db->join('bds_cat', 'bds_cat.id = bds.cat', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->limit($limit, $offset);
        $this->db->order_by('vip_type','desc');
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;   
    }
    public function getByProvinceID($id,$province,$type){
        $this->db->select('bds.*,
                                
                                danh_muc.ten as cat_name,
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->where(["bds.type"=> $type, "bds.id <>" => $id,'province'=>$province]);
        $this->db->where("status",1);
        
        
        $this->db->from('bds');
        
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->limit(6);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
    public function getByID($id){
        $this->db->select('bds.*,
                                
                                tinh_thanh.name as province_name, tinh_thanh.slug as province_slug,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type, quan_huyen.slug as district_slug,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type, phuong_xa.slug as ward_slug,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->where(["bds.id" => $id]);
        $this->db->where("status",1);
        
        
        $this->db->from('bds');
        
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }

    public function getImgByID($id){
        $this->db->select('*');
        $this->db->where(["id_bds" => $id]);
        $this->db->from('bds_images');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;

    }

    public function getTotalRowCat($id){
        $this->db->select('id');
        $this->db->where(["cat" => $id]);
        $this->db->where("status",1);
        
        
        $query = $this->db->get("bds");
        return $query->num_rows();   
    }

    public function getTotalRow(){
        $this->db->select('id');
        $this->db->where(["type"=> 1]);
        $this->db->where("status",1);
        
        
        $query = $this->db->get('bds');
        return $query->num_rows();   
    }


    public function getCatInfo($slug){
        $this->db->where(["slug"=> $slug]);
        $this->db->from('bds_cat');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;   
    }
}
?>