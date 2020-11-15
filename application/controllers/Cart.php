<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Cart extends CI_Controller{

    /**
     * 
     * Method to display the cart items.
     * Have used codeigniter's native cart class and its method
     */
    public function index($data = []){
        
        $this->load->helper('form');
        $this->load->view('user-cart', $data);
    }

    /**
     * 
     * Method to add a product to the cart
     */
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

     /**
     * 
     * Method to update the cart items.
     */
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

     /**
     * 
     * Method to update a prefilled form for registered user.
     */
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

    /**
     * 
     * Method to save the order in the tbl_orders table.
     * It is used for both guest user and logeed in user.
     * 
     * For guest user 'guest_user' field will be updated as 1 and user_id
     * will be saved as 0.
     * 
     * For logged in user user_id will be store the user id and
     * guest_user field will contain 0
     */

    public function saveOrder(){

        if(!empty($this->cart->contents())){

            $order_details = [];
            $user_id = $guest_user_id = 0;
            
            if(isset($_SESSION['user'])){

                $order_details['email'] = $this->sanitize($this->input->post('new-user-email'));
                $order_details['name'] = $this->sanitize($this->input->post('new-user-name'));
                $order_details['address'] = $this->sanitize($this->input->post('new-user-address'));
                $order_details['city'] = $this->sanitize($this->input->post('new-user-city'));
                $order_details['pin_code'] = $this->sanitize($this->input->post('new-user-pin-code'));
                $order_details['phone'] = $this->sanitize($this->input->post('new-user-phone'));
                $user_id = $_SESSION['user'];
            }
            else{

                $order_details['email'] = $this->sanitize($this->input->post('guest-user-email'));
                $order_details['name'] = $this->sanitize($this->input->post('guest-user-name'));
                $order_details['address'] = $this->sanitize($this->input->post('guest-user-address'));
                $order_details['city'] = $this->sanitize($this->input->post('guest-user-city'));
                $order_details['pin_code'] = $this->sanitize($this->input->post('guest-user-pin-code'));
                $order_details['phone'] = $this->sanitize($this->input->post('guest-user-phone'));
                $guest_user_id = 1;
            }
            
            $cart_items = $this->cart->contents();
            $product_data = [];

            foreach($cart_items as $cart_item){

                $product_data[] = ['product_id' => $cart_item['id'], 'quantity' => $cart_item['qty'], 'price' => $cart_item['subtotal']];
            }

            $arr = [
                'user_id' => $user_id,
                'guest_user' => $guest_user_id,
                'product_ids' => json_encode($product_data),
                'order_total' => $this->cart->total(),
                'order_details' => json_encode($order_details),
                'created_time' => date('Y-m-d H:i:s'),
            ];
            
            if($this->db->insert('tbl_orders', $arr)){
                
                $data = $this->load->view('invoice', $order_details, true);
                $this->cart->destroy();
                $this->output->set_output($data); 
            }
        }
        else{

            header('Location: '.base_url());
        }
    }

    /**
     * 
     * function to load the checkout view
     */
    public function checkout(){

        $this->load->view('checkout');
    }

    private function sanitize($input){

        return htmlspecialchars(stripslashes(trim($input)));
    }
}
?>