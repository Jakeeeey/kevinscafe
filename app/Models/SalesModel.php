<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class SalesModel extends Model{
        
        public function getAllInvoiceOrders(){
            $builder = $this->db->table('invoice_order');
            $builder->orderBy("order_id", "DESC");
            $builder->select();
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function loadFilter($date){
            $builder = $this->db->table('invoice_order');
            $builder->select();
            $builder->where('order_date', $date);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function viewInvoiceOrder($order_id){
            $builder = $this->db->table('invoice_order_item');
            $builder->select();
            $builder->join('products', 'products.id = invoice_order_item.product_id');
            $builder->where('order_id', $order_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResult();
            }else{
                return false;
            }
        }

        public function deleteInvoiceOrder($order_id){
            $builder = $this->db->table('invoice_order');
            $builder->where("order_id", $order_id);
            $builder->delete();

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function deleteInvoiceOrderItem($order_id){
            $builder = $this->db->table('invoice_order_item');
            $builder->where("order_id", $order_id);
            $builder->delete();

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Sales1

        public function getAllCompletedOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->where('order_status', 'completed');
            $builder->orderBy('updated_at', 'DESC');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getSalesDetailsInCart($placed_order_id){
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

        public function getSalesDetailsInOrders($placed_order_id){
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