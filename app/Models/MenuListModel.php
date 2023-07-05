<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class MenuListModel extends Model{

        public function getAllMenu(){
            $builder = $this->db->table('menu');
            $builder->select('*');
            $builder->join('category', 'category.category_id = menu.category_id');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function getCategoryAllMenu($category_id){
            $builder = $this->db->table('menu');
            $builder->select('*');
            $builder->join('category', 'category.category_id = menu.category_id');
            $builder->where('menu.category_id', $category_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function addMenu($added_menu){
            $builder = $this->db->table('menu');
            $builder->insert($added_menu);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function getAllCategory(){
            $builder = $this->db->table('category');
            $builder->select('*');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getMenuDetails($menu_id){
            $builder = $this->db->table('menu');
            $builder->select('*');
            $builder->where('menu_id', $menu_id);
            $builder->join('category', 'category.category_id = menu.category_id');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        public function editMenu($menu_id, $edited_menu){
            $builder = $this->db->table('menu');
            $builder->where('menu_id', $menu_id);
            $builder->update($edited_menu);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteMenu($menu_id){
            $builder = $this->db->table('menu');
            $builder->where('menu_id', $menu_id);
            $builder->delete();

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

    }
?>