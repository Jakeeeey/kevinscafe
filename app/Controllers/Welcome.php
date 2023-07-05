<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\CartModel;

    class Welcome extends Controller{

        #public $cartModel;
        public function __construct(){
            helper('form');
            #$this->cartModel = new CartModel();
        }

        public function index(){
            $data['page_title'] = 'Welcome';

            return view('pages/welcome_view', $data);
        }
    }
?>