<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Location extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'Location';

            return view('pages/location_view', $data);
        }
    }
?>