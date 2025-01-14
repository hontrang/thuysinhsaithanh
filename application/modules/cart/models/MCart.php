<?php

/**
 * Class Cart
 * @property MCart $MCart cart module
 */
class MCart extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function TimKhachHang($key){
        $this->db->select('userbot.idface as id,userbot.name as name, userbot.tinh as tinh, userbot.thanhpho as thanhpho, userbot.pic as pic, userbot.address as address, userbot.phone as phone, userbot.realname as realname');
        $this->db->from('userbot');
        $this->db->like('name',$key);
        $this->db->or_like('phone',$key);
        $this->db->order_by('last_active','desc');
		if($key == "")
			$this->db->limit(100);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getTotalRow($status){
        $this->db->select('id');
        $this->db->where(['status'=>$status]);
        $query = $this->db->get('orders');
        return $query->num_rows();
    }





}
?>