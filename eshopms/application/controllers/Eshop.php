<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eshop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('eshop_model');
    }
    public function index()
    {
        $this->load->view('eshop_mgr');
    }
    public function eshop_mgr()
    {
        //$this->load->view('user_mgr');
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度

        $search = htmlspecialchars($this->input->get('search[value]'));//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        $order_col = array('1' => 'prod_id', '2' => 'prod_name', '3' => 'prod_price', '4' => 'description');

        $recordsTotal = $this->eshop_model->get_total_count();
        $recordsFiltered = $this->eshop_model->get_filterd_count($search);

        $datas = $this->eshop_model->get_paginated_eshop($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->prod_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);



    }

    public function eshop_detail()
    {
        $eshop_id = $this->input->get('eshopId');
        $eshop = $this->eshop_model->get_eshop_by_id($eshop_id, array('inc_orders'=>FALSE, 'inc_comments'=>FALSE));
        if ($eshop) {
            echo json_encode($eshop);
        } else {
            echo json_encode(array('err' => '未找到指定房源信息!'));
        }
    }
    public function edit_product(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $description = $this->input->post('description');
        $row = $this->eshop_model->edit_product($id,$name,$price,$description);
        if($row>0){
            echo 'success';
        }
    }

    public function add_product(){

        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $description = $this->input->post('description');
        $upload_imgs = $this->input->post('upload_img');

        $id = $this -> eshop_model -> save_product(array(
            "prod_name" => $name,
            "prod_price" => $price,
            "description" => $description,
        ));


        if($id){
            //添加照片
            $Arr = [];
            if(isset($upload_imgs)){
                for ($i=0; $i<count($upload_imgs); $i++){
                    $upload_img = $upload_imgs[$i];
                    $Arr[] = array('is_main'=>$i==0?1:0,'thumb_img_src'=>$upload_img,'img_src'=>$upload_img,'prod_id'=>$id);
                }
                $this -> eshop_model -> save_img($Arr);
            }
            redirect('eshop');
        }



    }


    public function img_upload()
    {
        $typeArr = array("jpg", "png", "ico");
        //允许上传文件格式
        $path = "uploads/";//
        //上传路径

        //if (!file_exists($path)) {
        //  mkdir($path);
        //}
        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                echo json_encode(array("error" => "您还未选择图片"));
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1));
            //获取文件类型

            if (!in_array($type, $typeArr)) {
                echo json_encode(array("error" => "请上传jpg,png,ico类型的图片！"));
                exit;
            }
            if ($size > (500 * 1024)) {
                echo json_encode(array("error" => "图片大小已超过500KB！"));
                exit;
            }
            $pic_name = time() . rand(10000, 99999) . "." . $type;
            //图片名称
            $pic_url = $path . $pic_name;

            //上传后图片路径+名称
            if (move_uploaded_file($name_tmp, $pic_url)) {//临时文件转移到目标文件夹
                echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name));

            } else {
                echo json_encode(array("error" => "上传有误，请稍后重试！"));
            }
        }
    }

}
