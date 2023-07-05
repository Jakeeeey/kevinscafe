<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Onlinesales extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'Online Sales';

            return view('pages/online_sales_view', $data);
        }
    }
?>