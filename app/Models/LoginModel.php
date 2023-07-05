<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class LoginModel extends Model{

        public function verifyEmail($email){
            $builder = $this->db->table('users');
            $builder->select();
            $builder->where('email', $email);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function verifyToken($token){
            $builder = $this->db->table('users');
            $builder->select('uid, email, updated_at');
            $builder->where('uid', $token);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function updatePassword($token,$new_password){
            $builder = $this->db->table('users');
            $builder->where('uid', $token);
            $builder->update(['password' => $new_password]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function updatedAt($date, $uid){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update(['updated_at' => $date]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function countAllCart($id){
            $builder = $this->db->table('cart');
            $builder->select();
            $builder->where('user_id', $id);
            $result = $builder->get();

            return count($result->getResultArray());
            
        }

    }
?>