<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Onlinecustomers extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'Online Customers';

            return view('pages/online_customers_view', $data);
        }
    }
?>