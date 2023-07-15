<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Messagebird extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'MessageBird';

            $MessageBird = new \MessageBird\Client('HQWg0KniZKzySKKyBvra4nKwv
            ');
  $Message = new \MessageBird\Objects\Message();
  $Message->originator = '+639510505308';
  $Message->recipients = "+639933631916	";
  $Message->body = 'This is a test message';

  $MessageBird->messages->create($Message);
             //return view('pages/paypal_view', $data);
        }
    }
?>