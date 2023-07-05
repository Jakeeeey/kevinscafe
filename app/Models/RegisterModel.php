<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class RegisterModel extends Model{
        
        public function createUser($data){
            $builder = $this->db->table('users');
            $builder->insert($data);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function verifyUid($uid){
            $builder = $this->db->table('users');
            $builder->select('created_at, status, uid');
            $builder->where('uid', $uid);
            $result  = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRow();
            }else{
                return false;
            }
        }

        public function updateStatus($uid){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update(['status' => 'active']);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function updateActivatedAt($activated_at, $uid){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update(['activated_at' => $activated_at]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>