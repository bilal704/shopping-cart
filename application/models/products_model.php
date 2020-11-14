<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Products_model extends CI_Model{

    public function getAllProducts(){

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
        return $result_arr;
    }

    public function getProduct($product_id = ''){

        $result_arr = [];

        if($product_id != ''){

            //  Initiate curl
            $ch = curl_init();
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL, 'https://fakestoreapi.com/products/'.$product_id);
            // Execute
            $result = curl_exec($ch);
            // Closing
            curl_close($ch);

            $result_arr = json_decode($result, true);
        }
        
        return $result_arr;
    }
}
?>