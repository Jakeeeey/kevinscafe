<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ProfileModel extends Model{

        public function check_user_info($uid){
            $builder = $this->db->table('users');
            $builder->select();
            $builder->where('uid', $uid);
            $result = $builder->get();
            
            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }
        
        public function update_password($uid, $new_pass){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update(['password' => $new_pass]);
            
            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function update_user_profile($user_profile, $uid){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update($user_profile);
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function get_all_address($user_id){
            $builder = $this->db->table('user_address');
            $builder->select();
            $builder->where('user_id', $user_id);
            $result = $builder->get();
            
            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function add_address($address){
            $builder = $this->db->table('user_address');
            $builder->insert($address);
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function unset_address_status($user_id){
            $builder = $this->db->table('user_address');
            $builder->where('user_id', $user_id);
            $builder->update(['status' => 'inactive']);
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function set_address_status($address_id){
            $builder = $this->db->table('user_address');
            $builder->where('address_id', $address_id);
            $builder->update(['status' => 'active']);
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteAddress($address_id){
            $builder = $this->db->table('user_address');
            $builder->where('address_id', $address_id);
            $builder->delete();
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Profile1
        public function getUserInfo($user_id){
            $builder = $this->db->table('users');
            $builder->select();
            $builder->where('id', $user_id);
            $result = $builder->get();
            
            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function updateInfo($id, $update_info){
            $builder = $this->db->table('users');
            $builder->where('id', $id);
            $builder->update($update_info);
            
            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>