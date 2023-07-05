<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class CustomersModel extends Model{
        public function getProduct($category){
            $builder = $this->db->table('products');
            $builder->select("id, p_name, size");
            $builder->where('category', $category);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getPnamePrice($id){
            $builder = $this->db->table('products');
            $builder->select("id, category, p_img, p_name, size, price");
            $builder->where('id', $id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return false;
            }
        }


        public function saveInvoice($invoiceOrder){
            $builder = $this->db->table('invoice_order');
            $builder->insert($invoiceOrder);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function saveOrderedItem($orderedItem){
            $builder = $this->db->table('invoice_order_item');
            $builder->insert($orderedItem);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function countAllOrders(){
            $builder = $this->db->table('invoice_order');
            $builder->orderBy("order_id", "DESC");
            $builder->limit(1);
            $builder->select('order_id');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getRowArray();
            }else{
                return $result->getRowArray();
            }
        }

        //Customers1

        public function getAllPendingOrders(){
            $builder = $this->db->table('orders');
            $builder->select();
            $builder->where('order_status !=', 'completed');
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function getCustomerOrders($check_out_id){
            $builder = $this->db->table('cart');
            $builder->select();
            $builder->join('menu', 'menu.menu_id = cart.menu_id');
            $builder->join('category', 'category.category_id = menu.category_id');
            $builder->where('check_out_id', $check_out_id);
            $result = $builder->get();

            if(count($result->getResultArray()) > 0){
                return $result->getResultArray();
            }else{
                return false;
            }
        }

        public function updateOrderStatus($check_out_id, $order_details){
            $builder = $this->db->table('orders');
            $builder->where('check_out_id', $check_out_id);
            $builder->update($order_details);

            if($this->db->affectedRows() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>