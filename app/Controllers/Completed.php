<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\CompletedModel;

    class Completed extends Controller{

        public $completedModel;
        public function __construct(){
            helper('form');
            $this->completedModel = new CompletedModel();
        }

        public function index(){
            $data['page_title'] = 'Completed';
            $data['completed_orders'] = $this->completedModel->getAllCompletedOrders();

            return view('pages/completed_view', $data);
        }
    }
?>