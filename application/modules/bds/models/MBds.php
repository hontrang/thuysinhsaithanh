<?php
/**
 * Class Cart
 * @property MLandSale $MLandSale landsale module
 */
class MBds extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
      
    public function insertBDS($data){
        if($this->db->insert("bds",$data) > 0)
            return $this->db->insert_id();
        else
            return 0;
        
    }

    public function insertImagesBDS($data){
        if($this->db->insert("bds_images",$data) > 0)
            return $this->db->insert_id();
        else
            return 0;
        
    }

    public function updateDefaultImageBDS($default_image,$idbds){
        $this->db->set('default_image', $default_image);
        $this->db->where('id', $idbds);
        return $this->db->update('bds');
    }

    public function insertNewUser($data){
        if($this->db->insert("users",$data) > 0)
            return $this->db->insert_id();
        else
            return 0;

    }

    public function getUserInfoById($id){
        $this->db->select('*');
        $this->db->where(["id"=> $id]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;

    }

    public function getUserInfoByUsername($username){
        $this->db->select('*');
        $this->db->where(["username"=> $username]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;

    }

    public function updateUserInfoById($data,$id){
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('users');
    }

    public function deleteUserById($id){
        return  $this->db->where('id', $id)->delete('users');
    }


    public function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->where(["username"=> $username, 'password' => $password]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;

    }


    public function getListBDS($filter,$type1, $type2,$limit, $offset,$userid=""){

        $this->db->select('*');
        $this->db->where("(type='$type1' or type='$type2')");
        if($filter == "0")
        {
            $this->db->where("status",0);
        }

        if($filter == "1")
        {
            $this->db->where("status",1);
            if($type1 <3 and $type2 < 3 )
            {
                $curent_time = date('Y-m-d H:i:s');
                $this->db->where("date_to >=",$curent_time);
            }

        }

        if($filter == "2")
        {
            $curent_time = date('Y-m-d H:i:s');
            $this->db->where("date_to <",$curent_time);
        }

        $this->db->from('bds');
        if($userid != "")
            $this->db->where('user_id',$userid);
        $this->db->order_by('id','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getTotalRow($filter,$type1, $type2,$userid =""){
        $this->db->select('id');
        $this->db->where("(type='$type1' or type='$type2')");
        if($filter == "0")
        {
            $this->db->where("status",0);
        }

        if($filter == "1")
        {
            $this->db->where("status",1);
            $curent_time = date('Y-m-d H:i:s');
            $this->db->where("date_to >=",$curent_time);
        }

        if($filter == "2")
        {
            $curent_time = date('Y-m-d H:i:s');
            $this->db->where("date_to <",$curent_time);
        }

        $this->db->from('bds');

        if($userid != "")
            $this->db->where('user_id',$userid);

        $this->db->order_by('id','desc');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getListGroup(){
        $query=$this->db->get("groups");
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getListNotice(){
        $this->db->select('notice.*,
                                users.username as username');
        $this->db->from('notice');
        $this->db->join('users', 'users.id = notice.userid', 'left');
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getNoticeDetail($id){
        $this->db->select('*');
        $this->db->from('notice');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }

    public function getListNoticeforUser($userid,$limit,$offset){
        $this->db->select('notice_send.*,
                                notice.title as title,
                                notice.id as notice_id, 
                                notice.create_date as create_date');
        $this->db->from('notice_send');
        $this->db->join('notice', 'notice.id = notice_send.notice_id', 'left');
        $this->db->where('notice_send.userid',$userid);
        $this->db->order_by('id','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
    public function getListUserTotal(){
        $this->db->select('users.id');
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function getListUser($limit,$offset){
        $this->db->select('users.*,
                                groups.name as group_name,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('users');
        $this->db->join('groups', 'groups.id = users.group_id', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = users.province_id', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = users.district_id', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = users.ward_id', 'left');
        $this->db->join('duong', 'duong.id = users.street_id', 'left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getListPartner($status){
        $this->db->select('users.*,
                                groups.name as group_name,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('users');
        $this->db->join('groups', 'groups.id = users.group_id', 'left');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = users.province_id', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = users.district_id', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = users.ward_id', 'left');
        $this->db->join('duong', 'duong.id = users.street_id', 'left');
        $this->db->where('is_partner', $status);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }



    public function getNoticeCount($userid){
        $this->db->select('*');
        $this->db->from('notice_send');
        $this->db->where('userid',$userid);
        $this->db->where('view',0);
        $query = $this->db->get();
        return $query->num_rows();
    }



    public function insertNotice($data){
        return $this->db->insert('notice', $data);
    }

    public function insertNoticeSend($data){
        return $this->db->insert_batch('notice_send', $data);
    }

    public function getGroupByID($id){
        $query=$this->db->where('id',$id)
            ->get("groups");
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }

    public function addGroup($data){
        return $this->db->insert('groups', $data);
    }

    public function editGroup($data,$id){
        return  $this->db->where('id', $id)->update('groups', $data);
    }

    public function deleteGroupByID($id){
        return  $this->db->where('id', $id)->delete('groups');
    }
	
	public function getListBDSUser($limit,$offset,$user_id){
        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type,
                                users.username as user_name');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->join('users', 'users.id = bds.user_id', 'left');
		$this->db->where('bds.user_id', $user_id);
        $this->db->order_by('id','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


    public function getListBDSduyet($set_type,$limit,$offset){
        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type,
                                users.username as user_name');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->join('users', 'users.id = bds.user_id', 'left');
        $this->db->where('status', '0');
        $this->db->order_by('id','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getAllListBDS($limit,$offset,$set_type=""){

        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type,
                                users.username as user_name');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->join('users', 'users.id = bds.user_id', 'left');
        $this->db->where('status', '1');
        if($set_type != "")
            $this->db->where('province', $set_type);
        $this->db->order_by('bds.id','DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
	
	public function getTotalRowListBDSUser($user_id=""){

        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');

        $this->db->where('bds.user_id', $user_id);
		
        $this->db->order_by('id','desc');
        //$this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function getTotalRowListBDSduyet($set_type=""){

        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');

        if($set_type != "")
            $this->db->where('province', $set_type);
		
        $this->db->where('status', '0');
        $this->db->order_by('bds.id','desc');
        //$this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalRowListBDS($set_type=""){
        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->from('bds');
        $this->db->join('tinh_thanh', 'tinh_thanh.id = bds.province', 'left');
        $this->db->join('quan_huyen', 'quan_huyen.id = bds.district', 'left');
        $this->db->join('phuong_xa', 'phuong_xa.id = bds.ward', 'left');
        $this->db->join('duong', 'duong.id = bds.street', 'left');
        $this->db->where('status', '1');
        if($set_type != "")
            $this->db->where('province', $set_type);
        $this->db->order_by('bds.id','desc');
        //$this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function getBDSByID($id){
        $this->db->select('bds.*,
                                tinh_thanh.name as province_name,
                                quan_huyen.name as district_name, quan_huyen.loai as district_type,
                                phuong_xa.name as ward_name, phuong_xa.loai as ward_type,
                                duong.name as street_name, duong.loai as street_type');
        $this->db->where(["bds.id" => $id]);
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

    public function getImgBDSByID($id){
        $this->db->select('*');
        $this->db->where(["id_bds" => $id]);
        $this->db->from('bds_images');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;

    }

    public function duyettin($id){
        return  $this->db->where('id', $id)->update('bds', ['status'=>1]);
    }

    public function updateSoDu($id,$data){
        return  $this->db->where('id', $id)->update('users', $data);
    }

    public function huyduyet($id){
        return  $this->db->where('id', $id)->update('bds', ['status'=>0]);
    }

    public function xoatin($id){
        return  $this->db->where('id', $id)->delete('bds');
    }

    public function updateNoticeView($userid,$notice_id){
        return  $this->db->where(['userid'=> $userid,'notice_id'=> $notice_id])->update('notice_send', ['view'=> 1]);
    }

    public function updateRegPartner($userid){
        return  $this->db->where('id', $userid)->update('users', ['is_partner'=>3]);
    }
    public function addPartner($id){
        return  $this->db->where('id', $id)->update('users', ['is_partner'=>1]);
    }
    public function checkRegPartner($userid){
        $query = $this->db->where(['id' => $userid])->from('users')->get();
        return $query->row();
    }
}
?>