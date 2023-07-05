<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class OrdersModel extends Model{

        public function getAllPlacedOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->join('users', 'users.id = orders.user_id');
            $builder->where('order_status', 'placed_order');
            $builder->orderBy('order_created_at','DESC');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getOrderDetails($placed_order_id){
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

        //Preparing
        public function getAllPreparingOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->join('users', 'users.id = orders.user_id');
            $builder->where('order_status', 'preparing');
            $builder->orderBy('order_created_at','DESC');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        //Pickup
        public function getAllToPickupOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->join('users', 'users.id = orders.user_id');
            $builder->where('order_status', 'to_pickup');
            $builder->orderBy('order_created_at','DESC');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        //Delivery
        public function getAllToDeliverOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->join('users', 'users.id = orders.user_id');
            $builder->where('order_status', 'to_deliver');
            $builder->orderBy('order_created_at','DESC');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        //Select 
        public function updateOrderStatus($order_id, $order_details){
            $builder = $this->db->table('orders');
            $builder->where('order_id', $order_id);
            $builder->update($order_details);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>