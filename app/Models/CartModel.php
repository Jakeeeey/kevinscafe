<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class CartModel extends Model{

        /*public function getUserId($uid){
            $builder = $this->db->table('users');
            $builder->select('id');
            $builder->where('uid', $uid);
            $result = $builder->get();

            if(count($result->getResultArray()) == 1){
                return $result->getRowArray();
            }else{
                return false;
            }
        }*/

        public function getAllPending($id){
            $builder = $this->db->table('cart');
            $builder->select('*');
            #$builder->where('status', 'pending');
            $builder->join('menu', 'menu.menu_id = cart.menu_id');
            $builder->join('category', 'category.category_id = menu.category_id');
            $builder->where('user_id', $id);
            $builder->where('status', 'pending');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function delete_cart($cart_id){
            $builder = $this->db->table('cart');
            $builder->where('cart_id', $cart_id);
            $builder->delete();

            if($this->db->affectedRows() == 1){
                return true;
            }else{
                return false;
            }
        }

        public function getProfile($user_id){
            $builder = $this->db->table('users');
            $builder->select();
            $builder->where('id', $user_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }

        // public function getActiveAddress($user_id){
        //     $builder = $this->db->table('user_address');
        //     $builder->select();
        //     $builder->where('user_id', $user_id);
        //     $builder->where('status', 'active');
        //     $result = $builder->get();

        //     if(count($result->getResultArray()) > 0){
        //         return $result->getRowArray();
        //     }else{
        //         return false;
        //     }
        // }

        public function updateCart($cart, $cart_id){
            $builder = $this->db->table('cart');
            $builder->where('cart_id', $cart_id);
            $builder->update($cart);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function insertOrder($order){
            $builder = $this->db->table('orders');
            $builder->insert($order);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        // public function getSelectedAddress($address_id){
        //     $builder = $this->db->table('user_address');
        //     $builder->select();
        //     $builder->where('address_id', $address_id);
        //     $builder->where('status', 'active');
        //     $result = $builder->get();

        //     if(count($result->getResultArray()) > 0){
        //         return $result->getRowArray();
        //     }else{
        //         return false;
        //     }
        // }

        // public function getUserInfo($user_id){
        //     $builder = $this->db->table('users');
        //     $builder->select();
        //     $builder->where('user_id', $user_id);
        //     $result = $builder->get();

        //     if(count($result->getResultArray()) > 0){
        //         return $result->getRowArray();
        //     }else{
        //         return false;
        //     }
        // }
    }
?>