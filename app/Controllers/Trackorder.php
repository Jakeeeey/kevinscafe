<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\TrackorderModel;

    class Trackorder extends Controller{

        public $trackorderModel;
        public function __construct(){
            helper('form');
            $this->trackorderModel = new TrackorderModel();
        }

        public function index(){
            $data['validation']= null;
            $data['page_title'] = 'Track Order';

            if(!session()->has('logged_user')){
                return redirect()->to(base_url().'/login');
            }
            //$data['orders'] = $this->trackorderModel->getAllOrders();
            $data['orders'] = $this->trackorderModel->getAllOrders();
            
            return view('pages/track_order_view', $data);
        }

    }
?>