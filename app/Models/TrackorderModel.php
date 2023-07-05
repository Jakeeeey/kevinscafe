<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class TrackorderModel extends Model{
        
        public function getAllOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->where('order_status !=', 'completed');
            //$builder->where('completed');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }
        
    }
?>