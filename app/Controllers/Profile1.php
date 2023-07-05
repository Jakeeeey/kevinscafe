<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProfileModel;

class Profile1 extends Controller
{

    public $profileModel;
    public function __construct()
    {
        helper('form');
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        //$data['validation']= null;
        $data['page_title'] = 'Profile';
        $user_info = $this->profileModel->getUserInfo(session()->get('logged_user_id'));
        $data['user_info'] = $user_info;
        //print_r($user_info);die;
        if (
            $user_info['first_name'] == null && $user_info['last_name'] == null && $user_info['mobile_num'] == null &&
            $user_info['line_1'] == null
        ) {
            session()->set('no_profile', '');
            //return redirect()->to(current_url());
        } else {
            session()->remove('no_profile');
            //session()->destroy('no_profile');
            //return redirect()->to(current_url());
        }
        //$user_info = $this->profileModel->getUserInfo(session()->get('logged_user_id'));

        if (isset($_POST['edit-profile'])) {
            $first_name = $this->request->getVar('first-name');
            $last_name = $this->request->getVar('last-name');
            $mobile_number = $this->request->getVar('mobile-number');
            $line_1 = $this->request->getVar('line-1');
            $line_2 = $this->request->getVar('line-2');

            $update_info = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'mobile_num' => $mobile_number,
                'line_1' => $line_1,
                'line_2' => $line_2,
            ];

            if ($this->profileModel->updateInfo(session()->get('logged_user_id'), $update_info)) {
                session()->setTempdata('success', 'Information updated successfully', 3);
                return redirect()->to(current_url());
            }
        }

        //$data['user_address'] = $this->profileModel->get_all_address(session()->get('logged_user_id'));

        //echo $user_info['uid'];die;
        //print_r($user_info);die;
        // if(!session()->has('logged_user')){
        //     return redirect()->to(base_url().'/login');
        // }

        return view('pages/profile1_view', $data);
    }
}
