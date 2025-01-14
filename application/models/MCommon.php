<?php
class MCommon extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getTinhThanh(){
        $query=$this->db->get("tinh_thanh");
        return $query->result();
    }

    public function getQuanHuyen($id_tinh_thanh){
        $this->db->where('id_tinh_thanh', $id_tinh_thanh);
        $query = $this->db->get("quan_huyen");
        return $query->result();
    }

    public function getPhuongXa($id_quan_huyen){
        $this->db->where('id_quan_huyen', $id_quan_huyen);
        $query = $this->db->get("phuong_xa");
        return $query->result();
    }

    public function getDuong($id_quan_huyen){
        $this->db->where('id_quan_huyen', $id_quan_huyen);
        $query = $this->db->get("duong");
        return $query->result();
    }
      

    public function delete($table,$where){
        return  $this->db->where($where)->delete($table);
    }


    public function update($data,$table,$where){
        $this->db->set($data);
        $this->db->where($where);
        return  $this->db->update($table);
    }

    public function insert($data,$table){
        return $this->db->insert($table, $data);
    }

    public function getRow($table,$where ="",$order= ""){
        if($where != "")
            $this->db->where($where);
        if($order != "")
            $this->db->order_by($order);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

    public function getRow_lang($lang,$table,$where ="",$order= ""){
        $this->db->select($table.'.*,'.$table.'_lang.*');
        if($where != "")
            $this->db->where($where);
        if($order != "")
            $this->db->order_by($order);

        $this->db->where('lang',$lang);

        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->row();
        else
            return false;
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

    public function getAllRowByWhere_lang($lang,$table,$where,$limit = "",$order= "",$sort = ''){
        $this->db->select($table.'.*,'.$table.'_lang.*');
        if($where != '')
            $this->db->where($where);
        if($limit != "")
            $this->db->limit($limit);
        if($order != ""){
            if($sort != "")
                $this->db->order_by($order,$sort);
            else
                $this->db->order_by($order);
        }
        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }
    public function getAllRow($table,$limit = "",$order= "",$sort = '',$where =''){
        if($limit != "")
            $this->db->limit($limit);
        if($order != ""){
            if($sort != "")
                $this->db->order_by($order,$sort);
            else
                $this->db->order_by($order);
        }
        if($where != "")
            $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    public function getAllRow_lang($lang,$table,$limit = "",$order= "",$sort = '',$where =''){
        $this->db->select($table.'.*,'.$table.'_lang.*');

        if($limit != "")
            $this->db->limit($limit);
        if($order != ""){
            if($sort != "")
                $this->db->order_by($order,$sort);
            else
                $this->db->order_by($order);
        }
        if($where != "")
            $this->db->where($where);

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');

        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }


    public function getAllRowWithPage($table,$limit,$offset,$order= "",$where =''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        if($where != "")
            $this->db->where($where);

        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getAllRowWithPage_lang($lang,$table,$limit,$offset,$order= "",$where =''){
        $this->db->select($table.'.*,'.$table.'_lang.*');

        $this->db->from($table);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        if($where != "")
            $this->db->where($where);

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getAllRowWithPageWhereIn($table,$limit,$offset,$order= "",$where ='',$where_value=''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        if($where != "")
            $this->db->where_in($where,$where_value);

        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getAllRowWithPageWhereIn_lang($lang,$table,$limit,$offset,$order= "",$where ='',$where_value='',$where2=''){
        $this->db->select($table.'.*,'.$table.'_lang.*');

        $this->db->from($table);
        $this->db->limit($limit, $offset);
        if($order != "")
            $this->db->order_by($order);
        else
            $this->db->order_by('id','desc');

        if($where != "")
            $this->db->where_in($where,$where_value);

        if($where2 != "")
            $this->db->where($where2);

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result();
        return false;
    }

    public function getTotalRow($table, $where=''){
        $this->db->select('id');
        if($where != "")
            $this->db->where($where);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function getTotalRow_lang($lang,$table, $where=''){
        $this->db->select($table.'.*,'.$table.'_lang.*');

        if($where != "")
            $this->db->where($where);

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function getTotalRowWithWhereIn($table, $where='',$where_value='',$where2=''){
        $this->db->select('id');
        if($where != "")
            $this->db->where_in($where,$where_value);
        if($where2 != "")
            $this->db->where($where2);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function getTotalRowWithWhereIn_lang($lang,$table, $where='',$where_value=''){
        $this->db->select($table.'.*,'.$table.'_lang.*');

        if($where != "")
            $this->db->where_in($where,$where_value);

        $this->db->where('lang',$lang);
        $this->db->join($table.'_lang',$table.'.id='.$table.'_lang.record_id','left');
        $query = $this->db->get($table);
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

    public function getBrandByCat($cat_id){
        $this->db->select('product.brand_id, product.cat_id, product_brand.*');
        $this->db->where(['product.cat_id'=>$cat_id]);
        $this->db->order_by("product_brand.orders ASC");
        $this->db->group_by("product.brand_id");
        
        $this->db->join('product_brand','product_brand.id=product.brand_id','left');
        $query = $this->db->get('product');
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    public function getBrandByCats($cat_id){
        $cat_ids = $this->getCatIDs($cat_id);
        $this->db->select('product.brand_id, product.cat_id, product_brand.*');
        $this->db->where_in('product.cat_id',$cat_ids);
        $this->db->group_by("product.brand_id");
        $this->db->order_by("product_brand.orders ASC");
        
        $this->db->join('product_brand','product_brand.id=product.brand_id','left');
        
        $query = $this->db->get('product');
        
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    public function getCatIDs($parent_id,$type = 1){
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

    public function getValueByProperties($properties_id){
        $this->db->select('product_properties_id, product_properties_value');
        $this->db->where(['product_properties_id'=>$properties_id]);
        $this->db->order_by("product_properties_value ASC");
        $this->db->group_by("product_properties_value");
        $query = $this->db->get('product_properties');
        if($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }
}
?>