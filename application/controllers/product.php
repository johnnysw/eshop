<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {


	public function index()
	{
	}

    public function get_products()
    {
        $page = $this->input->get('page');
        $cateId = $this->input->get('cateId');
        $tagId = $this->input->get('tagId');

        $page = $this->input->get('page');
        $per_page = 3;
        $this->load->model('product_model');
        $search = array();

        if($cateId && $cateId != 0){
            $search['cate_id'] = $cateId;
        }else if($tagId){
            $search['tag_id'] = $tagId;
        }
        $total_records = $this->product_model->get_all_count($search);
        $total_page = ceil($total_records / $per_page);
        $products = $this->product_model->get_products($per_page, ($page-1)*$per_page, $search);



        if($page == $total_page){
            $data = array(
                'products' => $products,
                'isEnd' => true //标识数据是否已经到最后，true表示到最后
            );
        }else{
            $data = array(
                'products' => $products,
                'isEnd' => false
            );
        }
        echo json_encode($data);

    }
}
