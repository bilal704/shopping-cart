<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Cart extends CI_Controller{

    public function index($data = []){
        
        $this->load->helper('form');
        $this->load->view('user-cart', $data);
    }

    public function addToCart(){
        
        $data = $this->input->post('data');     
        $data = (stripslashes(trim($data)));

        $data = json_decode($data, true);

        $data['name'] = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $data['name']); 

        $row_id = $this->cart->insert($data);

        $response['msg'] = 'Product Added Successfully To The Cart';
        $response['count'] = $this->cart->total_items();

        echo json_encode($response);
    }

    public function updateCart(){

        $post_data = $this->input->post();

        if(is_array($post_data) && !empty($post_data)){

            $data_to_be_updated = [];

            foreach($post_data as $cart_data){

                $data_to_be_updated[] = $cart_data;    
            }

            $this->cart->update($data_to_be_updated);

            $data['msg'] = 'Cart Updated Successfully';
        }
        else{

            $data['msg'] = 'Something Went Wrong. Cart Update Failed';
        }

        $this->index($data);
    }
}
?>