<?php
class MAjax extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
      
    public function getTinhThanh(){
        $query=$this->db->get("tinh_thanh");
        return $query->result();
    }

    public function getQuanHuyen($id_tinh_thanh){
        $this->db->where('id_tinh_thanh', $id_tinh_thanh);
        $query = $this->db->get("quan_huyen");
        return $query->result();
    }

    public function getPhuongXa($id_quan_huyen){
        $this->db->where('id_quan_huyen', $id_quan_huyen);
        $query = $this->db->get("phuong_xa");
        return $query->result();
    }

    public function getDuong($id_quan_huyen){
        $this->db->where('id_quan_huyen', $id_quan_huyen);
        $query = $this->db->get("duong");
        return $query->result();
    }

    public function getCatbyType($type_id){
        $this->db->where('id_module', $type_id);
        $query = $this->db->get("danh_muc");
        return $query->result();
    }
    public function checkOffice($id){
        $query = $this->db->select('*')->where(['province_id'=> $id,'group_id'=>5])->get("users");
        if($query->num_rows() > 0)
            return true;
        else
            return false;

    }

}
?>