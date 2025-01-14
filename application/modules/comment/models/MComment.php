<?php
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
 * @property MCompany $MLandSale landsale module
 */
class MComment extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAllRowWithPage($parent_id,$limit,$offset,$order= ""){
        $this->db->select('*');
        $this->db->from('hotel_cat');
        $this->db->where('parent_id',$parent_id);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


    public function getAllRowWithPage2($filter_id,$limit,$offset){
        $this->db->select('tour_filter.tour_id, tour_filter.filter_id,tour.id, tour.name, tour.slug, tour.code, tour.time, tour.time_start, tour.seat, tour.price, tour.ribbon, tour.vote, tour.vote_point, tour.image');
        $this->db->from('tour_filter');
        $this->db->join('tour', 'tour.id = tour_filter.tour_id','left');
        $this->db->where('tour_filter.filter_id',$filter_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getTotalRow($parent_id,$where=''){
        $this->db->select('id');
        $this->db->where('parent_id',$parent_id);
        if($where != "")
            $this->db->where($where);
        $query = $this->db->get('hotel_cat');
        return $query->num_rows();
    }


    public function getMaxOrder($table,$parent_id=""){
        $this->db->select('orders');
        $this->db->from($table);
        if($parent_id !="")
            $this->db->where('parent_id',$parent_id);
        $this->db->order_by('orders','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }

    public function getPreItem($table,$orders,$parent_id=""){
        $this->db->select('orders,id');
        $this->db->from($table);
        if($parent_id !="")
            $this->db->where(['orders <'=>$orders,'parent_id'=>$parent_id]);
        else
            $this->db->where(['orders <'=>$orders]);
        $this->db->limit(1);
        $this->db->order_by('orders','DESC');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }

    public function getNextItem($table,$orders,$parent_id=""){
        $this->db->select('orders,id');
        $this->db->from($table);
        if($parent_id !="")
            $this->db->where(['orders >'=>$orders,'parent_id'=>$parent_id]);
        else
            $this->db->where(['orders >'=>$orders]);
        $this->db->limit(1);
        $this->db->order_by('orders','ASC');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->row();
        return false;
    }


}
?>