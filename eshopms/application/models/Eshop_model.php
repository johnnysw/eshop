<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eshop_model extends CI_Model {
    //获取小区分类和和每个小区的房源数量
    public function get_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_product');
//        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_product";
        if (strlen($search) > 0) {
            $sql .= " where 1=1 and (prod_name LIKE '%" . $search . "%' or prod_price LIKE '%" . $search . "%' or description LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_eshop($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_product";
        if (strlen($search) > 0) {
            $sql .= " where 1 = 1 and (prod_name LIKE '%" . $search . "%' or prod_price LIKE '%" . $search . "%' or description LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY $order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }
    public function get_eshop_by_id($eshop_id, $options = array('inc_orders' => FALSE, 'inc_comments' => FALSE))
    {
        return $this->db->get_where('t_product',array('prod_id'=>$eshop_id))->row();

    }
    public function edit_product($id,$name,$price,$des){
        $this->db->where('prod_id', $id);
        $this->db->update('t_product', array('prod_name' => $name,'prod_price'=>$price,'description'=>$des));
        return $this->db->affected_rows();
    }
    public function save_product($data){
        $this -> db -> insert('t_product',$data);
        return $this -> db -> insert_id();
    }
    public function save_img($data){
        //        foreach ($datas as $data){
//            $this -> db -> insert('t_house_img',$data);
//        }
        $this -> db -> insert_batch('t_product_img',$data);
        return $this -> db -> affected_rows();
    }

}
?>