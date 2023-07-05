<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;
#use App\Models\AutoModel;

class Login extends Controller
{

    public $loginModel;
    public $session;
    #public $userModel;
    public function __construct()
    {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();
        #$this->userModel = new AutoModel();
    }

    public function index()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Login';

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} is required',
                        'valid_email' => '{field} must be valid'
                    ]
                ],

                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ]
            ];
            if ($this->validate($rules)) {

                $email = $this->request->getVar('email');
                $password = md5($this->request->getVar('password'));

                $userdata = $this->loginModel->verifyEmail($email);
                if ($userdata) {
                    if ($password == $userdata['password']) {
                        if ($userdata['status'] == 'active') {
                            if ($userdata['user_type'] == 'user') {
                                $cart_count = $this->loginModel->countAllCart($userdata['id']);
                                $this->session->set('logged_user', $userdata['uid']);
                                $this->session->set('logged_user_id', $userdata['id']);
                                $this->session->set('logged_user_name', $userdata['first_name'] .' '. $userdata['last_name']);
                                $this->session->set('cart_count', $cart_count);
                                $this->session->set('logged_email', $email);
                                if($userdata['first_name'] == "" || $userdata['last_name'] == "" || $userdata['mobile_num'] == "" || $userdata['line_1'] == ""){
                                    return redirect()->to(base_url() . '/profile1');
                                }else{
                                    return redirect()->to(base_url() . '/menu');
                                }
                            } elseif ($userdata['user_type'] == 'admin') {
                                $this->session->set('logged_admin', $userdata['uid']);
                                $this->session->set('logged_email', $email);
                                return redirect()->to(base_url() . '/dashboard');
                            }
                        } else {
                            session()->setTempdata('error', 'Your account is not activated. Please activate your account', 3);
                            return redirect()->to(current_url());
                        }
                    } else {
                        session()->setTempdata('error', 'Sorry, email or password does not match!', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    session()->setTempdata('error', 'Sorry, email or password does not match!', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('pages/login_view', $data);
    }

    public function forgotpassword()
    {
        $data['validation'] = null;
        $data['page_title'] = 'Forgot Password';

        if ($this->request->getMethod() == 'post') {

            //gagawa ng mga $rules for validation
            $rules = [
                'email' => [
                    //label, rules, errors ay pre defined
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        //{field} -> means kung ano ang nilagay mong value ng 'lable' yun ang lalabas
                        'required' => '{field} field required',
                        'valid_email' => 'valid {field} required'
                    ]
                ]
            ];

            //kapag ang $rules ay navaldiate...
            if ($this->validate($rules)) {

                //kukunin ang label name 'email' at istore ito sa $email
                $email = $this->request->getVar('email');
                //pupunta sa LoginModel at verifyEmail() at ipapasa ang $email at sstore ito sa $userdata
                $userdata = $this->loginModel->verifyEmail($email);

                //kapag merong nireturn ang verifyEmail na nilagay sa userdata...
                if (!empty($userdata)) {
                    $date = date('Y-m-d H:i:s', strtotime('now'));
                    if ($this->loginModel->updatedAt($date, $userdata['uid'])) {
                        $to = $email;
                        $subject = 'Reset Password Link';
                        //$userdata->uniid; pwede din ito
                        $token = $userdata['uid'];
                        $message = 'Hi ' . $userdata['email'] . '<br><br>'
                            . "Your reset password request has been received."
                            . 'Please click thee link below to reset your password. <br><br>'
                            . '<a href="' . base_url() . '/login/reset_password/' . $token . '" target="_blank">Click here to reset Password</a><br><br>'
                            . 'Thanks <br>Admin';

                        $smtp = \Config\Services::email();
                        $smtp->setTo($to);
                        $smtp->setFrom("Kevin's Cafe");
                        $smtp->setSubject($subject);
                        $smtp->setMessage($message);

                        if ($smtp->send()) {
                            //magseset ng temporary data na may name na 'success' at value na blah blah na may 3secs interval
                            session()->setTempdata('success', 'Reset password link sent to your registered email. Please verify within 15 mins', 3);
                            //after 3secs interval ay magreredirect ito sa current url
                            return redirect()->to(current_url());
                        } else {

                            $data = $smtp->printDebugger(['headers']);
                            print_r($data);
                        }
                    } else {
                        //magseset ng temporary data na may name na 'error' at value na blah blah na may 3secs interval
                        session()->setTempdata('error', 'Email does not exist', 3);
                        //after 3secs interval ay magreredirect ito sa current url
                        return redirect()->to(current_url());
                    }

                    //kapag ang $userdata ay walang laman...
                } else {
                    //magseset ng temporary data na may name na 'error' at value na blah blah na may 3secs interval
                    session()->setTempdata('error', 'Email does not exist', 3);
                    //after 3secs interval ay magreredirect ito sa current url
                    return redirect()->to(current_url());
                }

                //kapag ang $rules ay hindi navalidate...
            } else {
                //ang validator ang magveverify lahat ng mga errors at ilalagay ito sa $validation sa view
                $data['validation'] = $this->validator;
            }
        }

        return view('pages/forgot_password_view', $data);
    }


    public function reset_password($token = null)
    {
        $data['validation'] = null;
        $data['page_title'] = 'Reset Password';

        //kapag ang token ay may laman...
        if (!empty($token)) {

            $userdata = $this->loginModel->verifyToken($token);
            //kapag ang nireturn sa verifyToken() sa LoginModel.php ayy == 1...
            if (!empty($userdata) && $this->checkExpiryDate($userdata['updated_at'])) {

                //pupunta sa checkExpiryDate at ipapasa ang 'updated_at' na galing sa $userdata para icheck at after nito ay gagawing condition
                //kapag true ang nireturn ng checkExpiryDate(less than 900 secs)...

                //kapag sinubmit na ang post form s areset_password_view.php...
                if ($this->request->getMethod() == 'post') {

                    //gagawa ng rules
                    $rules = [
                        'new_password' => [
                            'label' => 'New Password',
                            'rules' => 'required|min_length[8]|max_length[20]',
                            'errors' => [
                                //{field} -> means kung ano ang nilagay mong value ng 'lable' yun ang lalabas
                                'required' => '{field} field required',
                                'valid_email' => 'valid {field} required'
                            ]
                        ],
                        'confirm_new_password' => [
                            'label' => 'Confirm New Password',
                            'rules' => 'required|matches[new_password]',
                            'errors' => [
                                //{field} -> means kung ano ang nilagay mong value ng 'lable' yun ang lalabas
                                'required' => '{field} field required',
                                'valid_email' => 'valid {field} required'
                            ]
                        ]
                    ];
                    //kapag navalidate na ang $rules at walang error...
                    if ($this->validate($rules)) {
                        $new_password = md5($this->request->getVar('new_password'));
                        if ($this->loginModel->updatePassword($token, $new_password)) {
                            session()->setTempdata('success', 'Password updated successfully', 3);
                            return redirect()->to(base_url() . '/login');
                        } else {
                            session()->setTempdata('error', 'Unable to update password, try again', 3);
                            return redirect()->to(current_url());
                        }

                        //kapag navalidate ang $rules at may error...
                    } else {
                        //validator -> siya ang magsasabi kung ano ang error at ilalagay ito sa $validation sa view
                        $data['validation'] = $this->validator;
                    }
                }

                //kapag ang nireturn sa verifyToken() sa LoginModel.php ayy wala...
            } else {
                //kapag false ang nireturn ng checkExpiryDate(more than 900 secs)...
                echo '<h1>Reset password link was expired</h1>';
                die;
            }

            //kapag ang token ay walang laman...
        } else {
            //ilalagay sa $error na may value na blah blah
            $data['error'] = 'Sorry! Unauthorized access';
        }

        return view('pages/reset_password_view', $data);
    }


    public function checkExpiryDate($time)
    {
        $currtime = strtotime('now');
        $updated_at = strtotime($time);
        $Timediff = $currtime - $updated_at;

        if ($Timediff < 900) {
            return true;
        } else {
            return false;
        }
    }
}
