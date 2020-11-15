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

    public function finalCheckout(){

        if(isset($_SESSION['user'])){

            $data = [];
            $arr = ['id' => $_SESSION['user']];
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where($arr);

            $query = $this->db->get();
            foreach ($query->result() as $row)
            {
                $data['name'] = $row->name;
                $data['email'] = $row->email;
                $data['address'] = $row->address;
                $data['city'] = $row->city;
                $data['phone'] = $row->phone;
                $data['pin_code'] = $row->pin_code;
            }
            
            if(!empty($data))
                $this->load->view('checkout', $data); 
        }
        else{

            header('Location: '.base_url());
        }
    }

    public function saveOrder(){

        if(isset($_SESSION['user']) && !empty($this->cart->contents())){

            $order_details = [];
            
            $order_details['email'] = $this->sanitize($this->input->post('new-user-email'));
            $order_details['name'] = $this->sanitize($this->input->post('new-user-name'));
            $order_details['address'] = $this->sanitize($this->input->post('new-user-address'));
            $order_details['city'] = $this->sanitize($this->input->post('new-user-city'));
            $order_details['pin_code'] = $this->sanitize($this->input->post('new-user-pin-code'));
            $order_details['phone'] = $this->sanitize($this->input->post('new-user-phone'));
            
            $cart_items = $this->cart->contents();
            $product_data = [];

            foreach($cart_items as $cart_item){

                $product_data[] = ['product_id' => $cart_item['id'], 'quantity' => $cart_item['qty'], 'price' => $cart_item['subtotal']];
            }

            $arr = [
                'user_id' => $_SESSION['user'],
                'product_ids' => json_encode($product_data),
                'order_total' => $this->cart->total(),
                'order_details' => json_encode($order_details),
                'created_time' => date('Y-m-d H:i:s'),
            ];
            
            if($this->db->insert('tbl_orders', $arr)){

                $this->cart->destroy();
                $data = $this->load->view('invoice', $order_details, true);
                $this->output->set_output($data); 
            }
        }
        else{

            header('Location: '.base_url());
        }
    }

    public function checkout(){

        $this->load->view('checkout');
    }

    private function sanitize($input){

        return htmlspecialchars(stripslashes(trim($input)));
    }
}
?>