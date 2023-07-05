<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;

    class Logout extends Controller{

        public function index(){  
            if(session()->has('logged_user')){
                session()->remove('logged_user');
                session()->remove('logged_email');
                session()->remove('id');
                return redirect()->to(base_url().'/login');
            }elseif(session()->has('logged_admin')){
                session()->remove('logged_admin');
                session()->remove('prod_id');
                return redirect()->to(base_url().'/login');
            }
        }
    }
?>