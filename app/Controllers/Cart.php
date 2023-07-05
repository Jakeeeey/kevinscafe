<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;
use PHPUnit\Util\Json;

class Cart extends Controller
{

    public $cartModel;
    public function __construct()
    {
        helper('form');
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        $data['page_title'] = 'Cart';
        $data['cart_number'] = str_shuffle('abcdefghijklmnopqrstuvwxyz' . time());
        $id = session()->get('logged_user_id');
        $carts = $this->cartModel->getAllPending($id);
        $data['carts'] = $carts;
        if ($carts) {
            session()->set('cart_count', count($carts));
        }else{
            session()->set('cart_count', '');
        }
        $data['profile'] = $this->cartModel->getProfile($id);
        $data['address'] = $this->cartModel->getActiveAddress($id);

        return view('pages/cart_view', $data);
    }

    public function delete_cart()
    {
        $cart_id = $_GET['id'];
        if ($this->cartModel->delete_cart($cart_id)) {
            return redirect()->to(base_url() . '/cart');
        }
    }

    /*public function updateCart()
    {
        $carts = json_decode($_GET['carts'], true);
        $order_details = json_decode($_POST['pickupCOP'], true);

        for ($i = 0; $i < count($carts); $i++) {
            $cart_id = $carts[$i]["cart_id"];
            $check_out_id = $carts[$i]["check_out_id"];
            $quantity = $carts[$i]["quantity"];
            $sub_price = $carts[$i]["sub_price"];
            $status = $carts[$i]["status"];
            $cart = [
                //"cart_id" => $cart_id,
                "check_out_id" => $check_out_id,
                "quantity" => $quantity,
                "sub_price" => strval($sub_price),
                "status" => $status,
            ];
            $this->cartModel->updateCart($cart, $cart_id);
        }
        //print_r($order_details);die;
        if($this->insertOrder($order_details)){
            return redirect()->to(base_url().'/trackorder');
        }
    }*/

    /*private function insertOrder($order_details){
        $order = [
            "user_id" => $order_details['user_id'],
            "address_id" => $order_details['address_id'],
            "check_out_id" => $order_details['check_out_id'],
            "amount" => $order_details['amount'],
            "payment_status" => $order_details['payment_status'],
            "payment_type" => $order_details['payment_type'],
            "order_type" => $order_details['order_type'],
        ];
        if ($this->cartModel->insertOrder($order)) {
            return true;
        }
    }*/

    public function updateCart(){
        $carts = json_decode($_POST['updatedCart'], true);
        //echo '<pre>';
        //print_r($carts);
        for($i = 0; $i < count($carts); $i++){
            $cart_id = $carts[$i]['cart_id'];
            $check_out_id = $carts[$i]['check_out_id']; 
            $quantity = $carts[$i]['quantity']; 
            $sub_price = $carts[$i]['sub_price']; 
            $status = $carts[$i]['status'];
            $cart = [
                'check_out_id' => $check_out_id,
                'quantity' => $quantity,
                'sub_price' => $sub_price,
                'status' => $status,
            ];
            $this->cartModel->updateCart($cart, $cart_id);
            //echo '<pre>';
            //print_r($cart);
        }
    }
}
