<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/4/17 2:09 PM
 * Date: 10/4/17 2:09 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 2:12 PM
 * Date: 9/15/17 3:05 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/29/17 5:11 PM
 * Date: 9/15/17 9:11 AM
 *
 */

/**
 * Class Cart
 * @property MLandSale $MLandSale landsale module
 */
class MContact extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getTotalRow($view){
        $this->db->select('id');
        $this->db->from('contact');
        $this->db->where(['view'=>$view]);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function getAllRowWithPage($view,$limit,$offset){
        $this->db->select('contact.*,
                                users.ho as user_ho, users.name as user_name');
        $this->db->from('contact');
        $this->db->join('users','users.id = contact.user_id','left');
        $this->db->limit($limit, $offset);
        $this->db->where(['view'=>$view]);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }



}
?>