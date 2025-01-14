<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 1:29 PM
 * Date: 8/21/17 4:42 PM
 *
 */

class MAuth extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
      


    public function checkLogin($email,$password){
        $this->db->select('*');
        $this->db->where(["username"=> $email, 'password' => $password, 'type' => 1]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;

    }

    public function getListPermission(){
        $query=$this->db->get("permission");
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getCurrentPermission($id){
        $this->db->where(["groupid"=> $id]);
        $query=$this->db->get("permission_set");
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function editPermission($data,$id){
        //xoa permission cu
        $this->db->where('groupid', $id)->delete('permission_set');
        if(count($data) > 0)
        {
            $query = $this->db->insert_batch('permission_set', $data);
            if($query)
                return true;
            return false;
        }
        else
        {
            return true;
        }

    }

    public function insertLogslogin($userid,$username){
        $data = ['type'=> 'login','msg'=>$username.' đã đăng nhập vào hệ thống.','userid'=>$userid];
        if($this->db->insert("logs",$data) > 0)
            return $this->db->insert_id();
        else
            return 0;

    }

}
?>