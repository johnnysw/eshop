<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {


	public function index()
	{
	}

    public function get_products()
    {
        $page = $this->input->get('page');
        $per_page = 3;
        $this->load->model('product_model');
        $total_records = $this->product_model->get_all_count();
        $total_page = ceil($total_records / $per_page);
        $products = $this->product_model->get_products($per_page, ($page-1)*$per_page);

        if($page == $total_page){
            $data = array(
                'products' => $products,
                'isEnd' => true
            );
            echo json_encode($data);
        }else{
            $data = array(
                'products' => $products,
                'isEnd' => false
            );
            echo json_encode($data);
        }
    }
}
