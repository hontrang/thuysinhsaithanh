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
class MConstruction extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAllRowWithPage($parent_id,$limit,$offset,$order= ""){
        $this->db->select('*');
        $this->db->from('construction_cat');
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

    

    public function getTotalRow($parent_id,$where=''){
        $this->db->select('id');
        $this->db->where('parent_id',$parent_id);
        if($where != "")
            $this->db->where($where);
        $query = $this->db->get('construction_cat');
        return $query->num_rows();
    }

    public function getAllRowWithPageSearch($lang,$name='',$cat_id='',$code='',$hot='',$new='',$limit,$offset,$order=''){
		$this->db->select('construction.*,'.'construction_lang.*');

        $this->db->from('construction');
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        $this->db->where('lang',$lang);
        $this->db->join('construction_lang','construction.id='.'construction_lang.record_id','left');
		
		if($name != "")
            $this->db->like('construction_lang.name',$name);
		
		if($cat_id != "")
            $this->db->where('cat_id',$cat_id);

        if($code != "")
            $this->db->where('code',$code);

        if($hot != "")
            $this->db->where('is_hot',$hot);

        if($new != "")
            $this->db->where('is_new',$new);
		
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


    public function getTotalRowSearch($lang,$name='',$cat_id='',$code='',$hot='',$new=''){
		$this->db->select('construction.*,construction_lang.*');

        $this->db->where('lang',$lang);
        $this->db->join('construction_lang','construction.id=construction_lang.record_id','left');
		
		if($name != "")
            $this->db->like('construction_lang.name',$name);
		
		if($cat_id != "")
            $this->db->where('cat_id',$cat_id);

        if($code != "")
            $this->db->where('code',$code);

        if($hot != "")
            $this->db->where('is_hot',$hot);

        if($new != "")
            $this->db->where('is_new',$new);
		
        $query = $this->db->get('construction');
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


    public function getRelated($construction_id){
        $this->db->select('construction_related.*,construction.name,construction.id,construction.slug,construction.image');
        $this->db->from('construction_related');
        $this->db->where('construction_id',$construction_id);
        $this->db->join('construction','construction.id = construction_related.related_id','left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function searchconstruction($q){
        $q_slug = create_slug($q);
        $this->db->select('*');
        $this->db->from('construction');
        $this->db->or_like('name',$q);
        $this->db->or_like('slug',$q_slug);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }


}
?>