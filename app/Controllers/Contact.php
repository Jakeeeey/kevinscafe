<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Contact extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'Contact Us';

            return view('pages/contact_view', $data);
        }
    }
?>