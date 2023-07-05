<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;

class Cart1 extends Controller
{

    public $cartModel;
    public $client;
    public function __construct()
    {
        helper('form');
        $this->cartModel = new CartModel();
        $this->client = new \GuzzleHttp\Client();
    }

    public function index()
    {
        $data['page_title'] = 'Cart';
        if(session()->has('no_profile')){
            return redirect()->to(base_url().'/profile1');
        }
        $data['placed_order_id'] = str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()); 
        $id = session()->get('logged_user_id');
    
        $carts = $this->cartModel->getAllPending($id);
        $data['carts'] = $carts;
        if ($carts) {
            session()->set('cart_count', count($carts));
        }else{
            session()->set('cart_count', '');
        }
        $data['profile'] = $this->cartModel->getProfile($id);
        //$data['address'] = $this->cartModel->getActiveAddress($id);


        return view('pages/cart1_view', $data);
    }

    public function delete_cart()
    {
        $cart_id = $_GET['id'];
        if ($this->cartModel->delete_cart($cart_id)) {
            return redirect()->to(base_url() . '/cart1');
        }
    }

    public function placed_order(){
        $updated_carts = json_decode($_GET['updated_carts'], true);
        $placed_order = json_decode($_GET['placed_order'], true);
        

        $user_id = $placed_order['user_id'];
        //$address_id = $placed_order['address_id'];
        $placed_order_id = $placed_order['placed_order_id'];
        $order_type = $placed_order['order_type'];
        $payment_status = $placed_order['payment_status'];
        $payment_type = $placed_order['payment_type'];
        $total_amount = $placed_order['total_amount'];


        if($placed_order['payment_type'] == "otc" || $placed_order['payment_type'] == "cod"){
            for ($i = 0; $i < count($updated_carts); $i++) {
                $cart_id = $updated_carts[$i]["cart_id"];
                $placed_order_id = $updated_carts[$i]["placed_order_id"];
                $quantity = $updated_carts[$i]["quantity"];
                $sub_price = $updated_carts[$i]["sub_price"];
                $status = $updated_carts[$i]["status"];
                $cart = [
                    "placed_order_id" => $placed_order_id,
                    "quantity" => $quantity,
                    "sub_price" => strval($sub_price),
                    "status" => $status,
                ];
                $this->cartModel->updateCart($cart, $cart_id);
            }

            if($placed_order['payment_status'] == "unpaid"){

                $order = [
                    'user_id' => $user_id,
                    //'address_id' => $address_id,
                    'placed_order_id' => $placed_order_id,
                    'order_type' => $order_type,
                    'payment_status' => $payment_status,
                    'payment_type' => $payment_type,
                    'total_amount' => $total_amount
                ];

                if($this->cartModel->insertOrder($order)){
                    return redirect()->to(base_url().'/purchases');
                }
            }
        }else{
            //$paymongo = $this->source($total_amount, $address_id, $user_id);
            $paymongo = $this->source($total_amount, $user_id);
            $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            session()->set('source_id', $paymongo['data']['id']);
            session()->set('total_amount', $total_amount);
            session()->set('updated_carts', $updated_carts);
            session()->set('placed_order', $placed_order);
            return redirect()->to($checkout_url);
        }
    }

    //public function source($total_amount, $address_id, $user_id){
    public function source($total_amount, $user_id){
        require_once('vendor/autoload.php');

        //$user_address = $this->cartModel->getSelectedAddress($address_id);
        $user_info = $this->cartModel->getProfile($user_id);

        $amount = $total_amount.'00';
        $line_1 = $user_info['line_1'];
        $state = $user_info['state'];
        $postal_code = $user_info['postal_code'];
        $city = $user_info['city'];
        $name = $user_info['first_name'].' '.$user_info['last_name'];
        $phone = $user_info['mobile_num'];
        $email = $user_info['email'];
        $payment_type = "gcash";

        $response = $this->client->request('POST', 'https://api.paymongo.com/v1/sources', [
            'body' => '{"data":{"attributes":{"amount":'.$amount.',"redirect":{"success":"http://localhost/kevinscafe/cart1/payment","failed":"http://localhost/kevinscafe/paymentmethod/failed"},"billing":{"address":{"line1":"'.$line_1.'","state":"'.$state.'","postal_code":"'.$postal_code.'","city":"'.$city.'","country":"PH"},"name":"'.$name.'","phone":"'.$phone.'","email":"'.$email.'"},"type":"'.$payment_type.'","currency":"PHP"}}}',
            //'body' => '{"data":{"attributes":{"amount":'.$amount.',"redirect":{"success":"http://kevinscafe.epizy.com/cart1/payment","failed":"http://kevinscafe.epizy.com/paymentmethod/failed"},"billing":{"address":{"line1":"'.$line_1.'","state":"'.$state.'","postal_code":"'.$postal_code.'","city":"'.$city.'","country":"PH"},"name":"'.$name.'","phone":"'.$phone.'","email":"'.$email.'"},"type":"'.$payment_type.'","currency":"PHP"}}}',
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                'content-type' => 'application/json',
            ],
        ]);

        // echo "<pre>";
        // print_r(json_decode($response->getBody(), true));
        // echo "</pre>";die;
        return json_decode($response->getBody(), true);
        
    }

    // public function retrieve_source(){
    //     require_once('vendor/autoload.php');
        
    //     $source_id = session()->get('source_id');
    //     $response = $this->client->request('GET', 'https://api.paymongo.com/v1/sources/'.$source_id, [
    //         'headers' => [
    //             'accept' => 'application/json',
    //             'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
    //         ],
    //     ]);

    //     $paymongo = json_decode($response->getBody(), true);
    //     $payment_status = $paymongo['data']['attributes']['status'];

    //     if($payment_status == "chargeable"){
    //         $updated_carts = session()->get('updated_carts');
    //         $placed_order = session()->get('placed_order');

    //         for ($i = 0; $i < count($updated_carts); $i++) {
    //             $cart_id = $updated_carts[$i]["cart_id"];
    //             $placed_order_id = $updated_carts[$i]["placed_order_id"];
    //             $quantity = $updated_carts[$i]["quantity"];
    //             $sub_price = $updated_carts[$i]["sub_price"];
    //             $status = $updated_carts[$i]["status"];
    //             $cart = [
    //                 "placed_order_id" => $placed_order_id,
    //                 "quantity" => $quantity,
    //                 "sub_price" => strval($sub_price),
    //                 "status" => $status,
    //             ];
    //             $this->cartModel->updateCart($cart, $cart_id);
    //         }

    //         $user_id = $placed_order['user_id'];
    //         $address_id = $placed_order['address_id'];
    //         $placed_order_id = $placed_order['placed_order_id'];
    //         $order_type = $placed_order['order_type'];
    //         $payment_status = $payment_status;
    //         $payment_type = 'gcash';
    //         $total_amount = $placed_order['total_amount'];

    //         $order = [
    //             'user_id' => $user_id,
    //             'address_id' => $address_id,
    //             'placed_order_id' => $placed_order_id,
    //             'source_id' => $paymongo['data']['id'],
    //             'order_type' => $order_type,
    //             'payment_status' => $payment_status,
    //             'payment_type' => $payment_type,
    //             'total_amount' => $total_amount
    //         ];
            
    //         if($this->cartModel->insertOrder($order)){
    //             session()->remove('source_id');
    //             session()->remove('updated_carts');
    //             session()->remove('placed_order');
    //             return redirect()->to(base_url().'/purchases');
    //         }
    //     }
    // }

    public function payment(){
        require_once('vendor/autoload.php');
        $amount = session()->get('total_amount').'00';
        $source_id = session()->get('source_id');

        $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payments', [
            'body' => '{"data":{"attributes":{"amount":'.$amount.',"source":{"id":"'.$source_id.'","type":"source"},"currency":"PHP"}}}',
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                'content-type' => 'application/json',
            ],
        ]);
          

        $paymongo = json_decode($response->getBody(), true);
        // echo "<pre>";
        // print_r($paymongo);
        // echo "</pre>";
        
        $paymongo = json_decode($response->getBody(), true);
        $payment_status = $paymongo['data']['attributes']['status'];
        $payment_id = $paymongo['data']['id'];
        $source_id = $paymongo['data']['attributes']['source']['id'];   //baka tanggalin

        //echo $paymongo['data']['attributes']['source']['id'];
        //echo $paymongo['data']['id'];die;
        if($payment_status == "paid"){
            $updated_carts = session()->get('updated_carts');
            $placed_order = session()->get('placed_order');

            for ($i = 0; $i < count($updated_carts); $i++) {
                $cart_id = $updated_carts[$i]["cart_id"];
                $placed_order_id = $updated_carts[$i]["placed_order_id"];
                $quantity = $updated_carts[$i]["quantity"];
                $sub_price = $updated_carts[$i]["sub_price"];
                $status = $updated_carts[$i]["status"];
                $cart = [
                    "placed_order_id" => $placed_order_id,
                    "quantity" => $quantity,
                    "sub_price" => strval($sub_price),
                    "status" => $status,
                ];
                $this->cartModel->updateCart($cart, $cart_id);
            }

            $user_id = $placed_order['user_id'];
            //$address_id = $placed_order['address_id'];
            $placed_order_id = $placed_order['placed_order_id'];
            $order_type = $placed_order['order_type'];
            $payment_status = $payment_status;
            $payment_type = 'gcash';
            $total_amount = $placed_order['total_amount'];

            $order = [
                'user_id' => $user_id,
                //'address_id' => $address_id,
                'placed_order_id' => $placed_order_id,
                'source_id' => $source_id,    //baka tanggalin
                'payment_id' => $payment_id,
                'order_type' => $order_type,
                'payment_status' => $payment_status,
                'payment_type' => $payment_type,
                'total_amount' => $total_amount
            ];
            
            if($this->cartModel->insertOrder($order)){
                session()->remove('source_id');
                session()->remove('total_amount');
                session()->remove('updated_carts');
                session()->remove('placed_order');
                return redirect()->to(base_url().'/purchases');
            }
        }
    }
    
}