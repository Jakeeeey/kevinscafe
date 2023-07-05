<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\DashboardModel;

    class Dashboard extends Controller{

        public $dashboardModel;
        public function __construct(){
            helper('form');
            $this->dashboardModel = new DashboardModel();
        }

        public function index(){
            $data['page_title'] = 'Dashboard';

            if(!session()->has('logged_admin')){
                return redirect()->to(base_url().'/login');
            }

            $uid = session()->get('logged_admin');
            $data['userdata'] = $this->dashboardModel->getLoggedUserData($uid);
            $data['menu_count'] = $this->dashboardModel->countAllMenu();
            $data['category_count'] = $this->dashboardModel->countAllcategory();
            $data['sales_count'] = $this->dashboardModel->countAllSales();
            //$data['online_sales_count'] = $this->dashboardModel->countAllOnlineSales();

            return view('pages/dashboard_view', $data);
        }


        public function settings(){
            $data['validation'] = null;
            $data['page_title'] = 'Settings';
            $userdata = $this->dashboardModel->getLoggedUserData(session()->get('logged_admin'));

            if($this->request->getMethod() == 'post'){
                $rules = [
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} field is required',
                        ]
                    ],
                    'new_password' => [
                        'label' => 'New Password',
                        'rules' => 'required|min_length[8]|max_length[20]',
                        'errors' => [
                            'required' => '{field} field is required',
                            'min_length' => '{field} should be more than 8 characters',
                            'max_length' => '{field} should be less than 20 characters',
                        ]
                    ],
                    'confirm_new_password' => [
                        'label' => 'Confirm New Password',
                        'rules' => 'required|matches[new_password]',
                        'errors' => [
                            'required' => '{field} field is required',
                            'matches' => '{field} does not match the new password you entered'
                        ]
                    ]
                ];

                if($this->validate($rules)){
                    $password = md5($this->request->getVar('password'));
                    $new_password = md5($this->request->getVar('new_password'));
                    if($password == $userdata['password']){
                        if($this->dashboardModel->updatePassword($new_password, session()->get('logged_admin'))){
                            session()->setTempdata('success', 'Password updated successfully', 3);
                            return redirect()->to(base_url().'/logout');
                        }else{
                            session()->setTempdata('error', 'Sorry, unable to update password', 3);
                            return redirect()->to(current_url());
                        }
                    }else{
                        session()->setTempdata('error', 'Sorry, the password you entered is wrong!', 3);
                        return redirect()->to(current_url());
                    }
                }else{
                    $data['validation'] = $this->validator;
                }
            }
            
            return view('pages/settings_view', $data);
        }

    }
