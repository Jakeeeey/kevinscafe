<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Order extends Controller{
    

        public function index(){           
            $data['page_title'] = 'Order';

            if(!session()->has('logged_user')){
                return redirect()->to(base_url().'/login');
            }

            return view('pages/order_view', $data);
        }
    }
?>