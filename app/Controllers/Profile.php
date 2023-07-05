<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\ProfileModel;

    class Profile extends Controller{

        public $profileModel;
        public function __construct(){
            helper('form');
            $this->profileModel = new ProfileModel();
        }

        public function index(){
            $data['validation']= null;
            $data['page_title'] = 'Profile';
            $data['user_info'] = $this->profileModel->check_user_info(session()->get('logged_user'));
            $data['user_address'] = $this->profileModel->get_all_address(session()->get('logged_user_id'));

            if(!session()->has('logged_user')){
                return redirect()->to(base_url().'/login');
            }
            #$user_info = $this->profileModel->check_user_info(session()->get('logged_user'));
            #print_r($user_info['password']);die;

            
            if(isset($_POST['update_profile'])){
                $rules = [
                    'mobile_num' => [
                        'label' => 'Mobile Number',
                        'rules' => 'numeric|exact_length[11]',
                        'errors' => [
                            'numeric' => '{field} must be numbers only',
                            'exact_length' => '{field} should be exactly 11 digits'
                        ]
                    ]
                ];
                if($this->validate($rules)){
                    $user_profile = [
                        'first_name' => $this->request->getVar('first_name'),
                        'last_name' => $this->request->getVar('last_name'),
                        'mobile_num' => $this->request->getVar('mobile_num')
                    ];
                    if($this->profileModel->update_user_profile($user_profile, session()->get('logged_user'))){
                        session()->setTempdata('success', 'Profile updated successfully', 4);
                        return redirect()->to(current_url());
                    }else{
                            session()->setTempdata('error', 'Sorry unable to update profile', 4);
                            return redirect()->to(current_url());
                    }
                    
                }else{
                    $data['validation'] = $this->validator;
                }
    
            }


            if(isset($_POST['update_billing'])){
                $rules = [
                    /*'line_1' => [
                        'label' => 'Line 1',
                        'rules' => 'alpha_numeric',
                        'errors' => [
                            'alpha_numeric' => '{field} must have house number, street and barangay',
                        ]
                    ],
                    'line_2' => [
                        'label' => 'Line 2',
                        'rules' => 'alpha_numeric',
                        'errors' => [
                            'alpha_numeric' => '{field} must have house number, street and barangay',
                        ]
                        ],*/
                    'postal_code' => [
                        'label' => 'Postal Code',
                        'rules' => 'numeric|min_length[4]|max_length[10]',
                        'errors' => [
                            'numeric' => '{field} must be numbers only',
                            'min_length' => '{field} must be atleast 4 digits',
                            'max_length' => '{field} must not exceed 10 digits'
                        ]
                    ],
                ];
                if($this->validate($rules)){
                    $user_profile = [
                        'line_1' => $this->request->getVar('line_1'),
                        'line_2' => $this->request->getVar('line_2'),
                        'city' => $this->request->getVar('city'),
                        'state' => $this->request->getVar('state'),
                        'postal_code' => $this->request->getVar('postal_code'),
                        'country' => $this->request->getVar('country')
                    ];
                    if($this->profileModel->update_user_profile($user_profile, session()->get('logged_user'))){
                        session()->setTempdata('success', 'Profile updated successfully', 4);
                        return redirect()->to(current_url());
                    }else{
                        session()->setTempdata('error', 'Sorry unable to update profile', 4);
                        return redirect()->to(current_url());
                    }

                }else{
                    $data['validation'] = $this->validator;
                }
            }


            if(isset($_POST['add_address'])){
                $rules = [
                    /*'line_1' => [
                        'label' => 'Line 1',
                        'rules' => 'alpha_numeric',
                        'errors' => [
                            'alpha_numeric' => '{field} must have house number, street and barangay',
                        ]
                    ],
                    'line_2' => [
                        'label' => 'Line 2',
                        'rules' => 'alpha_numeric',
                        'errors' => [
                            'alpha_numeric' => '{field} must have house number, street and barangay',
                        ]
                        ],*/
                    'postal_code' => [
                        'label' => 'Postal Code',
                        'rules' => 'numeric|min_length[4]|max_length[10]',
                        'errors' => [
                            'numeric' => '{field} must be numbers only',
                            'min_length' => '{field} must be atleast 4 digits',
                            'max_length' => '{field} must not exceed 10 digits'
                        ]
                    ],
                ];
                if($this->validate($rules)){
                    $address = [
                        'user_id' => session()->get('logged_user_id'),
                        'line_1' => $this->request->getVar('line_1'),
                        'line_2' => $this->request->getVar('line_2'),
                        'city' => $this->request->getVar('city'),
                        'state' => $this->request->getVar('state'),
                        'postal_code' => $this->request->getVar('postal_code'),
                        'country' => $this->request->getVar('country')
                    ];
                    if($this->profileModel->add_address($address)){
                        session()->setTempdata('success', 'Address added successfully', 4);
                        return redirect()->to(current_url());
                    }else{
                        session()->setTempdata('error', 'Sorry unable to add address', 4);
                        return redirect()->to(current_url());
                    }

                }else{
                    $data['validation'] = $this->validator;
                }
            }


            if(isset($_POST['delete_address'])){
                $address_id =  $this->request->getVar('delete_address');
                if($this->profileModel->deleteAddress($address_id)){
                    return redirect()->to(current_url());
                }
            }


            if(isset($_POST['update_pass'])){
                $rules = [
                    'old_pass' => [
                        'label' => 'Old Password',
                        'rules' => 'required',
                        'errors' => [
                            'required'=> '{field} is required'
                        ]
                    ],
                    'new_pass' => [
                        'label' => 'New Password',
                        'rules' => 'required',
                        'errors' => [
                            'required'=> '{field} is required'
                        ]
                    ],
                    'confirm_pass' => [
                        'label' => 'Confirm New Password',
                        'rules' => 'required|matches[new_pass]',
                        'errors' => [
                            'required' => '{field} field is required',
                            'matches' => '{field} does not match the new password you entered'
                        ]
                    ]
                ];
                if($this->validate($rules)){
                    $old_pass = md5($this->request->getVar('old_pass'));
                    $new_pass = md5($this->request->getVar('new_pass'));
                    $user_info = $this->profileModel->check_user_info(session()->get('logged_user'));
                    if($old_pass == $user_info['password']){
                        if($this->profileModel->update_password(session()->get('logged_user'), $new_pass)){
                            session()->setTempdata('success', 'Password updated successfully', 4);
                            return redirect()->to(base_url().'/logout');
                        }else{
                            session()->setTempdata('error', 'Sorry, unable to change password', 4);
                            return redirect()->to(current_url());
                        }
                    }else{
                        session()->setTempdata('error', 'Sorry, the old password you entered is wrong', 4);
                        return redirect()->to(current_url());
                    }

                    
                }else{
                    $data['validation'] = $this->validator;
                }
            }

            return view('pages/profile_view', $data);
        }

        public function update_address(){
            $address_id = $_GET['address_id'];
            $this->profileModel->unset_address_status(session()->get('logged_user_id'));
            $address_id = $this->profileModel->set_address_status($address_id);
            return redirect()->to(base_url().'/profile');
        }

    }
?>