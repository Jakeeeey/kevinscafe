<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class HomeModel extends Model{

        public function get_email($uid){
            $builder = $this->db->table('users');
            $builder->select('email');
            $builder->where('uid', $uid);
            $result = $builder->get();

            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function countAllMenu(){
            $builder = $this->db->table('products');
            $builder->select();
            $result = $builder->get();
            
            return count($result->getResultArray());
        }

        public function countAllCart(){
            $builder = $this->db->table('cart');
            $builder->select();
            $result = $builder->get();
            
            return count($result->getResultArray());
        }
        
        public function user_status($uid){
            $builder = $this->db->table('users');
            $builder->select();
            $builder->where('uid', $uid);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

    }
?>