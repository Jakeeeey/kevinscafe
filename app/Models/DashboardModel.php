<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class DashboardModel extends Model{

        public function getLoggedUserData($uid){
            $builder = $this->db->table('users');
            $builder->select('email, password');
            $builder->where('uid', $uid);
            $result = $builder->get();

            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function updatePassword($new_pass, $uid){
            $builder = $this->db->table('users');
            $builder->where('uid', $uid);
            $builder->update(['password' => $new_pass]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function countAllMenu(){
            $builder = $this->db->table('menu');
            $builder->select();
            $result = $builder->get();

            return count($result->getResultArray());
        }

        public function countAllCategory(){
            $builder = $this->db->table('category');
            $builder->select();
            $result = $builder->get();

            return count($result->getResultArray());
        }

        public function countAllSales(){
            $builder = $this->db->table('invoice_order');
            $builder->select();
            $result = $builder->get();

            return count($result->getResultArray());
        }

    }
?>