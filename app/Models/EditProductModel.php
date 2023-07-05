<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class EditProductModel extends Model{

        public function get_product_info($pid){
            $builder = $this->db->table('products');
            $builder->select('category, p_img, p_name, size, price');
            $builder->where('id', $pid);
            $result = $builder->get();

            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function update_product($p_info, $pid){
            $builder = $this->db->table('products');
            $builder->where('id', $pid);
            $builder->update($p_info);

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function updateProductImg($newName, $pid){
            $builder = $this->db->table('products');
            $builder->where('id', $pid);
            $builder->update(['p_img' => $newName]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteProduct($id){
            $builder = $this->db->table('products');
            $builder->where('id', $id);
            $builder->delete();

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }
    
    }
?>