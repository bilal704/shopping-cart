<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class User extends CI_Controller{

    public function register(){

        $email = $this->sanitize($this->input->post('new-user-email'));
        $password = $this->sanitize($this->input->post('new-user-password'));
        $confirm_password = $this->sanitize($this->input->post('new-user-confirm-password'));
        $name = $this->sanitize($this->input->post('new-user-name'));
        $address = $this->sanitize($this->input->post('new-user-address'));
        $city = $this->sanitize($this->input->post('new-user-city'));
        $pin_code = $this->sanitize($this->input->post('new-user-pin-code'));
        $phone = $this->sanitize($this->input->post('new-user-phone'));

        $has_error = 0;

        if($email != '' && $password != '' && $confirm_password != '' && $name != '' && $address != '' && $city != '' && $pin_code != ''){

            if($password != $confirm_password){

                $response['msg'] = "Password and Confirm Password Fields Do Not Match";
                $has_error = 1;
            }

            if(!is_numeric($pin_code)){

                $response['msg'] = "Pin Code Must be numeric";
                $has_error = 1;
            }

            if(!is_numeric($phone)){

                $response['msg'] = "Phone Must be numeric";
                $has_error = 1;
            }
        }
        else{

            $response['msg'] = "All fields are required";
            $has_error = 1;
        }

        if(!$has_error){

            $this->db->select('id');
            $this->db->from('tbl_users');
            $this->db->where('email =', $email);
            $this->db->or_where('phone =', $phone);

            $query = $this->db->get();

            if($query->result()){

                $response['msg'] = "User with same email or phone is already registered";
            }
            else{
                $data = [

                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'city' => $city,
                    'pin_code' => $pin_code,
                    'phone' => $phone,
                    'password' => md5($password),
                    'created_time' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('tbl_users', $data);

                $response['msg'] = "Registration Successfull, Please Login And Checkout";
            }
        }

        echo json_encode($response);exit;
    }

    public function login(){

        $this->load->view('login');
    }

    public function logout(){

        $this->cart->destroy();
        session_destroy();
        header('Location: '. base_url());
    }

    public function checklogin(){
        
        $email = $this->sanitize($this->input->post('login-email'));
        $password = $this->sanitize($this->input->post('login-password'));

        $data = [
            'email' => $email,
            'password' => md5($password)
        ];
        
        $this->db->select('id');
        $this->db->from('tbl_users');
        $this->db->where($data);
        
        $query = $this->db->get();

        if($query->result()){
           
            $_SESSION['user'] = $query->result()[0]->id;

            header('Location: '.base_url().'cart/finalCheckout');
        }
        else{

           $data['msg'] = 'Invalid Email or Password';
           $this->load->view('login', $data);
        }
    }

    private function sanitize($input){

        return htmlspecialchars(stripslashes(trim($input)));
    }
}
?>