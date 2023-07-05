<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;

    class Faqs extends Controller{

        public function __construct(){
            //helper('form');
        }

        public function index(){
            $data['page_title'] = 'FAQs';
            
            return view('pages/faqs_view', $data);
        }  

    }
