<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Products_model extends CI_Model{

    public function getAllProducts(){

        $query = $this->db->get('tbl_products');
        $result_arr = json_decode(json_encode($query->result()), true);
        return $result_arr;
    }

    public function getProduct($product_id = ''){

        $result_arr = [];

        if($product_id != ''){

            $query = $this->db->get_where('tbl_products', array('id' => $product_id));
            $result_arr = json_decode(json_encode($query->result()), true);
        }
        
        return $result_arr;
    }

    public function insertProducts(){

        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, 'https://fakestoreapi.com/products');
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        $result_arr = json_decode($result, true);

        foreach($result_arr as $result)
            $this->db->insert('tbl_products',$result);
    }
}
?>