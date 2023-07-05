<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Userinfo extends Controller{
    
        public $session;
        public function __construct(){
            helper('form');
            $this->session = session();
              
        }

        protected function index(){           
            $data['page_title'] = 'Personal Information';

            return view('pages/userinfo_view', $data);
        }
    }
?>