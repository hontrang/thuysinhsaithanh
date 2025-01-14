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
class MNews extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAllRowWithPage($lang,$parent_id,$limit,$offset,$order= ""){
        $table = 'car_cat';
        $this->db->select($table.'.*,'.$table.'_lang.*');

        $this->db->from($table);
        $this->db->where('parent_id',$parent_id);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    

    public function getTotalRow($lang,$parent_id,$where=''){
        $table = 'car_cat';

        $this->db->where('parent_id',$parent_id);
        if($where != "")
            $this->db->where($where);
        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get($table);
        return $query->num_rows();
    }





}
?>