<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	/*public function get_all_count()
	{
	    $this->db->select('product.*, img.img_src as prod_img');
	    $this->db->from('t_product product');
	    $this->db->join('t_product_img img', 'product.prod_id=img.prod_id');
	    $this->db->where('img.is_main', 1);
		return $this->db->count_all_results();
	}
    public function get_products($limit, $offset)
    {
        $this->db->select('product.*, img.img_src as prod_img');
        $this->db->from('t_product product');
        $this->db->join('t_product_img img', 'product.prod_id=img.prod_id');
        $this->db->where('img.is_main', 1);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }*/

    public function get_all_count($search)
    {
        $sql = "select product.*, img.img_src as prod_img from t_product product, t_product_img img where product.prod_id=img.prod_id and img.is_main=1";
        if(isset($search['cate_id'])){
            $sql = "SELECT prod.*,img.img_src as prod_img FROM (SELECT * FROM t_product WHERE cate_id IN
                (SELECT cate_id
                FROM t_category WHERE p_id=1
                UNION
                SELECT cate_id
                FROM t_category WHERE p_id IN(SELECT cate_id FROM t_category WHERE p_id=".$search['cate_id']."))) prod, t_product_img img
                WHERE prod.prod_id=img.prod_id AND img.is_main=1";
        }else if(isset($search['tag_id'])){
            $sql = "select prod.*, img.img_src as prod_img from t_product prod, t_product_img img 
                    where prod.prod_id=img.prod_id and img.is_main=1 
                    and  prod.prod_id in (select prod_id from t_product_tag pt where pt.tag_id=".$search['tag_id'].")";
        }

        return $this->db->query($sql)->num_rows();
    }
    public function get_products($limit, $offset, $search)
    {

        $sql = "select product.*, img.img_src as prod_img from t_product product, t_product_img img where product.prod_id=img.prod_id and img.is_main=1 limit $offset, $limit";

        if(isset($search['cate_id'])){
            $sql = "SELECT prod.*,img.img_src as prod_img FROM (SELECT * FROM t_product WHERE cate_id IN
                (SELECT cate_id
                FROM t_category WHERE p_id=1
                UNION
                SELECT cate_id
                FROM t_category WHERE p_id IN(SELECT cate_id FROM t_category WHERE p_id=1))) prod, t_product_img img
                WHERE prod.prod_id=img.prod_id AND img.is_main=1 LIMIT $offset, $limit";
        }else if(isset($search['tag_id'])){
            $sql = "select prod.*, img.img_src as prod_img from t_product prod, t_product_img img 
                    where prod.prod_id=img.prod_id and img.is_main=1 
                    and  prod.prod_id in (select prod_id from t_product_tag pt where pt.tag_id=".$search['tag_id'].") LIMIT $offset, $limit";
        }
        return  $this->db->query($sql)->result();
    }
}
