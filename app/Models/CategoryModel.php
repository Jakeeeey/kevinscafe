<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class CategoryModel extends Model{

        public function getAllCategory(){
            $builder = $this->db->table('category');
            $builder->select();
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function addCategory($category){
            $builder = $this->db->table('category');
            $builder->insert(['category' => $category]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function saveCategory($category, $category_id){
            $builder = $this->db->table('category');
            $builder->where('category_id', $category_id);
            $builder->update(['category' => $category]);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getCategory($category_id){
            $builder = $this->db->table('category');
            $builder->select('category');
            $builder->where('category_id', $category_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function deleteCategory($category_id){
            $builder = $this->db->table('category');
            $builder->where('category_id', $category_id);
            $builder->delete();

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

    }
?>