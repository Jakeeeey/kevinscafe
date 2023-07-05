<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RegisterModel;

class Register extends Controller
{

    public $registerModel;
    public $session;
    public $email;
    public function __construct()
    {
        helper('form');
        helper('date');
        $this->registerModel = new RegisterModel();
        $this->session = session();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Register';

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email])',
                    'errors' => [
                        'required' => '{field} field is required',
                        'valid_email' => '{field} should be valid',
                        'is_unique' => '{field} is already used'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|max_length[20]',
                    'errors' => [
                        'required' => '{field} field is required',
                        'min_length' => '{field} should be more than 8 characters',
                        'max_length' => '{field} should be less than 20 characters',
                    ]
                ],
                'confirm_password' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} field is required',
                        'matches' => 'The password you entered does not match'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $uid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                $userdata = [
                    'uid' => $uid,
                    'email' => $this->request->getVar('email'),
                    'password' => md5($this->request->getVar('password'))

                ];


                if ($this->registerModel->createUser($userdata)) {
                    $to = $this->request->getVar('email');
                    $subject = "Account Activation Link - Kevin's Cafe";
                    $message = 'Hi ' . $this->request->getVar('email') . ',<br><br>Thanks, your account'
                        . ' has been created successfully. Please click the link below to activate your account.<br><br>'
                        . "<a href='" . base_url() . "/register/activate/" . $uid . "' target='blank'>Activate Now<a><br><br>Thanks<br>Admin";

                    $this->email->setTo($to);
                    $this->email->setFrom('jakedavedeguzman123@gmail.com', 'Info');
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);

                    if ($this->email->send()) {
                        $this->session->setTempdata('success', 'Account created successfully, please activate your account', 3);
                        return redirect()->to(current_url());
                    } else {
                        $this->session->setTempdata('error', 'Account created successfully. Sorry! unable to send activation link. Contact Admin', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    $this->session->setTempdata('error', 'Sorry undable to create an account, please try again', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('pages/register_view', $data);
    }


    public function activate($uid = null)
    {

        $data = [];
        $data['page_title'] = 'Activation';

        if (!empty($uid)) {
            $userdata = $this->registerModel->verifyUid($uid);
            if ($userdata) {
                if ($this->verifyExpiryTime($userdata->created_at)) {
                    if ($userdata->status == 'inactive') {
                        $status = $this->registerModel->updateStatus($uid);
                        if ($status == true) {
                            $activated_at = [
                                'activated_at' => date('Y-m-d H:i:s', strtotime('now'))
                            ];
                            $this->registerModel->updateActivatedAt($activated_at, $uid);
                            echo '<div class="mt-5 p-5">
                                <h1>Account activated successfully</h1>
                                  </div>';
                            echo header("Refresh: 2; url=http://localhost/kevinscafe/login");
                        }
                    } else {
                        echo '<div class="mt-5 p-5">
                                    <h1>Your account is already activated</h1>
                                  </div>';
                        echo header("Refresh: 6; url=http://localhost/kevinscafe/login");
                    }
                } else {
                    echo '<h1>Sorry activation link was expired</h1>';
                    echo header("Refresh: 6; url=http://localhost/kevinscafe/login");
                }
            }
        } else {
            echo '<h1>Sorry! unable to process your request</h1>';
            echo header("Refresh: 6; url=http://localhost/kevinscafe/login");
        }

        #return view('pages/activate_view', $data);
    }


    public function verifyExpiryTime($time)
    {

        $curr_time = date('Y-m-d h:i:s', strtotime('now'));
        $activated_at = date('Y-m-d h:i:s', strtotime($time));
        $diff_time = strtotime($curr_time) - strtotime($activated_at);

        if ($diff_time < 3600) {
            return true;
        } else {
            return false;
        }
    }
}
