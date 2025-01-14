<?php
class MUser extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
      
    public function getUserInfo($userid){
        $this->db->select('*');
        $this->db->where(["id"=> $userid]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

    public function checkLogin($email,$password){
        $this->db->select('*');
        $this->db->where(["email"=> $email, 'password'=>$password]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }
	
	public function checkLogin2($email,$password){
        $this->db->select('*');
        $this->db->where(["phone"=> $email, 'password'=>$password]);
        $this->db->from('users');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

    public function getAllRowWithPage($limit,$offset,$userid=''){
        $this->db->select('orders.*,
                                 users.ho as user_ho, users.name as user_name, users.email as user_email, users.phone as user_phone');
        $this->db->from('orders');
        $this->db->join('users','users.id = orders.create_user','left');
		if($userid != '')
            $this->db->where(['orders.create_user'=>$userid]);
        else
            $this->db->where(['orders.create_user'=>$this->session->userdata("userid")]);
		
        $this->db->limit($limit, $offset);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getTotalRow(){
        $this->db->select('id');
        $this->db->where(['create_user'=>$this->session->userdata("userid")]);
        $query = $this->db->get('orders');
        return $query->num_rows();
    }

    public function getUserAllRowWithPage($filter,$limit,$offset){
        $this->db->select('users.*,
                                 groups.name as group_name,
                                 teacher.name as teacher_name');
        $this->db->from('users');
        $this->db->join('groups','groups.id = users.group_id','left');
        $this->db->join('teacher','teacher.id = users.teacher_id','left');
        if($filter == "admin")
            $this->db->where(['type'=>3]);
        elseif($filter == "teacher")
           $this->db->where(['type'=>2]);
		elseif($filter == "vip")
           $this->db->where(['type'=>1]);
        elseif($filter == "online"){
            $time  = time()-30;
            $date_time = date("Y-m-d H:i:s", $time);
            $this->db->where(['last_active >'=>$date_time]);
        }
        else
            $this->db->where(['type'=>0]);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

	public function searchUser($semail,$sname,$saddress,$sphone){
        $this->db->select('users.*,
                                 groups.name as group_name,
                                 teacher.name as teacher_name');
        $this->db->from('users');
        $this->db->join('groups','groups.id = users.group_id','left');
        $this->db->join('teacher','teacher.id = users.teacher_id','left');
        
		if($semail != "")
            $this->db->where(['email'=>$semail]);
        
		if($sname != "")
            $this->db->like('users.name', $sname);
		
		if($saddress != "")
            $this->db->like('address', $saddress);
		
		if($sphone != "")
            $this->db->where(['phone'=>$sphone]);
		
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
	
    public function getUserTotalRow($filter){
        $this->db->select('users.*,
                                 groups.name as group_name,
                                 teacher.name as teacher_name');
        $this->db->from('users');
        $this->db->join('groups','groups.id = users.group_id','left');
        $this->db->join('teacher','teacher.id = users.teacher_id','left');
        if($filter == "admin")
            $this->db->where(['type'=>3]);
        elseif($filter == "teacher")
           $this->db->where(['type'=>2]);
		elseif($filter == "vip")
           $this->db->where(['type'=>1]);
        else
            $this->db->where(['type'=>0]);
        $query = $this->db->get();
        return $query->num_rows();
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
	
	public function getLoginAlert($limit,$offset){
        $this->db->select('login_alert.*,
                                  users.ho as user_ho, users.name as user_name, users.last_active as user_last_active');
        $this->db->from('login_alert');
        $this->db->join('users','users.id = login_alert.user_id','left');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }



}
?>