<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ProductsModel extends Model{
        
        public function get_products(){
            $builder = $this->db->table('products');
            $builder->select('*');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function addProduct($product){
            $builder = $this->db->table('products');
            $builder->insert($product);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function deleteProduct($prod_id){
            $builder = $this->db->table('products');
            $builder->where('id', $prod_id);
            $builder->delete();

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }
    
    }
?>