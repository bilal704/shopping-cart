<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Products extends CI_Controller{

    /**
     * 
     * Very first method and the default base_url method
     * to display all the products
     */
    public function index(){

        $data['products'] = $this->products_model->getAllProducts();
        $this->load->view('products', $data);
    }

    /**
     * 
     * Display a signle product with its info
     */
    public function getProduct(){
        
        $product_id =  $this->uri->segment(3);
        $data['product_info'] = $this->products_model->getProduct($product_id);
        $this->load->view('single-product', $data);      
    }

    /**
     * 
     * one time method to fetch and store all the products from fakestoreapi
     * into tbl_products
     */
    public function insertProducts(){
        exit;
        $this->products_model->insertProducts();
    }
}
?>