<?php
/**
 * Class Cart
 * @property MLandSale $MLandSale landsale module
 */
class MHome extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getBDSHome(){
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
        $this->db->limit(12);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


    public function getWord($today){
        $this->db->select('*');
        $this->db->where("date",$today);
        $this->db->from('words');
        $this->db->order_by('id','desc');
        $this->db->limit(3);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getWordRand(){
        $this->db->select('*');
        $this->db->from('words');
        $this->db->order_by('rand()');
        $this->db->limit(3);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
    public function getTotalUser(){
        $this->db->select('id,is_admin,is_teacher');
        $this->db->from('users');
        $this->db->where(['is_admin'=>0, 'is_teacher'=>0]);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalCource(){
        $this->db->select('id');
        $this->db->from('cource');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalCourceFree(){
        $this->db->select('id');
        $this->db->from('courcefree');
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function getTotalTeacher(){
        $this->db->select('id');
        $this->db->from('teacher');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalOrderUncheck(){
        $this->db->select('id,status');
        $this->db->from('orders');
        $this->db->where(['status'=>0]);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalOrderPendding(){
        $this->db->select('id,status');
        $this->db->from('orders');
        $this->db->where(['status'=>1]);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalContactUnview(){
        $this->db->select('id,view');
        $this->db->from('contact');
        $this->db->where(['view'=>0]);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getDoanhThuTheoThang($year,$month){
        $this->db->select('status, SUM(pay_price) as total_pay_price, COUNT(pay_price) as total_order');
        $this->db->from('orders');
        $this->db->where(['status'=>2,'MONTH(create_date)'=>$month]);
        $this->db->group_by(['status']);
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row();
        else
            return false;
    }

    public function getTotalOrderToday(){
        $this->db->select('id');
        $this->db->from('orders');
        $this->db->where(['DAY(create_date)'=>date("d"),'MONTH(create_date)'=>date("m"),'YEAR(create_date)'=>date("Y")]);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalDoanhThuToday(){
        $this->db->select('status, SUM(pay_price) as total_pay_price, COUNT(pay_price) as total_order');
        $this->db->from('orders');
        $this->db->where(['status'=>2,'DAY(create_date)'=>date("d"),'MONTH(create_date)'=>date("m"),'YEAR(create_date)'=>date("Y")]);
        $this->db->group_by(['status']);
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row();
        else
            return false;
    }

    public function getTotalDoanhThu(){
        $this->db->select('status, SUM(pay_price) as total_pay_price, COUNT(pay_price) as total_order');
        $this->db->from('orders');
        $this->db->where(['status'=>2]);
        $this->db->group_by(['status']);
        $query = $this->db->get();
        if($query->num_rows() >0)
            return $query->row();
        else
            return false;
    }

    public function getTotalUserOnline(){
        //SELECT COUNT(*) FROM users WHERE last_activity > ;
        $this->db->select('id');
        $this->db->from('ci_sessions');
        $this->db->where(['timestamp >'=>'NOW() - INTERVAL 5 MINUTE']);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>