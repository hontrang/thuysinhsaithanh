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
class MProduct extends CI_Model{
    public function __construct(){
        parent::__construct();
		
    }

    public function getAllRowWithPage($parent_id,$limit,$offset,$order= ""){
        $this->db->select('*');
        $this->db->from('product_cat');
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
        $query = $this->db->get('product_cat');
        return $query->num_rows();
	
    }
	
	public function getAllRowByWhere($table,$where='',$limit = "",$order= "",$sort = ''){
		
        if($where != "")
            $this->db->where($where);
		
        if($limit != "")
            $this->db->limit($limit);
        if($order != ""){
            if($sort != "")
                $this->db->order_by($order,$sort);
            else
                $this->db->order_by($order);
        }

        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }
	
	
	public function getCatIDs($parent_id,$type = 1){
		return true;
        $list = $this->getAllRowByWhere('product_cat',['parent_id'=>$parent_id]);
		
        $ids = [];
        if($type == 1)
            $ids[] = $parent_id;
		
        if($list)foreach($list as $item){
            $ids[] = $item->id;
			
			//cap 3
			$list2 = $this->getAllRowByWhere('product_cat',['parent_id'=>$item->id]);
			if($list2)foreach($list2 as $item2){
				$ids[] = $item2->id;
				//cap 4
				$list3 = $this->getAllRowByWhere('product_cat',['parent_id'=>$item2->id]);
				if($list3)foreach($list3 as $item3){
					$ids[] = $item3->id;
				}
			}
        }
        return $ids;

    }

    public function getAllRowWithPageSearch($lang,$name='',$cat_id='',$brand_id='',$code='',$hot='',$new='',$limit,$offset,$order=''){
		$this->db->select('product.*,'.'product_lang.*');

        $this->db->from('product');
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        $this->db->where('lang',$lang);
        $this->db->join('product_lang','product.id='.'product_lang.record_id','left');
		
		if($name != "")
            $this->db->like('product_lang.name',$name);
		
		if($cat_id != ""){
			$this->db->where_in('cat_id',$cat_id);
		}
            
		
		if($brand_id != "")
            $this->db->where('brand_id',$brand_id);

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


    public function getTotalRowSearch($lang,$name='',$cat_id='',$brand_id='',$code='',$hot='',$new=''){
		$this->db->select('product.*,product_lang.*');

        $this->db->where('lang',$lang);
        $this->db->join('product_lang','product.id=product_lang.record_id','left');
		
		if($name != "")
            $this->db->like('product_lang.name',$name);
		
		if($cat_id != "")
            $this->db->where_in('cat_id',$cat_id);
		
		if($brand_id != "")
            $this->db->where('brand_id',$brand_id);

        if($code != "")
            $this->db->where('code',$code);

        if($hot != "")
            $this->db->where('is_hot',$hot);

        if($new != "")
            $this->db->where('is_new',$new);
		
        $query = $this->db->get('product');
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


    public function getRelated($product_id){
        $this->db->select('product_related.*,product.name,product.id,product.slug,product.image');
        $this->db->from('product_related');
        $this->db->where('product_id',$product_id);
        $this->db->join('product','product.id = product_related.related_id','left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function searchProduct($q){
        $this->db->select('product.*,product_lang.*');
        $this->db->where('lang','vi');
        $this->db->join('product_lang','product.id=product_lang.record_id','left');
        $this->db->like('product_lang.name',$q);
		$this->db->limit(50);
        $query = $this->db->get('product');
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }
	
	public function getTotalFilterProduct($lang,$cats_id = '',$offset,$limit,$brand = '', $sort='',$filters ='',$is_hot=''){
		if($filters == ""){
            $this->db->select('product.*,'.'product_lang.*');
            $this->db->from('product');
            $this->db->join('product_lang','product.id='.'product_lang.record_id','left');
        }
		else{
			$this->db->select('COUNT(product_properties.product_id) as count, product_properties.sub_id,product_properties.product_id, product_properties.product_properties_value, product_properties.product_properties_id, product.*, product_lang.*');
			$this->db->from('product_properties');
			$this->db->join('product','product_properties.product_id='.'product.id','left');
			$this->db->join('product_lang','product.id='.'product_lang.record_id','left');
			$this->db->group_by("product_properties.product_id");
			$this->db->where_in('product_properties.sub_id',$filters);
			
			
		}
		

        //$this->db->limit($limit, $offset);
        $this->db->where('product.hide',0);

        if($cats_id != "")
            $this->db->where_in('product.cat_id',$cats_id);
		
		if($is_hot != "")
            $this->db->where_in('product.is_hot',$is_hot);

        if($sort != ""){
            $temp = explode("-",$sort);
            $this->db->order_by($temp[0],$temp[1]);
        }
        else
            $this->db->order_by('product.orders','desc');

        $this->db->where('product_lang.lang',$lang);
        
		
		if($brand != ""){
			$this->db->where_in('product.brand_id',$brand);
		}
            

		
        $query = $this->db->get();
		return $query->num_rows();
	}

    public function getFilterProduct($lang,$cats_id = '',$offset,$limit,$brand = '', $sort='',$filters ='',$is_hot=''){
        if($filters == ""){
            $this->db->select('product.*,'.'product_lang.*');
            $this->db->from('product');
            $this->db->join('product_lang','product.id='.'product_lang.record_id','left');
        }
		else{
			$this->db->select('COUNT(product_properties.product_id) as count, product_properties.sub_id,product_properties.product_id, product_properties.product_properties_value, product_properties.product_properties_id, product.*, product_lang.*');
			$this->db->from('product_properties');
			$this->db->join('product','product_properties.product_id='.'product.id','left');
			$this->db->join('product_lang','product.id='.'product_lang.record_id','left');
			$this->db->group_by("product_properties.product_id");
			$this->db->where_in('product_properties.sub_id',$filters);
			
			
		}
		

        $this->db->limit($limit, $offset);
        $this->db->where('product.hide',0);

        if($cats_id != "")
            $this->db->where_in('product.cat_id',$cats_id);
		
		if($is_hot != "")
            $this->db->where_in('product.is_hot',$is_hot);

        if($sort != ""){
            $temp = explode("-",$sort);
            $this->db->order_by($temp[0],$temp[1]);
        }
        else
            $this->db->order_by('product.orders','DESC');

        $this->db->where('product_lang.lang',$lang);
        
		
		if($brand != ""){
			$this->db->where_in('product.brand_id',$brand);
		}
            

		
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

}
?>