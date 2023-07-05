<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class UserModel extends Model{

        public function createUser($userdata){
            $builder = $this->db->table('users');
            $builder->insert($userdata);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function googleUserExist($id){
            $builder = $this->db->table('social_login');
            $builder->where('oauth_id', $id);

            if($builder->countAllResults() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function updateGoogleUser($userdata, $id){
            $builder = $this->db->table('social_login');
            $builder->where('oauth_id', $id);
            $builder->update($userdata);
            
            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function createGoogleUser($userdata){
            $builder = $this->db->table('social_login');
            $builder->insert($userdata);
            
            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function verifyUser($email){
            $builder = $this->db->table('users');
            $builder->select('email,password,user_type,status');
            $builder->where('email', $email);
            $result = $builder->get();

            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }
    }
?> 