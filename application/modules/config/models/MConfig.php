<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 3:05 PM
 * Date: 10/3/17 11:25 AM
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
class MConfig extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getEventRelated($slug){
        $this->db->select('*');
        $this->db->from('event');
        $this->db->where('slug !=',$slug);
        $this->db->order_by('id','desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }



}
?>