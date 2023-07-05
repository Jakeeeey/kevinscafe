<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class PurchasesModel extends Model{

        //Purchases/Orders
        public function getAllOrdersExceptCancelled(){
            $builder = $this->db->table('orders');
            $builder->orderBy('order_created_at', 'DESC');
            $builder->select();
            $builder->where('order_status !=', 'completed');
            $builder->where('order_status !=', 'cancelled');
            //$builder->where('completed');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function cancelOrder($placed_order_id, $order_update){
            $builder = $this->db->table('orders');
            $builder->where('placed_order_id', $placed_order_id);
            $builder->update($order_update);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Cancelled
        public function getAllCancelledOrder($user_id){
            $builder = $this->db->table('orders');
            $builder->orderBy('order_created_at', 'DESC');
            $builder->select();
            $builder->where('user_id', $user_id);
            $builder->where('order_status', 'cancelled');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        //Completed
        public function getAllCompletedOrder($user_id){
            $builder = $this->db->table('orders');
            $builder->orderBy('updated_at', 'DESC');
            $builder->select();
            $builder->where('user_id', $user_id);
            $builder->where('order_status', 'completed');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getOrderDetailsInCart($placed_order_id){
            $builder = $this->db->table('cart');
            $builder->select();
            $builder->join('menu', 'menu.menu_id = cart.menu_id');
            $builder->join('category', 'category.category_id = menu.category_id');
            $builder->where('placed_order_id', $placed_order_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getOrderDetailsInOrders($placed_order_id){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->join('users', 'users.id = orders.user_id');
            $builder->join('user_address', 'user_address.address_id = orders.address_id');
            $builder->where('placed_order_id', $placed_order_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }
    }
?>