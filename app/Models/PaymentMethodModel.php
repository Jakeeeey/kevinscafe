<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class PaymentMethodModel extends Model{

        public function insert_data_transac($data_transac){
            $builder = $this->db->table('transactions');
            $builder->insert($data_transac);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function updateStatus($status, $id){
            $builder = $this->db->table('transactions');
            $builder->where('link', $id);
            $builder->update(['status' => $status]);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }
    }
?>