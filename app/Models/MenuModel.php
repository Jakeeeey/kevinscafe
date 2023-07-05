<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class MenuModel extends Model{

        public function getAllPending($id){
            $builder = $this->db->table('cart');
            $builder->select('*');
            #$builder->where('status', 'pending');
            $builder->join('menu', 'menu.menu_id = cart.menu_id');
            $builder->where('user_id', $id);
            $builder->where('status', 'pending');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function addCart($cart_menu){
            $builder = $this->db->table('cart');
            $builder->insert($cart_menu);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getAllCategories(){
            $builder = $this->db->table('category');
            $builder->select();      
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getCategoryAllMenu($category_id){
            $builder = $this->db->table('menu');
            $builder->select();    
            $builder->where('category_id', $category_id);  
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getBestSellers(){
            $builder = $this->db->table('menu');
            $builder->select();    
            $builder->where('best_seller', 'yes');  
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

    }
?>