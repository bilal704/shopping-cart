<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Products extends CI_Controller{

    public function index(){

        $data['products'] = $this->products_model->getAllProducts();
        $this->load->view('products', $data);
    }

    public function getProduct(){
        
        $product_id =  $this->uri->segment(3);
        $data['product_info'] = $this->products_model->getProduct($product_id);
        $this->load->view('single-product', $data);      
    }

    public function insertProducts(){
        exit;
        $this->products_model->insertProducts();
    }
}
?>