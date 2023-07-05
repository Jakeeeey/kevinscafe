<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\HomeModel;

    class Home extends Controller{

        public $homeModel;
        public function __construct(){
            helper('form');
            $this->homeModel = new HomeModel();
        }

        public function index(){
            $data['page_title'] = 'Home';
            $data['val'] = '4';
            $data['count_menu'] = $this->homeModel->countAllMenu();
            $data['count_cart'] = $this->homeModel->countAllCart();
            if(!session()->has('logged_user')){
                return redirect()->to(base_url().'/login');
            } 

            $data['userdata'] = $this->homeModel->get_email(session()->get('logged_user'));

            if(isset($_POST['up'])){
                
                echo $this->request->getVar('test');
            }

            return view('pages/home_view', $data);
        }

        public function check_status(){
            $uid = $_GET['uid'];
            $userInfo = $this->homeModel->user_status($uid);
            return $this->response->setJSON($userInfo);
        }

    }
?>